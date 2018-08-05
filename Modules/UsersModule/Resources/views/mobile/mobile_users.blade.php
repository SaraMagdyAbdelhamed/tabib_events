@extends('layouts.app') 
@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:   {{ asset('img/covers/dummy2.jpg')}}   ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title">@lang('keywords.Users') </h4>
              <i class="fa fa-chevron-circle-right"></i>
              <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.MobileAppUsers') </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions">
          <span></span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="tabs--wrapper">
      <div class="clearfix"></div>
      <ul class="tabs">
        <li id="registered_from_mobile">@lang('keywords.MobileAppUsers')</li>
        <li id="general_list">@lang('keywords.generalList')</li>
        <li id="my_list">@lang('keywords.myList')</li>
      </ul>
      <ul class="tab__content">
        <li class="tab__content_item active" id="registered_from_mobile-content">
          <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
            <div class="full-table">
              <div class="filter__btns">
                <a class="filter-btn master-btn" href="#filter-users">
                      <i class="fa fa-filter"></i>@lang('keywords.filter')</a>
              </div>
              <div class="bottomActions__btns">
                <a data-id="#dataTableTriggerId_001" class="{{\App::isLocale('en') ?'btn-warning-confirm-all':'btn-warning-confirm-all-ar'}} master-btn deleteSelected" href="#">@lang('keywords.deleteSelected')</a>
              </div>
              <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">

                {{-- Filter #1 --}}
                <form role="form" action="{{ route('mobile_filter') }}" method="GET" accept-charset="utf-8">
                  {{ csrf_field() }}
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                  <div>
                    <div class="row">
                      <div class="col-xs-12">
                        <h3 class="text-center">@lang('keywords.filter')</h3>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="filter_countries">@lang('keywords.Countries') </label> {{-- countries
                          --}}
                          <select name="countries[]" class="master_input select2" id="filter_countries" multiple="multiple" data-placeholder="Countries"
                            style="width:100%;" ,>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
          
                                @endforeach
                              </select>
                        </div>
                      </div>

                      <div class="col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="filter_cities">@lang('keywords.Cities') </label> {{-- cities --}}
                          <select name="cities[]" class="master_input select2" id="filter_cities" multiple="multiple" data-placeholder="Cities" style="width:100%;"
                            ,>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
          
                                @endforeach
                              </select>
                        </div>
                      </div>
                      {{--
                      <div class="col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="filter_age">@lang('keywords.Age')</label>
                          <select name="age" class="master_input select2" id="filter_age" data-placeholder="-- Select age please --" style="width:100%;"
                            ,>
                                <option value="" disabled selected>-- @lang('keywords.pleaseSelect') -- </option>
                                @foreach($age_ranges as $age_range)
                                <option value="{{$age_range->id}}">{{$age_range->name}}</option>
                                @endforeach
                              </select>
                        </div>
                      </div> --}}
                      <div class="col-sm-6 col-xs-12">
                        <div class="master_field">
                          <label class="master_label">@lang('keywords.SelectGender')</label>
                          <div class="funkyradio">
                            <input type="checkbox" name="gender[]" value="1" id="checkboxbtn_2">
                            <label for="checkboxbtn_2">@lang('keywords.Male')</label>
                          </div>
                          <div class="funkyradio">
                            <input type="checkbox" name="gender[]" value="2" id="checkboxbtn_3">
                            <label for="checkboxbtn_3">@lang('keywords.Female')</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                  <button class="remodal-confirm" type="submit">@lang('keywords.ApplyFilter')</button>
                </form>
              </div>
              <form id="dataTableTriggerId_001_form">

                {{-- Mobile users table --}}
                <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
                  <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                      <th>
                        <span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot;
                              /&gt;</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.serialNo')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Name')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Phone')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Email')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Country')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.City')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.region')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.address')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Gender')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.specialization')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.RegisterationDate')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Status')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Actions')</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($mobiles as $doctor)
                    <tr data-id={{$doctor->id}}>
                      <td>
                        <span class="cellcontent" data-id={{$doctor->id}}></span>
                      </td>

                      {{-- serial number --}}
                      <td>
                        <span class="cellcontent">{{ $loop->index + 1 }}</span>
                      </td>

                      {{-- user name --}}
                      <td>
                        <span class="cellcontent">{{$doctor->username ? : __('keywords.not') }}</span>
                      </td>

                      {{-- Mobile phone --}}
                      <td>
                        <span class="cellcontent">{{$doctor->mobile ? : __('keywords.not')}}</span>
                      </td>

                      {{-- Email --}}
                      <td>
                        <span class="cellcontent" style="text-transform: lowercase;">{{$doctor->email ? : __('keywords.not')}}</span>
                      </td>
                      
                      {{-- Country --}}
                      <td>
                        <span class="cellcontent">
                          {{\App::isLocale('en') ? $doctor->country->name : \Helper::localization('geo_countries','name',$doctor->country_id,'2',
                              $doctor->country->name)}}
                        </span>
                      </td>

                      {{-- City --}}
                      <td>
                        <span class="cellcontent">
                          {{\App::isLocale('en') ? $doctor->city->name : \Helper::localization('geo_cities','name',$doctor->city_id,'2',
                              $doctor->city->name)}}
                        </span>
                      </td>

                      {{-- Region --}}
                      <td>
                        <span class="cellcontent">
                          {{\App::isLocale('en') ? $doctor->userInfo->region->name : \Helper::localization('geo_regions','name',$doctor->userInfo->region->city_id,'2',
                              $doctor->city->name)}}
                        </span>
                      </td>

                      {{-- Address --}}
                      <td>
                        <span class="cellcontent">
                          {{ $doctor->userInfo ? $doctor->userInfo->address : __('keywords.not') }}
                        </span>
                      </td>

                      {{-- Gender --}}
                      <td>
                        <span class="cellcontent">
                          {{\App::isLocale('en') ? ($doctor->gender ? $doctor->gender->name : __('keywords.not')) : \Helper::localization('genders','name',$doctor->gender_id,'2',
                              ($doctor->gender ? $doctor->gender->name : __('keywords.not') ) ) }}
                        </span>
                      </td>

                      {{-- Specialization --}}
                      <td>
                        <span class="cellcontent">
                            {{\App::isLocale('en') ? (isset($doctor->userInfo->specialization) ? $doctor->userInfo->specialization->name : __('keywords.not')) : \Helper::localization('specializations','name',$doctor->gender_id,'2',
                            ($doctor->gender ? $doctor->gender->name : __('keywords.not') ) ) }}  
                        </span>
                      </td>

                      {{-- Registration Date --}}
                      <td>
                        <span class="cellcontent">{{$doctor->created_at->format('d/m/Y') }}</span>
                      </td>

                      {{-- Status --}}
                      <td>
                        <span class="cellcontent">
                          @if($doctor->is_active==1)
                            <i class="fa icon-in-table-true fa-check"></i>
                          @else
                            <i class="fa icon-in-table-false fa-times"></i>
                          @endif
                        </span>
                      </td>
                     
                      <td>
                        <span class="cellcontent">

                          {{-- Show button --}}
                          <a href="{{ route('users_mobile.show', $doctor->id) }}" class="action-btn bgcolor--main color--white ">
                            <i class="fa  fa-eye"></i>
                          </a>

                          {{-- Delete button --}}
                          <a href="#" data-class="dataTableTriggerId_001" class="{{ \App::isLocale('en') ? 'btn-warning-confirm' : 'btn-warning-confirm-ar'}} action-btn bgcolor--fadebrown color--white deleteRecord">
                            <i class="fa  fa-trash-o"></i>
                          </a>

                        </span>
                      </td>
                    </tr>

                    <div class="remodal" data-remodal-id="popupModal_{{$doctor->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <form action="{{route('mobile_status',$doctor->id)}}" method="POST">
                        {{csrf_field()}}
                        <div class="row">
                          <h3>@lang('keywords.EditUser')</h3>
                          <div class="col-xs-12 text-center">
                            <div class="master_field text-center">
                              <label class="master_label">@lang('keywords.pleaseSetTheUserStatus')</label>
                              <input class="icon" type="radio" name="is_active" id="radbtn_2{{$doctor->id}}" value="1">
                              <label for="radbtn_2{{$doctor->id}}">@lang('keywords.Active')</label>
                              <input class="icon" type="radio" name="is_active" id="radbtn_3{{$doctor->id}}" value="0">
                              <label for="radbtn_3{{$doctor->id}}">@lang('keywords.Inactive')</label>
                            </div>
                          </div>
                        </div>
                        <br>
                        <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                        <button class="remodal-confirm" type="submit">@lang('keywords.save')</button>
                      </form>
                    </div>
                    @endforeach
                  </tbody>
                </table>

              </form>
            </div>
          </div><br>
        </li>
        <li class="tab__content_item" id="general_list-content">
          <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
            <div class="full-table">
              {{-- Filter Button --}}
              <div class="filter__btns">
                <a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>@lang('keywords.filter')</a>
              </div>
              <div class="bottomActions__btns">
                {{-- Delete Selected Button --}}
                <a data-id="#dataTableTriggerId_002" class="{{\App::isLocale('en') ?'btn-warning-confirm-all':'btn-warning-confirm-all-ar'}} master-btn deleteSelected" href="#">@lang('keywords.deleteSelected')</a>

                {{-- Add new Doctor Button --}}
                <a class="master-btn users_add_new_dr.html" href="{{ route('doctor.create') }}">@lang('keywords.addNew')</a>
              </div>
              <form id="dataTableTriggerId_002_form">

                {{-- General List --}}
                <table class="data-table-trigger table-master" id="dataTableTriggerId_002">
                  <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                      <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                      <th>
                        <span class="cellcontent">@lang('keywords.serialNo')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Name')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Phone')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Email')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Country')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.City')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.region')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.address')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Gender')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.specialization')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.RegisterationDate')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Status')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Actions')</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($general as $doctor)
                      <tr data-id={{ $doctor->id }}>
                        <td>
                          <span class="cellcontent" data-id="{{ $doctor->id }}"></span>
                        </td>
  
                        {{-- serial number --}}
                        <td>
                          <span class="cellcontent">{{ $loop->index + 1 }}</span>
                        </td>
  
                        {{-- user name --}}
                        <td>
                          <span class="cellcontent">{{ $doctor->username ? : __('keywords.not') }}</span>
                        </td>
  
                        {{-- Mobile phone --}}
                        <td>
                          <span class="cellcontent">{{ $doctor->mobile ? : __('keywords.not')}}</span>
                        </td>
  
                        {{-- Email --}}
                        <td>
                          <span class="cellcontent" style="text-transform: lowercase;">{{ $doctor->email ? : __('keywords.not')}}</span>
                        </td>
                        
                        {{-- Country --}}
                        <td>
                          <span class="cellcontent">
                          </span>
                        </td>
  
                        {{-- City --}}
                        <td>
                          <span class="cellcontent">
                            {{\App::isLocale('en') ? $doctor->city->name : \Helper::localization('geo_cities','name',$doctor->city->id,'2',
                                $doctor->city->name)}}
                          </span>
                        </td>
  
                        {{-- Region --}}
                        <td>
                          <span class="cellcontent">
                            {{\App::isLocale('en') ? $doctor->userInfo->region->name : \Helper::localization('geo_regions','name',$doctor->userInfo->region_id,'2',
                                $doctor->city->name)}}
                          </span>
                        </td>
  
                        {{-- Address --}}
                        <td>
                          <span class="cellcontent">
                            {{ $doctor->userInfo ? $doctor->userInfo->address : __('keywords.not') }}
                          </span>
                        </td>
  
                        {{-- Gender --}}
                        <td>
                          <span class="cellcontent">
                            {{\App::isLocale('en') ? ($doctor->gender ? $doctor->gender->name : __('keywords.not')) : \Helper::localization('genders','name',$doctor->gender_id,'2',
                                ($doctor->gender ? $doctor->gender->name : __('keywords.not') ) ) }}
                          </span>
                        </td>
  
                        {{-- Specialization --}}
                        <td>
                          <span class="cellcontent">
                              {{\App::isLocale('en') ? (isset($doctor->userInfo->specialization) ? $doctor->userInfo->specialization->name : __('keywords.not')) : \Helper::localization('specializations','name',$doctor->userInfo->specialization_id,'2',
                               (isset($doctor->userInfo->specialization) ? $doctor->userInfo->specialization->name : __('keywords.not')) ) }}  
                          </span>
                        </td>
  
                        {{-- Registration Date --}}
                        <td>
                          <span class="cellcontent">{{$doctor->created_at->format('d/m/Y') }}</span>
                        </td>
  
                        {{-- Status --}}
                        <td>
                          <span class="cellcontent">
                            @if($doctor->is_active==1)
                              <i class="fa icon-in-table-true fa-check"></i>
                            @else
                              <i class="fa icon-in-table-false fa-times"></i>
                            @endif
                          </span>
                        </td>
                       
                        <td>
                          <span class="cellcontent">
  
                            {{-- Edit button --}}
                            <a href="{{ route('doctor.edit', $doctor->id) }}" class="action-btn bgcolor--fadegreen color--white ">
                              <i class="fa  fa-pencil"></i>
                            </a>
  
                            {{-- Delete button --}}
                            <a href="#" data-id="{{ $doctor->id }}" class="{{ \App::isLocale('en') ? 'btn-warning-confirm' : 'btn-warning-confirm-ar'}} action-btn bgcolor--fadebrown color--white deleteRecord">
                              <i class="fa  fa-trash-o"></i>
                            </a>
  
                          </span>
                        </td>
                      </tr>

                    @endforeach
                  </tbody>
                </table>
                
              </form>
              <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                <div>
                  <h2 class="title">title of the changing log in</h2>
                  <div class="log-content">
                    <div class="log-container">
                      <table class="log-table">
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <th>log title</th>
                          <th>user</th>
                          <th>time</th>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><br>
        </li>
        <li class="tab__content_item" id="my_list-content">
          <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
            <div class="full-table">
              {{-- Filter Button --}}
              <div class="filter__btns">
                <a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>@lang('keywords.filter')</a>
              </div>

              {{-- Delete Selected Button --}}
              <div class="bottomActions__btns">
                  <a data-id="#dataTableTriggerId_003" class="{{\App::isLocale('en') ?'btn-warning-confirm-all':'btn-warning-confirm-all-ar'}} master-btn deleteSelected" href="#">@lang('keywords.deleteSelected')</a>
                </div>
              <form id="dataTableTriggerId_003_form">

                {{-- My List --}}
                <table class="data-table-trigger table-master" id="dataTableTriggerId_003">
                  <thead>
                    <tr class="bgcolor--gray_mm color--gray_d">
                      <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                      <th>
                        <span class="cellcontent">@lang('keywords.serialNo')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Name')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Phone')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Email')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Country')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.City')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.region')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.address')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Gender')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.specialization')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.RegisterationDate')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Status')</span>
                      </th>
                      <th>
                        <span class="cellcontent">@lang('keywords.Actions')</span>
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($myList as $doctor)
                    <tr data-id={{$doctor->id}}>
                      <td>
                        <span class="cellcontent" data-id="{{ $doctor->id }}"></span>
                      </td>

                      {{-- serial number --}}
                      <td>
                        <span class="cellcontent">{{ $loop->index + 1 }}</span>
                      </td>

                      {{-- user name --}}
                      <td>
                        <span class="cellcontent">{{$doctor->username ? : __('keywords.not') }}</span>
                      </td>

                      {{-- Mobile phone --}}
                      <td>
                        <span class="cellcontent">{{$doctor->mobile ? : __('keywords.not')}}</span>
                      </td>

                      {{-- Email --}}
                      <td>
                        <span class="cellcontent" style="text-transform: lowercase;">{{$doctor->email ? : __('keywords.not')}}</span>
                      </td>
                      
                      {{-- Country --}}
                      <td>
                        <span class="cellcontent">
                          {{\App::isLocale('en') ? $doctor->country->name : \Helper::localization('geo_countries','name',$doctor->country_id,'2',
                              $doctor->country->name)}}
                        </span>
                      </td>

                      {{-- City --}}
                      <td>
                        <span class="cellcontent">
                          {{\App::isLocale('en') ? $doctor->city->name : \Helper::localization('geo_cities','name',$doctor->city_id,'2',
                              $doctor->city->name)}}
                        </span>
                      </td>

                      {{-- Region --}}
                      <td>
                        <span class="cellcontent">
                          {{\App::isLocale('en') ? isset($doctor->userInfo->region->name) : \Helper::localization('geo_regions','name', isset($doctor->userInfo->region->city_id) ? $doctor->userInfo->region->city_id : '','2',
                              $doctor->city->name)}}
                        </span>
                      </td>

                      {{-- Address --}}
                      <td>
                        <span class="cellcontent">
                          {{ $doctor->userInfo ? $doctor->userInfo->address : __('keywords.not') }}
                        </span>
                      </td>

                      {{-- Gender --}}
                      <td>
                        <span class="cellcontent">
                          {{\App::isLocale('en') ? ($doctor->gender ? $doctor->gender->name : __('keywords.not')) : \Helper::localization('genders','name',$doctor->gender_id,'2',
                              ($doctor->gender ? $doctor->gender->name : __('keywords.not') ) ) }}
                        </span>
                      </td>

                      {{-- Specialization --}}
                      <td>
                        <span class="cellcontent">
                            {{\App::isLocale('en') ? (isset($doctor->userInfo->specialization) ? $doctor->userInfo->specialization->name : __('keywords.not')) : \Helper::localization('specializations','name',$doctor->gender_id,'2',
                            ($doctor->gender ? $doctor->gender->name : __('keywords.not') ) ) }}  
                        </span>
                      </td>

                      {{-- Registration Date --}}
                      <td>
                        <span class="cellcontent">{{$doctor->created_at->format('d/m/Y') }}</span>
                      </td>

                      {{-- Status --}}
                      <td>
                        <span class="cellcontent">
                          @if($doctor->is_active==1)
                            <i class="fa icon-in-table-true fa-check"></i>
                          @else
                            <i class="fa icon-in-table-false fa-times"></i>
                          @endif
                        </span>
                      </td>
                      
                      <td>
                        <span class="cellcontent">

                          {{-- View button --}}
                          <a href="{{ route('myList.show', $doctor->id) }}" class="action-btn bgcolor--main color--white ">
                            <i class="fa  fa-eye"></i>
                          </a>

                          {{-- Delete button --}}
                          <a href="#" class="{{ \App::isLocale('en') ? 'btn-warning-confirm' : 'btn-warning-confirm-ar'}} action-btn bgcolor--fadebrown color--white ">
                            <i class="fa  fa-trash-o"></i>
                          </a>

                        </span>
                      </td>
                    </tr>

                    <div class="remodal" data-remodal-id="popupModal_{{$doctor->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                      <form action="{{route('mobile_status',$doctor->id)}}" method="POST">
                        {{csrf_field()}}
                        <div class="row">
                          <h3>@lang('keywords.EditUser')</h3>
                          <div class="col-xs-12 text-center">
                            <div class="master_field text-center">
                              <label class="master_label">@lang('keywords.pleaseSetTheUserStatus')</label>
                              <input class="icon" type="radio" name="is_active" id="radbtn_2{{$doctor->id}}" value="1">
                              <label for="radbtn_2{{$doctor->id}}">@lang('keywords.Active')</label>
                              <input class="icon" type="radio" name="is_active" id="radbtn_3{{$doctor->id}}" value="0">
                              <label for="radbtn_3{{$doctor->id}}">@lang('keywords.Inactive')</label>
                            </div>
                          </div>
                        </div>
                        <br>
                        <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                        <button class="remodal-confirm" type="submit">@lang('keywords.save')</button>
                      </form>
                    </div>
                    @endforeach
                  </tbody>

                </table>

              </form>
              <div class="remodal log-custom" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                <div>
                  <h2 class="title">title of the changing log in</h2>
                  <div class="log-content">
                    <div class="log-container">
                      <table class="log-table">
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <th>log title</th>
                          <th>user</th>
                          <th>time</th>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>January</td>
                          <td>$100</td>
                          <td>$100</td>
                        </tr>
                        <tr class="log-row" data-link="https://www.google.com.eg/">
                          <td>February</td>
                          <td>$80</td>
                          <td>$80</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><br>
        </li>
      </ul>
    </div>
  </div>
  <div class="clearfix"></div>

  <br>
</div>

</div>
</div>

@section('js')
<script>
  // delete multi
  $('.deleteSelected').click(function(){
    var allVals = [];                   // selected IDs
    var token = '{{ csrf_token() }}';
    var input = $(this).data("id") + ' input:checked';
    // push cities IDs selected by user
    $(input).each(function() {
        allVals.push( $(this).data("id") );
    });

    // check if user selected nothing
    if(allVals.length <= 0) {
    confirm('إختر طبيب علي الاقل لتستطيع حذفه');
    } else {
    var ids = allVals;    
    var title = "{{ \App::isLocale('en') ? 'Are you sure?' : 'هل أنت متأكد؟' }}";
    var text  = "{{ \App::isLocale('en') ? 'You wont be able to fetch this information later!' : 'لن تستطيع إسترجاع هذه المعلومة لاحقا' }}";

    swal({
    title: title,
    text: text,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#281160',
    confirmButtonText: "{{ \App::isLocale('en') ? 'Yes, delete it!' : 'نعم احذفه' }}",
    cancelButtonText: "{{ \App::isLocale('en') ? 'Cancel' : 'إالغاء' }}",
    closeOnConfirm: false
    },
    function(isConfirm){
        if (isConfirm){
            
        $.ajax(
        {
            url: "{{ route('doctor.user.destroy.all') }}",
            type: 'POST',
            dataType: "JSON",
            data: {
                "ids": ids,
                "_method": 'POST',
                "_token": token,
            },
            success: function ()
            {
                swal("تم الحذف!", "تم الحذف بنجاح", "success");

                // fade out selected checkboxes after deletion
                $.each(allVals, function( index, value ) {
                    $('tr[data-id='+value+']').fadeOut();
                });
            },
            error: function(response) {
                console.log(response);
            }
        });
        } else {
        swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
        }
    });
    }
  });

  // delete a row
  $('.deleteRecord').click(function(){
      
      var id = $(this).data("id");
      var token = '{{ csrf_token() }}';
      var title = "{{ \App::isLocale('en') ? 'Are you sure?' : 'هل أنت متأكد؟' }}";
      var text  = "{{ \App::isLocale('en') ? 'You wont be able to fetch this information later!' : 'لن تستطيع إسترجاع هذه المعلومة لاحقا' }}";

      swal({
      title: title,
      text: text,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#281160',
      confirmButtonText: "{{ \App::isLocale('en') ? 'Yes, delete it!' : 'نعم احذفه' }}",
      cancelButtonText: "{{ \App::isLocale('en') ? 'Cancel' : 'إالغاء' }}",
      closeOnConfirm: false
      },
      function(isConfirm){
          if (isConfirm){
                  
          $.ajax(
          {
              url: "{{ route('doctor.user.destroy') }}",
              type: 'POST',
              dataType: "JSON",
              data: {
                  "op": 2,
                  "id": id,
                  "_method": 'POST',
                  "_token": token,
              },
              success: function ()
              {
                  swal("تم الحذف!", "تم الحذف بنجاح", "success");
                  $('tr[data-id='+id+']').fadeOut();
              },
                  error: function(response) {
                  console.log(response);
              }
          });
              
          } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
          }
      });
  });
</script>

{{-- add active class to sidebar menu --}}
<script>
  $(document).ready(function(){
      $('#menu_2').addClass('openedmenu');
      $('#sub_2_1').addClass('pure-active');
  });

</script>
@endsection

@endsection