@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image: url({{ asset( '/img/covers/dummy2.jpg ' ) }})   ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">         
            <div class="text-wraper">
              <h3 class="cover-inside-title  ">@lang('keywords.events')</h3>
            </div>
          </div>
        </div>
        <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="{{route('events.create')}}">@lang('keywords.addNewBackend')</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
      <div class="full-table">
        <div class="filter__btns"><a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>@lang('keywords.filter')</a></div>
        <div class="bottomActions__btns">
          {{-- Delete Selected --}}
          <a class="master-btn "  id="deleteSelected">@lang('deleteSelected')</a>
        </div>
        <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
          <form action="{{ route('events.filter') }}" method="POST">
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="filter_cat">@lang('keywords.eventCategories')</label>
                    <select class="master_input select2" id="filter_cat" multiple="multiple" style="width:100%;" name="categories[]">
                      @if ( isset($categories) && !empty($categories) )
                          @foreach ($categories as $cat)
                              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label">@lang('keywords.EventStatus')</label>
                    <div class="radiorobo">
                      <input type="radio" id="event_status_2" name="is_active">
                      <label for="event_status_2">@lang('keywords.Active')</label>
                    </div>
                    <div class="radiorobo">
                      <input type="radio" id="event_status_3" name="is_active">
                      <label for="event_status_3">@lang('keywords.Inactive')</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_start_from">@lang('keywords.startDateFrom')</label>
                    <div class="bootstrap-timepicker">
                      <input class="datepicker master_input" type="text" id="bootstrap_date_start_from" name="start_from">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_start_to">@lang('keywords.startDateTo')</label>
                    <div class="bootstrap-timepicker">
                      <input class="datepicker master_input" type="text" id="bootstrap_date_start_to" name="start_to">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_End_from">@lang('keywords.endDateFrom')</label>
                    <div class="bootstrap-timepicker">
                      <input class="datepicker master_input" type="text" id="bootstrap_date_End_from" name="end_from">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_End_to">@lang('keywords.endDateto')</label>
                    <div class="bootstrap-timepicker">
                      <input class="datepicker master_input" type="text" id="bootstrap_date_End_to" name="end_to">
                    </div>
                  </div>
                </div>
              </div>
            </div><br>
            <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
            <button class="remodal-confirm" data-remodal-action="confirm">@lang('keywords.filter')</button>
          </form>
        </div>
        <form id="dataTableTriggerId_001_form">
          <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
            <thead>
              <tr class="bgcolor--gray_mm color--gray_d">
                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                <th><span class="cellcontent">@lang('keywords.eventName')</span></th>
                <th><span class="cellcontent">@lang('keywords.address')</span></th>
                <th><span class="cellcontent">@lang('keywords.eventCat')</span></th>
                <th><span class="cellcontent">@lang('keywords.eventDateStart')</span></th>
                <th><span class="cellcontent">@lang('keywords.eventDateEnd')</span></th>
                <th><span class="cellcontent">@lang('keywords.RegisterationDate')</span></th>
                <th><span class="cellcontent">@lang('keywords.addby')</span></th>
                <th><span class="cellcontent">@lang('keywords.status')</span></th>
                <th><span class="cellcontent">@lang('keywords.actions')</span></th>
              </tr>
            </thead>
            <tbody>
              @if ( isset($events) && !empty($events) )
                  @foreach ($events as $event)
                  <tr data-id="{{$event->id}}">
                    <td><span class="cellcontent"></span></td>
                    <td><span class="cellcontent">{{ $loop->index + 1 }}</span></td>
                    <td><span class="cellcontent">{{ $event->name    ? : __('keywords.not') }}</span></td>
                    <td><span class="cellcontent">{{ $event->address ? : __('keywords.not') }}</span></td>
                    <td>
                      <span class="cellcontent">
                        @foreach ($event->categories as $cat)
                            {{ $cat->name }} {{ count($event->categories) != $loop->index+1 ? ' - ' : '.' }}
                        @endforeach
                      </span>
                    </td>
                    <td><span class="cellcontent">{{ $event->start_datetime ? $event->start_datetime->format('Y/m/d H:i A') : __('keywords.not') }}</span></td>
                    <td><span class="cellcontent">{{ $event->end_datetime   ? $event->end_datetime->format('Y/m/d H:i A')   : __('keywords.not') }}</span></td>
                    <td><span class="cellcontent">{{ $event->created_at     ? $event->created_at->format('Y/m/d H:i A')     : __('keywords.not') }}</span></td>
                    <td><span class="cellcontent">{{ $event->created_by     ? $event->createdBy->first_name ." ". $event->createdBy->last_name : __('keywords.not') }}</span></td>
                    <td>
                      <span class="cellcontent">
                        <i class="fa {{ $event->is_active ? 'icon-in-table-true fa-check' : 'icon-in-table-false fa-times' }}"></i>
                      </span>
                    </td>
                    <td>
                      <span class="cellcontent">

                        {{-- View Event --}}
                        <a href="{{ route('events.show', $event->id) }}" class= "action-btn bgcolor--main color--white ">
                          <i class = "fa  fa-eye"></i>
                        </a>
                        
                        {{-- Edit Event --}}
                        <a href="{{ route('events.edit', $event->id) }}"  class= "action-btn bgcolor--fadegreen color--white ">
                          <i class = "fa  fa-pencil"></i>
                        </a>
                        
                        {{-- Delete Event --}}
                        <a   class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white deleteRecord">
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
            
@endsection

@section('js')
<script>
$(document).ready(function(){
 $('#deleteSelected').click(function(){
            var allVals = [];                   // selected IDs
            var token = '{{ csrf_token() }}';

            // push cities IDs selected by user
            $('input.input-in-table:checked').each(function() {
                allVals.push( $(this).data("id") );
            });

            // check if user selected nothing
            if(allVals.length <= 0) {
            confirm('إختر حدث علي الاقل لتستطيع حذفه');
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
                    url: "{{ route('event_backend.deleteSelected') }}",
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        "ids": ids,
                        "_method": 'POST',
                        "_token": token,
                    },
                    success: function (data)
                    {
                     // alert(allVals);
                      // fade out selected checkboxes after deletion
                        $.each(allVals, function( index, value ) {
                            $('tr[data-id='+value+']').fadeOut();
                        });
                       

                        
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
                 swal("تم الحذف!", "تم الحذف بنجاح", "success");
                } else {
                swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                }
            });
            }
        });

        // delete a row
        $('.deleteRecord').click(function(){
            // alert('hi');
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
                    success: function(data)
                    {
                       
                        $('tr[data-id='+id+']').fadeOut();
                    },
                        error: function(response) {
                        console.log(response);
                    }
                });
                 swal("تم الحذف!", "تم الحذف بنجاح", "success");
                    
                } else {
                    swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                }
            });
        });

      });
</script>
@endsection