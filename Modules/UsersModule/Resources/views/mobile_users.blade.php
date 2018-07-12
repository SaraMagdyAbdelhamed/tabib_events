@extends('layouts.app') @section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg')}} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
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
    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
      <div class="full-table">
        <div class="filter__btns">
          <a class="filter-btn master-btn" href="#filter-users">
            <i class="fa fa-filter"></i>@lang('keywords.filter')</a>
        </div>
        <div class="bottomActions__btns">
          <a class="{{\App::isLocale('en') ?'btn-warning-confirm-all':'btn-warning-confirm-all-ar'}} master-btn" href="#">@lang('keywords.deleteSelected')</a>
        </div>
        <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
          <form role="form" action="{{ route('mobile_filter') }}" method="GET" accept-charset="utf-8">
            {{csrf_field()}}
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
              <div class="row">
                <div class="col-xs-12">
                  <h3 class="text-center">@lang('keywords.filter')</h3>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="filter_countries">@lang('keywords.Countries') </label>
                    <select name="countries[]" class="master_input select2" id="filter_countries" multiple="multiple" data-placeholder="Countries"
                      style="width:100%;" ,>f
                      @foreach($countries as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>

                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="filter_cities">@lang('keywords.Cities') </label>
                    <select name="cities[]" class="master_input select2" id="filter_cities" multiple="multiple" data-placeholder="Cities" style="width:100%;"
                      ,>
                      @foreach($cities as $city)
                      <option value="{{$city->id}}">{{$city->name}}</option>

                      @endforeach
                    </select>
                  </div>
                </div>
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
                </div>
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
                  <span class="cellcontent">@lang('keywords.Image')</span>
                </th>
                <th>
                  <span class="cellcontent">@lang('keywords.Email')</span>
                </th>
                <th>
                  <span class="cellcontent">@lang('keywords.Code')</span>
                </th>
                <th>
                  <span class="cellcontent">@lang('keywords.Phone')</span>
                </th>
                <th>
                  <span class="cellcontent">@lang('keywords.Country')</span>
                </th>
                <th>
                  <span class="cellcontent">@lang('keywords.City')</span>
                </th>
                <th>
                  <span class="cellcontent">@lang('keywords.Gender')</span>
                </th>
                <th>
                  <span class="cellcontent">@lang('keywords.Birthdate')</span>
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
              @foreach($mobiles as $mobile)
              <tr data-mobile-id={{$mobile->id}}>
                <td>
                  <span class="cellcontent"></span>
                </td>
                <td>
                  <span class="cellcontent">{{ $loop->index + 1 }}</span>
                </td>
                <td>
                  <span class="cellcontent">{{$mobile->username ? : __('keywords.not') }}</span>
                </td>
                <td>
                  <span class="cellcontent">
                    <img src="{{asset(''.$mobile->photo)}}" , class=" img-in-table">
                  </span>
                </td>
                <td>
                  <span class="cellcontent" style="text-transform: lowercase;">{{$mobile->email ? : __('keywords.not')}}</span>
                </td>
                <td>
                  <span class="cellcontent">{{$mobile->tele_code ? : __('keywords.not')}}</span>
                </td>
                <td>
                  <span class="cellcontent">{{$mobile->mobile ? : __('keywords.not')}}</span>
                </td>
                <td>
                  <span class="cellcontent">{{\App::isLocale('en') ? $mobile->country->name : \Helper::localization('geo_countries','name',$mobile->country_id,'2',
                    $mobile->country->name)}}</span>
                </td>
                <td>
                  <span class="cellcontent">{{\App::isLocale('en') ? $mobile->city->name : \Helper::localization('geo_cities','name',$mobile->city_id,'2',
                    $mobile->city->name)}}</span>
                </td>
                <td>
                  <span class="cellcontent">{{\App::isLocale('en') ? ($mobile->gender ? $mobile->gender->name : __('keywords.not')) : \Helper::localization('genders','name',$mobile->gender_id,'2',
                    ($mobile->gender ? $mobile->gender->name : __('keywords.not') ) ) }}</span>
                </td>
                <td>
                  <span class="cellcontent">{{$mobile->birthdate ? $mobile->birthdate->format('d/m/Y') : __('keywords.not')}}</span>
                </td>
                <td>
                  <span class="cellcontent">{{$mobile->created_at->format('d/m/Y') }}</span>
                </td>
                <td>
                  <span class="cellcontent">
                    @if($mobile->is_active==1)
                    <i class="fa icon-in-table-true fa-check"></i>
                    @else
                    <i class="fa icon-in-table-false fa-times"></i>
                  </span>
                </td>
                @endif
                <td>
                  <span class="cellcontent">
                    <a href="#popupModal_{{$mobile->id}}" class="action-btn bgcolor--fadegreen color--white ">
                      <i class="fa  fa-pencil"></i>
                    </a>
                    <a href="#" class="{{\App::isLocale('en') ?'btn-warning-confirm':'btn-warning-confirm-ar'}} action-btn bgcolor--fadebrown color--white ">
                      <i class="fa  fa-trash-o"></i>
                    </a>
                  </span>
                </td>
              </tr>

              <div class="remodal" data-remodal-id="popupModal_{{$mobile->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                 <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                  <form action="{{route('mobile_status',$mobile->id)}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                      <h3>@lang('keywords.EditUser')</h3>
                      <div class="col-xs-12 text-center">
                        <div class="master_field text-center">
                          <label class="master_label">@lang('keywords.pleaseSetTheUserStatus')</label>
                          <input class="icon" type="radio" name="is_active" id="radbtn_2{{$mobile->id}}" value="1" >
                          <label for="radbtn_2{{$mobile->id}}">@lang('keywords.Active')</label>
                          <input class="icon" type="radio" name="is_active" id="radbtn_3{{$mobile->id}}" value="0" >
                          <label for="radbtn_3{{$mobile->id}}">@lang('keywords.Inactive')</label>
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
    </div>
  </div>
  <br>
</div>

</div>
</div>
@section('js')
<script type="text/javascript">
  $(document).ready(function () {
    // "use strict";
    $('.btn-warning-confirm').click(function () {
      var mobile_id = $(this).closest('tr').attr('data-mobile-id');
      var _token = '{{csrf_token()}}';
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#281160',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm: false
      },
        function () {
          $.ajax({
            type: 'POST',
            url: '{{url('mobile_destroy')}}' + '/' + mobile_id,
            data: { _token: _token },
            success: function (data) {
              $('tr[data-mobile-id=' + mobile_id + ']').fadeOut();
            }
          });
          swal("Deleted!", "Your imaginary file has been deleted!", "success");
        });
    });

    $('.btn-warning-confirm-ar').click(function () {
      var mobile_id = $(this).closest('tr').attr('data-mobile-id');
      var _token = '{{csrf_token()}}';
      swal({
        title: "هل أنت متأكد ؟",
        text: "لن تكون قادرًا على استرداد هذا الملف !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#281160',
        confirmButtonText: 'نعم , احذف هذا',
        closeOnConfirm: false
      },
        function () {
          $.ajax({
            type: 'POST',
            url: '{{url('mobile_destroy')}}' + '/' + mobile_id,
            data: { _token: _token },
            success: function (data) {
              $('tr[data-mobile-id=' + mobile_id + ']').fadeOut();
            }
          });
          swal("تم الحذف!", "لقد تم حذف ملفلك!", "success");
        });
    });

    $('.btn-warning-confirm-all').click(function () {
      var selectedIds = $("input:checkbox:checked").map(function () {
        return $(this).closest('tr').attr('data-mobile-id');
      }).get();
      var _token = '{{csrf_token()}}';
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#281160',
        confirmButtonText: 'Yes, delete it!',
        closeOnConfirm: false
      },
        function () {
          $.ajax({
            type: 'POST',
            url: '{{url('mobile_destroy_all')}}',
            data: { ids: selectedIds, _token: _token },
            success: function (data) {
              $.each(selectedIds, function (key, value) {
                $('tr[data-mobile-id=' + value + ']').fadeOut();
              });
            }
          });
          swal("Deleted!", "Your imaginary file has been deleted!", "success");
        });
    });

    $('.btn-warning-confirm-all-ar').click(function () {
      var selectedIds = $("input:checkbox:checked").map(function () {
        return $(this).closest('tr').attr('data-mobile-id');
      }).get();
      var _token = '{{csrf_token()}}';
      swal({
        title: "هل أنت متأكد ?",
        text: "لن تكون قادرًا على استرداد هذا الملف !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#281160',
        confirmButtonText: 'نعم , احذف هذا!',
        closeOnConfirm: false
      },
        function () {
          $.ajax({
            type: 'POST',
            url: '{{url('mobile_destroy_all')}}',
            data: { ids: selectedIds, _token: _token },
            success: function (data) {
              $.each(selectedIds, function (key, value) {
                $('tr[data-mobile-id=' + value + ']').fadeOut();
              });
            }
          });
          swal("تم الحذف!", "لقد تم حذف ملفلك!", "success");
        });
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