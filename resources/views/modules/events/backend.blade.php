@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg ') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">
              <div class="text-wraper">
                <h4 class="cover-inside-title">@lang('keywords.events') </h4><i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.addfrombackend') </h4>
              </div>
            </div>
          </div>
          <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="{{ route('event_backend.add') }}">@lang('keywords.addNew')</a>
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
            <a class="master-btn" href="{{ route('event_backend.add') }}">@lang('keywords.addNew')</a>
          </div>
          <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>

            {{-- Start form --}}
            <form action="{{ route('event_backend.filter') }}" method="GET">
              {{ csrf_field() }}

            <div>
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="filter_cat">@lang('keywords.eventCategories')</label>
                    <select class="master_input select2" id="filter_cat" multiple="multiple" data-placeholder="choose a category..." style="width:100%;" name="categories[]">
                      @if ( isset($categories) && !empty($categories) )
                          @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label">@lang('keywords.EventsStatus')</label>
                    <div class="funkyradio">
                      <input type="checkbox" name="active" id="event_status_2" value="1">
                      <label for="event_status_2">@lang('keywords.Active')</label>
                    </div>
                    <div class="funkyradio">
                      <input type="checkbox" name="inactive" id="event_status_3" value="1">
                      <label for="event_status_3">@lang('keywords.Inactive')</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_start_from">@lang('keywords.startDateFrom')</label>
                    <div class="bootstrap-timepicker">
                      <input class="datepicker master_input" type="text" placeholder="start date from" id="bootstrap_date_start_from" name="start_from" />
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_start_to">@lang('keywords.startDateTo')</label>
                    <div class="bootstrap-timepicker">
                      <input class="datepicker master_input" type="text" placeholder="start date from" id="bootstrap_date_start_from" name="start_to">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_End_from">@lang('keywords.endDateFrom')</label>
                    <div class="bootstrap-timepicker">
                      <input class="datepicker master_input" type="text" placeholder="set end date from" id="bootstrap_date_End_from" name="end_from">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_End_to">@lang('keywords.endDateTo')</label>
                    <div class="bootstrap-timepicker">
                      <input class="datepicker master_input" type="text" placeholder="set end date to" id="bootstrap_date_End_to" name="end_to">
                    </div>
                  </div>
                </div>
              </div>
            </div><br>
            <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
            <button class="remodal-confirm" type="submit">@lang('keywords.ApplyFilter')</button>
            </form>
            {{-- End form --}}

          </div>
          <form id="dataTableTriggerId_001_form">
            <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
              <thead>
                <tr class="bgcolor--gray_mm color--gray_d">
                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                  <th><span class="cellcontent">@lang('keywords.serialNo') </span></th>
                  <th><span class="cellcontent">@lang('keywords.eventName')</span></th>
                  <th><span class="cellcontent">@lang('keywords.venue')</span></th>
                  <th><span class="cellcontent">@lang('keywords.start') </span></th>
                  <th><span class="cellcontent">@lang('keywords.end') </span></th>
                  <th><span class="cellcontent">@lang('keywords.Addeddate') </span></th>
                  <th><span class="cellcontent">@lang('keywords.addby') </span></th>
                  <th><span class="cellcontent">@lang('keywords.EventStatus') </span></th>
                  <th><span class="cellcontent">@lang('keywords.actions')</span></th>
                </tr>
              </thead>
              <tbody>

                @if ( isset($events) && !empty($events) )
                    @foreach ($events as $event)
                        <tr data-id="{{ $event->id }}">
                            <td><span class="cellcontent" data-id="{{ $event->id }}"></span></td>
                            <td><span class="cellcontent">{{ $loop->index +1 }}</span></td>
                            <td><span class="cellcontent">{{ \App::isLocale('en') ? $event->name : \Helper::localization('events', 'name', $event->id, 2, '') }}</span></td>
                            <td><span class="cellcontent">{{ \App::isLocale('en') ? $event->venue : \Helper::localization('events', 'venue', $event->id, 2, '') }}</span></td>
                            <td><span class="cellcontent">{{ $event->start_datetime ? $event->start_datetime->format('Y-m-d h:i A') : '' }}</span></td>
                            <td><span class="cellcontent">{{ $event->end_datetime ? $event->end_datetime->format('Y-m-d h:i A') : '' }}</span></td>
                            <td><span class="cellcontent">{{ $event->created_at ? $event->created_at->format('Y-m-d h:i A') : '' }}</span></td>
                            <td><span class="cellcontent">{{ $event->user ? $event->user->first_name.' '.$event->user->last_name : '' }}</span></td>
                            <td><span class="cellcontent"><i class = "{{ $event->is_active ? ($event->is_active == 0 ? 'fa icon-in-table-false fa-times' : 'fa icon-in-table-true fa-check' ) : 'fa icon-in-table-false fa-times' }}"></i></i></span></td>
                            <td>
                                <span class="cellcontent">
                                    <a href="{{ route('event_backend.show', $event->id) }}" class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a>
                                    <a href="{{ route('event_backend.edit', $event->id) }}"  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a>
                                    <a href="#" data-id="{{ $event->id }}"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white deleteRecord "><i class = "fa  fa-trash-o"></i></a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endif

              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div><br>
  </div>

<script>
  $(document).ready(function(){
    $('#menu_3').addClass('openedmenu');
    $('#sub_3_1').addClass('pure-active');
  });
</script>

<script>
              // delete multi
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
              url: "{{ route('event_backend.destroy') }}",
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
</script>

<script>
  $(document).ready(function(){
    $(function () {
        $('.datepicker').datepicker({autoclose: true});
      });

    var swiper = new Swiper('.slideperview .swiper-container', {
      pagination: '.swiper-pagination',
      slidesPerView: 3,
      paginationClickable: true,
      spaceBetween: 5,
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
      autoplay: 2500,
      keyboardControl: true,
      loop: true,
      autoplayDisableOnInteraction: false,
      mousewheelControl: false,
    });
    
  });
</script>

@endsection
