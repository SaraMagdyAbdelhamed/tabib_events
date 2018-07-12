@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg ') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">         
              <div class="text-wraper">
                <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.famousAtt')</h4>
              </div>
            </div>
          </div>
          <div class="cover--actions">
            <a class="bradius--no border-btn master-btn" type="button" href="{{ route('fa.create') }}">@lang('keywords.addNew')</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
        <div class="full-table">
          <div class="filter__btns"><a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>@lang('keywords.filter')</a></div>
          <div class="bottomActions__btns">
            <a class="master-btn" href="#" id="deleteSelected">@lang('keywords.deleteSelected')</a>
            <a class="master-btn" href="{{ route('event_backend.add') }}">@lang('keywords.addNewBackend')</a>
          </div>
          <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>

            <form action="{{ route('fa.filter') }}" method="POST">
              {{ csrf_field() }}

              <div>
                <div class="row">
                  <div class="col-xs-12">
                    <h3>@lang('keywords.filter')</h3>
                  </div>

                  {{-- Start categories --}}
                  <div class="col-sm-6 col-xs-12">
                    <div class="master_field">
                      <label class="master_label" for="filter_cat">@lang('keywords.placeCategories')</label>
                      <select class="master_input select2" id="filter_cat" name="place_categories[]" multiple="multiple" data-placeholder="place categories" style="width:100%;" ,>
                        @if ( isset($categories) && !empty($categories) )
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ \App::isLocale('en') ? $cat->name : \Helper::localization('fa_categories', 'name', $cat->id, 2, $cat->name) }}</option>
                            @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  {{-- End categories --}}

                  {{-- Start active & in-active checkboxes --}}
                  <div class="col-sm-6 col-xs-12">
                    <div class="master_field">
                      <label class="master_label">@lang('keywords.status')</label>
                      <div class="funkyradio">
                        <input type="checkbox" name="is_active" id="event_status_2" value="1">
                        <label for="event_status_2">@lang('keywords.Active')</label>
                      </div>
                      <div class="funkyradio">
                        <input type="checkbox" name="is_inActive" id="event_status_3" value="1">
                        <label for="event_status_3">@lang('keywords.Inactive')</label>
                      </div>
                    </div>
                  </div>
                  {{-- End active & in-active checkboxes --}}

                </div>
              </div><br>
              <button class="remodal-cancel" data-remodal-action="cancel">Cancel</button>
              <button class="remodal-confirm" type="submit">Apply Filters</button>
            </form>

          </div>
          <form id="dataTableTriggerId_001_form">
            <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
              <thead>
                <tr class="bgcolor--gray_mm color--gray_d">
                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                  <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                  <th><span class="cellcontent">@lang('keywords.placeName')</span></th>
                  <th><span class="cellcontent">@lang('keywords.placeAddress')</span></th>
                  <th><span class="cellcontent">@lang('keywords.placePhone')</span></th>
                  <th><span class="cellcontent">@lang('keywords.placeCategories')</span></th>
                  <th><span class="cellcontent">@lang('keywords.status')</span></th>
                  <th><span class="cellcontent">@lang('keywords.actions')</span></th>
                </tr>
              </thead>
              <tbody>

                  @if ( isset($attractions) && !empty($attractions) )
                      @foreach ($attractions as $attraction)
                        <tr data-id="{{ $attraction->id }}">
                          <td><span class="cellcontent" data-id="{{ $attraction->id }}"></span></td>
                          <td><span class="cellcontent">{{ $loop->index+1 }}</span></td>
                          <td><span class="cellcontent">{{ \App::isLocale('en') ? $attraction->name : \Helper::localization('famous_attractions', 'name', $attraction->id, 2, $attraction->name) }}</span></td>
                          <td><span class="cellcontent">{{ \App::isLocale('en') ? $attraction->address : \Helper::localization('famous_attractions', 'address', $attraction->id, 2, $attraction->address) }}</span></td>
                          <td><span class="cellcontent">{{ $attraction->phone ? : '' }}</span></td>
                          <td>
                            <span class="cellcontent">
                              @foreach ($attraction->categories as $cat)
                                  {{ \App::isLocale('en') ? $cat->name : \Helper::localization('fa_categories', 'name', $cat->id, 2, $cat->name) }}
                                  {{ count($attraction->categories) != $loop->index+1  ? ',' : '' }}
                              @endforeach
                            </span>
                          </td>
                          <td>
                            <span class="cellcontent">
                              <i class = "{{ $attraction->is_active ? 'fa icon-in-table-true fa-check' : 'fa icon-in-table-false fa-times' }}"></i>
                            </span>
                          </td>
                          <td>
                            <span class="cellcontent">
                              <a href= #popupModal_1 ,  class= "action-btn bgcolor--main color--white showRow" data-id="{{ $attraction->id }}">
                                <i class = "fa  fa-eye"></i>
                              </a>
                              <a href="{{ route('fa.edit', $attraction->id) }}"  class= " action-btn bgcolor--fadegreen color--white ">
                                <i class = "fa  fa-pencil"></i>
                              </a>
                              <a href="#" data-id="{{ $attraction->id }}"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white deleteRecord">
                                <i class = "fa  fa-trash-o"></i>
                              </a>
                            </span>
                          </td>
                        </tr>               
                      @endforeach
                  @endif
                  
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
      </div>
    </div><br>
</div>

<div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
    <div>
      <div class="row">
        <div class="col-xs-12"></div>
        <h3 id="place_title"></h3>
        <div class="col-xs-12">
          <div class="tabs--wrapper">
            <div class="clearfix"></div>
            <ul class="tabs">
              <li id="info">@lang('keywords.info')</li>
              <li id="media">@lang('keywords.media')</li>
            </ul>
            <ul class="tab__content">
              <li class="tab__content_item active" id="info-content">
                <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                  <div class="full-table">
                    <table class="verticaltable table-master">
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.placeName')</span></th>
                        <td><span class="cellcontent" id="place_name"></span></td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.placeCategories')</span></th>
                        <td><span class="cellcontent" id="place_categories"></span></td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.address')</span></th>
                        <td><span class="cellcontent" id="place_address"></span></td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.Phone')</span></th>
                        <td><span class="cellcontent" id="phone"></span></td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.website')</span></th>
                        <td style="text-align: {{ \App::isLocale('en') ? 'left' : 'right' }} !important; text-transform: lowercase !important;">
                          <a href="https://www.test.com/" id="website">test</a>
                        </td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.openday')</span></th>
                        <td><span class="cellcontent" id="days"></span></td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.Startdate/time')</span></th>
                        <td><span class="cellcontent" id="start">12:00PM</span></td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.End date/time')</span></th>
                        <td><span class="cellcontent" id="end">12:00AM</span></td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.status')</span></th>
                        <td style="text-align: {{ \App::isLocale('en') ? 'left' : 'right' }} !important; text-transform: lowercase !important;">
                          <i id="is_active"></i>
                        </td>
                      </tr>
                      <tr>
                        <th><span class="cellcontent">@lang('keywords.otherInfo')</span></th>
                        <td><span class="cellcontent" id="other_info"></span></td>
                      </tr>
                    </table>
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
                  <div class="clearfix"></div>
                </div>
              </li>
              <li class="tab__content_item" id="media-content">
                <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                  <div class="col-xs-12">
                    <h5 class="text-left">images</h5>
                  </div>
                  <div class="col-xs-12">
                    <div class="slideperview" id="slider--3">
                      <div class="swiper-container">
                        <img class="full-size" id="image_modal">

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"> </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="col-xs-12">
                  <h5 class="text-left">video</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                      <iframe id="youtube_ar" width="420" height="315" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                      <iframe id="youtube_en" width="420" height="315" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12">
          <button class="remodal-confirm" data-remodal-action="confirm">Close</button>
        </div>
      </div>
    </div>
</div>


{{-- Start Scripts --}}
<script>
    $(document).ready(function(){
        // Sidebar Active Class
        $('#menu_5').addClass('openedmenu');
        $('#sub_5_1').addClass('pure-active');
    });

    // delete single row
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
              url: "{{ route('fa.delete') }}",
              type: 'POST',
              dataType: "JSON",
              data: {
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

    $('#deleteSelected').click(function(){
      var allVals = [];                   // selected IDs
      var token = '{{ csrf_token() }}';

      // push cities IDs selected by user
      $('input.input-in-table:checked').each(function() {
          allVals.push( $(this).data("id") );
      });

      // check if user selected nothing
      if(allVals.length <= 0) {
      confirm('إختر عميل علي الاقل لتستطيع حذفه');
      } else {
      var ids = allVals;    // join array of IDs into a single variable to explode in controller

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
              url: "{{ route('event_backend.destroySelected') }}",
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


    // AJAX: get record info
    $('.showRow').click(function(){
        // Get ID of that record
        var id = $(this).data("id");    

        // AJAX call to get record data
        $.ajax({
            url: "{{ route('fa.show') }}",
            type: 'GET',
            data: {id: id, lang: '{{ \App::isLocale('en') ? 'en' : 'ar' }}' },

            // On success, set retrieved data to edit input fields
            success: function (data)
            { console.log(data);

                // Get data from JSON object & assign it to the HTML elements.
                $("#place_title").text(data.name);
                $("#place_name").text(data.name);  
                $("#place_categories").text(data.categories);
                $("#place_address").text(data.address);
                $("#phone").text(data.phone);
                $("a#website").text(data.website.replace(/(^\w+:|^)\/\//, ''));
                $("a#website").attr("href", data.website);
                $("#days").text(data.days);
                $("#other_info").text(data.info);
                $('#start').text(data.start);
                $("#end").text(data.end);

                if(data.is_active) {
                    $("#is_active").addClass('fa icon-in-table-true fa-check');
                } else {
                    $("#is_active").addClass('fa icon-in-table-false fa-times');
                }

                $("#image_modal").attr("src", data.image);

                // get youtube URLs from JSON object
                var youtube_ar = data.youtube_ar;
                var youtube_en = data.youtube_en;

                // change youtube URL that it was copied & pasted from browser URL to the embeded format.
                // the difference between the regular youtube URL and youtube embedded URL in just in `watch?v=` 
                // so we will replace it with the `embed/` keyword to be embedded in the HTML elements.
                var youtube_ar_embed = youtube_ar.replace('watch?v=', 'embed/');
                var youtube_en_embed = youtube_en.replace('watch?v=', 'embed/');

                // set formated youtube URLs to the HTML elements.
                $("#youtube_ar").attr("src", youtube_ar_embed);
                $("#youtube_en").attr("src", youtube_en_embed);

            },
                error: function(response) {
                console.log( response.responseJSON );
            }
        });


    });
</script>
{{-- End Scripts --}}


@endsection