@extends('layouts.app')
@section('content')

              <!-- =============== Custom Content ===========-==========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( 'img/covers/dummy2.jpg ' )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">         
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">@lang('keywords.events')</h3>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="events_backend_add.html">@lang('keywords.add new event')</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="filter__btns"><a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>filters</a></div>
                      <div class="bottomActions__btns"><a class="master-btn btn-warning-cancel-all" href="#">@lang('keywords.deleteSelected')</a>
                      </div>
                      <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
        <form role="form"  method="post" action="{{route('events_filter')}}" accept-charset="utf-8">
          {{csrf_field()}}
                        <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                        <div>
                          <div class="row">
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="filter_cat">@lang('keywords.events categories')</label>
                                <select name="categories[]" class="master_input select2" id="filter_cat" multiple="multiple" style="width:100%;" ,>
                                  <option disabled>Select Category</option>
                                  @foreach($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label">@lang('keywords.EventStatus')</label>
                                <div class="radiorobo">
                                  <input type="radio" value="1" id="event_status_2" name="activation">
                                  <label for="event_status_2">@lang('keywords.active')</label>
                                </div>
                                <div class="radiorobo">
                                  <input type="radio" value="0" id="event_status_3" name="activation">
                                  <label for="event_status_3">@lang('keywords.Not active')</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="bootstrap_date_start_from">@lang('keywords.startDateFrom')</label>
                                <div class="bootstrap-timepicker">
                                  <input name="start_from" class="datepicker master_input" type="text" id="bootstrap_date_start_from">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="bootstrap_date_start_to">@lang('keywords.startDateTo')</label>
                                <div class="bootstrap-timepicker">
                                  <input name="start_to" class="datepicker master_input" type="text" id="bootstrap_date_start_to">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="bootstrap_date_End_from">@lang('keywords.endDateFrom')</label>
                                <div class="bootstrap-timepicker">
                                  <input name="end_from" class="datepicker master_input" type="text" id="bootstrap_date_End_from">
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="bootstrap_date_End_to">@lang('keywords.endDateTo')</label>
                                <div class="bootstrap-timepicker">
                                  <input name="end_to" class="datepicker master_input" type="text" id="bootstrap_date_End_to">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                        <button class="remodal-confirm" type="submit">@lang('keywords.ApplyFilter')</button>
                      </div>
                    </form>
                      <form id="dataTableTriggerId_001_form">
                        <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
                          <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                              <th><span class="cellcontent">@lang('keywords.serial number')</span></th>
                              <th><span class="cellcontent">@lang('keywords.event name')</span></th>
                              <th><span class="cellcontent">@lang('keywords.venue')</span></th>
                              <th><span class="cellcontent">@lang('keywords.events categories')</span></th>
                              <th><span class="cellcontent">@lang('keywords.eventTimeStart')</span></th>
                              <th><span class="cellcontent">@lang('keywords.eventTimeEnd')</span></th>
                              <th><span class="cellcontent">@lang('keywords.Addeddate')</span></th>
                              <th><span class="cellcontent">@lang('keywords.added by')</span></th>
                              <th><span class="cellcontent">@lang('keywords.EventStatus')</span></th>
                              <th><span class="cellcontent">@lang('keywords.Actions')</span></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($events as $event)
                            <tr data-event-id="{{$event->id}}">
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">{{$event->id}}</span></td>
                              <td><span class="cellcontent">{{$event->name}}</span></td>
                              <td><span class="cellcontent">{{$event->venue}}</span></td>
                              <td><span class="cellcontent">
                                @foreach($event->categories as $category)
                                {{$category->name}}<br>
                                @endforeach
                              </span></td>
                              <td><span class="cellcontent">{{$event->start_datetime}}</span></td>
                              <td><span class="cellcontent">{{$event->end_datetime}}</span></td>
                              <td><span class="cellcontent">{{$event->created_at}}</span></td>
                              <td><span class="cellcontent">{{$event->user->username}}</span></td>
                              <td><span class="cellcontent">
                                {!! $event->is_active ? '<i class = "fa icon-in-table-true fa-check"></i>' : '<i class = "fa icon-in-table-false fa-times"></i>' !!}
                                
                                }

                              </span></td>
                              <td><span class="cellcontent"><a href= "{{route('events.show',$event->id)}}" ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= events_backend_edit.html ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o btn-warning-cancel"></i></a></span></td>
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
                  </div>
                </div><br>
              </div>
                @section('js')
                <script type="text/javascript">
                        $('.btn-warning-cancel').click(function(){
          var event_id = $(this).closest('tr').attr('data-event-id');
          var _token = '{{csrf_token()}}';
          swal({
            title: "هل أنت متأكد؟",
            text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'نعم متأكد!',
            cancelButtonText: "إلغاء",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm){
             $.ajax({
               type:'POST',
               url:'{{url('events_destroy')}}'+'/'+event_id,
               data:{_token:_token},
               success:function(data){
                $('tr[data-event-id='+event_id+']').fadeOut();
               }
            });
              swal("تم الحذف!", "تم الحذف بنجاح", "success");
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });

        $('.btn-warning-cancel-all').click(function(){
          var selectedIds = $("input:checkbox:checked").map(function(){
            return $(this).closest('tr').attr('data-event-id');
          }).get();
          var _token = '{{csrf_token()}}';
          swal({
            title: "هل أنت متأكد؟",
            text: "لن تستطيع إسترجاع هذه المعلومة لاحقا",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'نعم متأكد!',
            cancelButtonText: "إلغاء",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm){
             $.ajax({
               type:'POST',
               url:'{{url('events_destroy_all')}}',
               data:{ids:selectedIds,_token:_token},
               success:function(data){
                $.each( selectedIds, function( key, value ) {
                  $('tr[data-event-id='+value+']').fadeOut();
                });
               }
            });
              swal("تم الحذف!", "تم الحذف بنجاح", "success");
            } else {
              swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
            }
          });
        });
        </script>
                @endsection            
@endsection