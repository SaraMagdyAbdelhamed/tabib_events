@extends('layouts.app')

@section('content')

           <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:url( {{ asset('img/covers/dummy2.jpg ') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h4 class="cover-inside-title">@lang('keywords.events')</h4><i class="fa fa-chevron-circle-right"></i>
                            <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.addfromMobile')</h4>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li id="current">@lang('keywords.Current')</li>
                      <li id="pending">@lang('keywords.Pendding')</li>
                      <li id="rejected">@lang('keywords.rejected')</li>
                    </ul>
                    <ul class="tab__content">
                      <li class="tab__content_item active" id="current-content">
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="filter__btns"><a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>@lang('keywords.filter')</a></div>
                            <div class="bottomActions__btns"><a class="{{\App::isLocale('en') ?'btn-warning-confirm-all':'btn-warning-confirm-all-ar'}} master-btn" href="#">@lang('keywords.deleteSelected')</a>
                            </div>
                            <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                               <form role="form" action="{{ route('event_filter') }}" method="POST" accept-charset="utf-8">
                               {{csrf_field()}}
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="filter_cat">@lang('keywords.eventCategories')</label>
                                      <select class="master_input select2" id="filter_cat" multiple="multiple" data-placeholder="Event categories" name="categories[]" style="width:100%;" ,>
                                      @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->nameMultilang}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label"> @lang('keywords.EventsStatus')</label>
                                      <div class="funkyradio">
                                        <input type="checkbox" name="status[]" value="1" id="event_status_2">
                                        <label for="event_status_2">@lang('keywords.Active')</label>
                                      </div>
                                      <div class="funkyradio">
                                        <input type="checkbox" name="status[]"  value="0" id="event_status_3">
                                        <label for="event_status_3">@lang('keywords.Inactive')</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="bootstrap_date_start_from">@lang('keywords.startDateFrom')</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="start date from" id="bootstrap_date_start_from" name="startdate_from">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="bootstrap_date_start_to">@lang('keywords.startDateTo')</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="start date to" id="bootstrap_date_start_to"  name="startdate_to">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="bootstrap_date_End_from">@lang('keywords.endDateFrom')</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="End date from" id="bootstrap_date_End_from" name="enddate_from">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="bootstrap_date_End_to">@lang('keywords.endDateTo')</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="End date to" id="bootstrap_date_End_to" name="enddate_to">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                              <button class="remodal-confirm" type="submit">@lang('keywords.ApplyFilter')</button>
                               </form>
                            </div>
                            <form id="dataTableTriggerId_001_form">
                              <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
                                <thead>
                                  <tr class="bgcolor--gray_mm color--gray_d">
                                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                    <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.eventName')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.venue')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.Startdate/time')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.End date/time')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.Addeddate')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.addby')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.EventStatus')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.Actions')</span></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=0; ?>
                                	@foreach($current_events as $event)
                                  <?php $i++ ?>
                                  <tr data-event-id={{$event->id}}>
                                    <td><span class="cellcontent"></span></td>
                                    <td><span class="cellcontent" ><?=$i?></span></td>
                                    <td><span class="cellcontent">{{$event->nameMultilang}}</span></td>
                                    <td><span class="cellcontent">{{$event->venueMultilang}}</span></td>
                                    <td><span class="cellcontent">{{$event->start_datetime}}</span></td>
                                    <td><span class="cellcontent">{{$event->end_datetime}}</span></td>
                                    <td><span class="cellcontent">{{$event->created_at}}</span></td>
                                    <td><span class="cellcontent">{{ $event->user ? $event->user->username : '' }}</span></td>
                                    <td><span class="cellcontent">@if($event->is_active==1)<i class = "fa icon-in-table-true fa-check"></i>@elseif($event->is_active==0)<i class = "fa icon-in-table-false fa-times"></i>@endif</span></td>
                                    <td><span class="cellcontent"><a href= {{url('/events/mobile/view')}}/{{$event->id}} ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= {{url('/events/mobile/edit')}}/{{$event->id}} ,  class= " action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "{{\App::isLocale('en') ?'btn-warning-confirm':'btn-warning-confirm-ar'}} action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                           <!--  <button id="delete-test">Delete Tests</button> -->
                          </div>
                        </div><br>
                      </li>
                      <li class="tab__content_item" id="pending-content">
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                          <div class="full-table">
                            <div class="bottomActions__btns"><a class="{{\App::isLocale('en') ?'btn-warning-accept-all':'btn-warning-accept-all-ar'}} master-btn" href="#">@lang('keywords.acceptSelected')</a>
                          <a class="{{\App::isLocale('en') ?'btn-warning-confirm-all':'btn-warning-confirm-all-ar'}} master-btn" href="#">Delete selected</a>
                            </div>
                            <form id="dataTableTriggerId_002_form">
                              <table class="data-table-trigger table-master" id="dataTableTriggerId_002">
                                <thead>
                                  <tr class="bgcolor--gray_mm color--gray_d">
                                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                    <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.eventName')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.venue')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.Startdate/time')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.End date/time')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.Addeddate')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.addby')</span></th>
                                 <!--    <th><span class="cellcontent">@lang('keywords.EventStatus')</span></th> -->
                                    <th><span class="cellcontent">@lang('keywords.Actions')</span></th>
                                  </tr>
                                </thead>
                                <tbody>


                                 <?php $i=0; ?>
                                  @foreach($pending_events as $event)
                                   <?php $i++ ?>
                                    <tr data-event-id={{$event->id}}>
                                    <td><span class="cellcontent"></span></td>
                                    <td><span class="cellcontent"><?=$i?></span></td>
                                    <td><span class="cellcontent">{{$event->nameMultilang}}</span></td>
                                    <td><span class="cellcontent">{{$event->venueMultilang}}</span></td>
                                    <td><span class="cellcontent">{{$event->start_datetime}}</span></td>
                                    <td><span class="cellcontent">{{$event->end_datetime}}</span></td>
                                    <td><span class="cellcontent">{{$event->created_at}}</span></td>
                                    <td><span class="cellcontent">{{ $event->user ? $event->user->username : '' }}</span></td>
                                    <td><span class="cellcontent"><a href= {{url('/events/mobile/view')}}/{{$event->id}} ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><button class= "{{\App::isLocale('en') ?'btn-warning-accept':'btn-warning-accept-ar'}} accepted-btn master-btn  action-btn bgcolor--fadepurple  color--white ">@lang('keywords.accept')</button><a href= "#" ,  class= "{{\App::isLocale('en') ?'btn-modal-reject':'btn-modal-reject-ar'}} action-btn bgcolor--fadeorange color--white " data-remodal-target='popupModal_r'>@lang('keywords.reject')</a><a href= "{{url('/events/mobile/edit')}}/{{$event->id}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "{{\App::isLocale('en') ?'btn-warning-confirm':'btn-warning-confirm-ar'}} action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                            <!-- <button class="btn-warning-accept" id="delete-test-2">Accept selected</button> -->
                          </div>
                        </div><br>
                      </li>
                       <li class="tab__content_item " id="rejected-content">

                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                          <div class="full-table">
                           <!--  <div class="filter__btns"><a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>@lang('keywords.filter')</a></div> -->
                            <div class="bottomActions__btns"><a class="{{\App::isLocale('en') ?'btn-warning-accept-all':'btn-warning-accept-all-ar'}} master-btn" href="#">@lang('keywords.acceptSelected')</a><a class="{{\App::isLocale('en') ?'btn-warning-confirm-all':'btn-warning-confirm-all-ar'}} master-btn" href="#">@lang('keywords.deleteSelected')</a>
                            </div>
                            <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                               <form role="form" action="{{ route('event_filter') }}" method="POST" accept-charset="utf-8">
                               {{csrf_field()}}
                              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                              <div>
                                <div class="row">
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="filter_cat">@lang('keywords.eventCategories')</label>
                                      <select class="master_input select2" id="filter_cat" multiple="multiple" data-placeholder="Event categories" name="categories[]" style="width:100%;" ,>
                                      @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->nameMultilang}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label"> @lang('keywords.EventsStatus')</label>
                                      <div class="funkyradio">
                                        <input type="checkbox" name="status[]" value="1" id="event_status_2">
                                        <label for="event_status_2">@lang('keywords.Active')</label>
                                      </div>
                                      <div class="funkyradio">
                                        <input type="checkbox" name="status[]"  value="0" id="event_status_3">
                                        <label for="event_status_3">@lang('keywords.Inactive')</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="bootstrap_date_start_from">@lang('keywords.startDateFrom')</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="start date from" id="bootstrap_date_start_from" name="startdate_from">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="bootstrap_date_start_to">@lang('keywords.startDateTo')</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="start date to" id="bootstrap_date_start_to"  name="startdate_to">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="bootstrap_date_End_from">@lang('keywords.endDateFrom')</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="End date from" id="bootstrap_date_End_from" name="enddate_from">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6 col-xs-12">
                                    <div class="master_field">
                                      <label class="master_label" for="bootstrap_date_End_to">@lang('keywords.endDateTo')</label>
                                      <div class="bootstrap-timepicker">
                                        <input class="datepicker master_input" type="text" placeholder="End date to" id="bootstrap_date_End_to" name="enddate_to">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div><br>
                              <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                              <button class="remodal-confirm" type="submit">@lang('keywords.ApplyFilter')</button>
                               </form>
                            </div>
                            <form id="dataTableTriggerId_003_form">
                              <table class="data-table-trigger table-master" id="dataTableTriggerId_003">
                                <thead>
                                  <tr class="bgcolor--gray_mm color--gray_d">
                                    <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                    <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.eventName')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.venue')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.Startdate/time')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.End date/time')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.Addeddate')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.addby')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.EventStatus')</span></th>
                                    <th><span class="cellcontent">@lang('keywords.Actions')</span></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i=0; ?>
                                  @foreach($rejected_events as $event)
                                  <?php $i++ ?>
                                  <tr data-event-id={{$event->id}}>
                                    <td><span class="cellcontent"></span></td>
                                    <td><span class="cellcontent" ><?=$i?></span></td>
                                    <td><span class="cellcontent">{{$event->nameMultilang}}</span></td>
                                    <td><span class="cellcontent">{{$event->venueMultilang}}</span></td>
                                    <td><span class="cellcontent">{{$event->start_datetime}}</span></td>
                                    <td><span class="cellcontent">{{$event->end_datetime}}</span></td>
                                    <td><span class="cellcontent">{{$event->created_at}}</span></td>
                                    <td><span class="cellcontent">{{ $event->user ? $event->user->username : '' }}</span></td>
                                    <td><span class="cellcontent">@if($event->is_active==1)<i class = "fa icon-in-table-true fa-check"></i>@elseif($event->is_active==0)<i class = "fa icon-in-table-false fa-times"></i>@endif</span></td>
                                    <td><span class="cellcontent"><a class= "{{\App::isLocale('en') ?'btn-warning-accept':'btn-warning-accept-ar'}} accepted-btn master-btn  action-btn bgcolor--fadepurple  color--white ">@lang('keywords.accept')</a><a class= "{{\App::isLocale('en') ?'btn-warning-pending':'btn-warning-pending-ar'}} pendding-btn master-btn  action-btn bgcolor--fadeorange  color--white ">@lang('keywords.Pend')</a><a href= {{url('/events/mobile/view')}}/{{$event->id}} ,  class= "action-btn bgcolor--main color--white "><i class = "fa  fa-eye"></i></a><a href= {{url('/events/mobile/edit')}}/{{$event->id}} ,  class= " action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a><a href="#"  class= "{{\App::isLocale('en') ?'btn-warning-confirm':'btn-warning-confirm-ar'}} action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a></span></td>
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
                           <!--  <button id="delete-test">Delete Tests</button> -->
                          </div>
                        </div><br>
                       </li>
                    </ul>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="remodal" data-remodal-id="popupModal_r" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
                  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
                  <div>
                    <div class="row">
                      <div class="col-lg-12">
                        <h3>@lang('keywords.PLEASE ENTER REJECT REASON')</h3>
                      </div>
                      <div class="col-xs-12">
                        <form role="form"  method="POST" accept-charset="utf-8" id="reject_form">
                           {{csrf_field()}}
                          <input type="hidden" name='event_id' id='eventID' value='placeholder'>
                          <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                            <p class="text-left">@lang('keywords.add Arabic Content')</p>
                            <div class="master_field">
                              <label class="master_label" for="ID_No-12">@lang('keywords.reject reason in arabic')</label>
                              <textarea class="master_input" name="reason-ar" id="ID_No-12" placeholder="reject reason in arabic" Required></textarea><span class="master_message inherit">@lang('keywords.message content')</span>
                            </div>
                            <p class="text-left">@lang('keywords.add English Content')</p>
                            <div class="master_field">
                              <label class="master_label" for="ID_No-15">@lang('keywords.reject reason in english')</label>
                              <textarea class="master_input" name="reason" id="ID_No-15" placeholder="reject reason in English" Required></textarea><span class="master_message inherit">@lang('keywords.message content')</span>
                            </div>
                            <div class="clearfix"></div>
                            <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                            <button class="remodal-confirm" id="reject-submit">@lang('keywords.save')</button>
                            <!-- <button class="remodal-confirm" data-remodal-action="confirm" disabled>@lang('keywords.disabled')</button> -->
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
  <script>
    $(document).ready(function(){
      $('#menu_3').addClass('openedmenu');
      $('#sub_3_2').addClass('pure-active');
    });
  </script>
  @section('js')
  <script type="text/javascript">
           //--Data table trigger --3
      $(document).ready(function(){
        if ( $('html').attr('lang') == 'ar' ) {
          var datatable_three = $("#dataTableTriggerId_003").DataTable({
          'columnDefs': [{
            'targets': 0,
            'searchable':false,
            'orderable':false,
            'className': 'this-include-check',
            'render': function (data, type, full, meta){
              return '<input class="input-in-table" type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
            }
          }],
          'order': [1, 'asc'],
            dom: '   <"row"    <" filterbar" flr + <"sortingr__btns_cont"  >> <"filter__btns_cont"  >    >  <"row"   <"data-table-trigger-cont"  t>    >  <"row"<"tableActions__btns_cont"> <"viewing-pagination"pi>  > ' ,
            "language": {
              "search": "dd",
              "sLengthMenu": "عرض _MENU_  ",
              search: " البحث _INPUT_",
              searchPlaceholder: "ابحث فى الجدول"          ,
              "emptyTable":     "لا توجد بيانات متاحه فى الجدول",
              "info":           "عرض _START_ إلى _END_ من أصل _TOTAL_ مُدخل",
              "infoEmpty":      " عرض  0 to 0 of 0 مُدخل",
              "infoFiltered":   "(filtered from _MAX_ total entries)",
              "loadingRecords": "جارى التحميل...",
              "processing":     "جارى المعالجة...",
              "zeroRecords":    "لا توجد نتائج مطابخة",
              "paginate": {
                "first":      "الاول",
                "last":       "الاخير",
                "next":       "التالى",
                "previous":   "السابق"
              },
              "aria": {
                "sortAscending":  ": رتب تصاعدياً",
                "sortDescending": ": رتب تنازلياً"
              }
            }
          });
      
          //-trigger check one by one 
          $(document).on('click','#dataTableTriggerId_003 tbody tr input.input-in-table',function(){
            var RowParent = $(this).parents('tr') ;
      
            if ( $(this).parents('tr').hasClass('selected') ) {
              $(this).parents('tr').removeClass('selected');
            }
            else {
              $(this).parents('tr').addClass('selected');
            }  
          });
      
          //-trigger check All
          $('#dataTableTriggerId_003 #select-all').on('click',function(){
            if($(this).attr('data-click-state') == 0) {
              $(this).attr('data-click-state',1)
              var rows = datatable_three.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',this.checked).parents('tr').addClass('selected');
      
            } else {
              var rows = datatable_three.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',false).parents('tr').removeClass('selected');
              $(this).attr('data-click-state', 0);
            }
          });
      
         
        
      
      
        } else {
      
          var datatable_three = $("#dataTableTriggerId_003").DataTable({
            'columnDefs': [{
            'targets': 0,
            'searchable':false,
            'orderable':false,
            'className': 'this-include-check',
            'render': function (data, type, full, meta){
              return '<input class="input-in-table" type="checkbox" name="id[]" >';
            }
          }],
          'order': [1, 'asc'],
            dom: '   <"row"    <" filterbar" f + <"quick_filter_cont"  > + lr + <"sortingr__btns_cont"  >> <"filter__btns_cont"  >    >  <"row"   <"data-table-trigger-cont"  t>    >  <"row"<"tableActions__btns_cont"> <"viewing-pagination"pi>  > ' ,
            "language": {
              "search": "dd",
              "sLengthMenu": "Entries _MENU_  ",
              search: " Search _INPUT_",
              searchPlaceholder: "Search table ...."
            }
          });
      
      
          
          $(document).on('click','#dataTableTriggerId_003 tbody tr input.input-in-table',function(){
           var RowParent = $(this).parents('tr') ;
      
           if ( $(this).parents('tr').hasClass('selected') ) {
             $(this).parents('tr').removeClass('selected');
           }
           else {
             $(this).parents('tr').addClass('selected');
           }  
          });
      
          //-trigger check All
          $('#dataTableTriggerId_003 #select-all').on('click',function(){
            if($(this).attr('data-click-state') == 0) {
              $(this).attr('data-click-state',1)
              var rows = datatable_three.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',this.checked).parents('tr').addClass('selected');
      
            } else {
              var rows = datatable_three.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',false).parents('tr').removeClass('selected');
              $(this).attr('data-click-state', 0);
            }
          });
        
          
          
        }
      });
      

      
      
      $(document).ready(function(){
        $(".full-table").each(function() {
          $(this).find(".filter__btns").appendTo($(this).find(".filter__btns_cont"));
          $(this).find(".sortingr__btns").appendTo($(this).find(".sortingr__btns_cont"));
          $(this).find(".bottomActions__btns").appendTo($(this).find(".tableActions__btns_cont"));
          $(this).find(".quick_filter").appendTo($(this).find(".quick_filter_cont"));
          $(this).find(".view_options").appendTo($(this).find(".view_options_cont"));
        });
      });
  </script>
  <script type="text/javascript">
      $(function () {
        $('.datepicker').datepicker({autoclose: true});
      });
    </script>
    <script type="text/javascript">
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
    </script>

    <!-- delete -->
    <script type="text/javascript">
      $(document).ready(function () {
        // "use strict";
        $('.btn-warning-confirm').click(function () {
          var event_id = $(this).closest('tr').attr('data-event-id');
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
                url: '{{url('event_destroy')}}' + '/' + event_id,
                data: { _token: _token },
                success: function (data) {
                  $('tr[data-event-id=' + event_id + ']').fadeOut();
                  swal("Deleted!", "Your imaginary file has been deleted!", "success");
                }
              });
              
            });
        });

        $('.btn-warning-confirm-ar').click(function () {
          var event_id = $(this).closest('tr').attr('data-event-id');
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
                url: '{{url('event_destroy')}}' + '/' + event_id,
                data: { _token: _token },
                success: function (data) {
                  $('tr[data-event-id=' + event_id + ']').fadeOut();
                  swal("تم الحذف!", "لقد تم حذف ملفلك!", "success");
                }
              });
              
            });
        });

        $('.btn-warning-confirm-all').click(function () {
          var selectedIds = $("input:checkbox:checked").map(function () {
            return $(this).closest('tr').attr('data-event-id');
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
                url: '{{url('event_destroy_all')}}',
                data: { ids: selectedIds, _token: _token },
                success: function (data) {
                  $.each(selectedIds, function (key, value) {
                    $('tr[data-event-id=' + value + ']').fadeOut();
                  });
                   swal("Deleted!", "Your imaginary file has been deleted!", "success");
                }
              });
             
            });
        });

        $('.btn-warning-confirm-all-ar').click(function () {
          var selectedIds = $("input:checkbox:checked").map(function () {
            return $(this).closest('tr').attr('data-event-id');
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
                url: '{{url('event_destroy_all')}}',
                data: { ids: selectedIds, _token: _token },
                success: function (data) {
                  $.each(selectedIds, function (key, value) {
                    $('tr[data-event-id=' + value + ']').fadeOut();
                     swal("تم الحذف!", "لقد تم حذف ملفلك!", "success");
                  });
                }
              });
             
            });
        });

      });
    </script>
    <!-- Accept -->
    <script type="text/javascript">
      $(document).ready(function () {

        $('.btn-warning-accept').click(function () {
          var event_id = $(this).closest('tr').attr('data-event-id');
          var _token = '{{csrf_token()}}';
              $.ajax({
                type: 'POST',
                url: '{{url('event_accept')}}' + '/' + event_id,
                data: { _token: _token },
                success: function (data) {
                  $('tr[data-event-id=' + event_id + ']').fadeOut();
                   swal("Accepted", "You can find this event in Current Tab", "success");
                 window.location.replace("{{ url('events/mobile') }}");
                }
              });
             

        });

        $('.btn-warning-accept-ar').click(function () {
          var event_id = $(this).closest('tr').attr('data-event-id');
          var _token = '{{csrf_token()}}';
              $.ajax({
                type: 'POST',
                url: '{{url('event_accept')}}' + '/' + event_id,
                data: { _token: _token },
                success: function (data) {
                  $('tr[data-event-id=' + event_id + ']').fadeOut();
                  swal("تم القبول", "يمكنك ايجاد هذا الحدث في قائمة الأحداث الحالية", "success");

               window.location.replace("{{ url('events/mobile') }}");
                }
              });
              

        });

        $('.btn-warning-accept-all').click(function () {
          var selectedIds = $("input:checkbox:checked").map(function () {
            return $(this).closest('tr').attr('data-event-id');
          }).get();
          var _token = '{{csrf_token()}}';
              $.ajax({
                type: 'POST',
                url: '{{url('event_accept_all')}}',
                data: { ids: selectedIds, _token: _token },
                success: function (data) {
                  $.each(selectedIds, function (key, value) {
                    $('tr[data-event-id=' + value + ']').fadeOut();
                  });
                    swal("Accepted", "You can find these events in Current Tab", "success");
                //window.location.replace("{{ url('events/mobile') }}");
                window.location.reload(true);
                }
              });
              
        });

        $('.btn-warning-accept-all-ar').click(function () {
          var selectedIds = $("input:checkbox:checked").map(function () {
            return $(this).closest('tr').attr('data-event-id');
          }).get();
          var _token = '{{csrf_token()}}';
              $.ajax({
                type: 'POST',
                url: '{{url('event_accept_all')}}',
                data: { ids: selectedIds, _token: _token },
                success: function (data) {
                  $.each(selectedIds, function (key, value) {
                    $('tr[data-event-id=' + value + ']').fadeOut();
                       swal("تم القبول", "يمكنك ايجاد الاحداث المقبولة في قائمة الأحداث الحالية", "success");
              // window.location.replace("{{ url('events/mobile') }}");
              location = "{{ url('events/mobile') }}" ; 
              window.location.reload(true);
                  });
                }
              });
           

        });

         $('.btn-warning-pending').click(function () {
          var event_id = $(this).closest('tr').attr('data-event-id');
          var _token = '{{csrf_token()}}';
              $.ajax({
                type: 'POST',
                url: '{{url('event_pending')}}' + '/' + event_id,
                data: { _token: _token },
                success: function (data) {
                  $('tr[data-event-id=' + event_id + ']').fadeOut();
                    swal("pending", "You can find this event in Pending Tab", "success");
              // window.location.replace("{{ url('events/mobile') }}");
              location = "{{ url('events/mobile') }}" ; 
                location.reload(true);
                }
              });
            
        });

         $('.btn-warning-pending-ar').click(function () {
          var event_id = $(this).closest('tr').attr('data-event-id');
          var _token = '{{csrf_token()}}';
              $.ajax({
                type: 'POST',
                url: '{{url('event_pending')}}' + '/' + event_id,
                data: { _token: _token },
                success: function (data) {
                  $('tr[data-event-id=' + event_id + ']').fadeOut();
                     swal("تم", "تم  وضع الحدث تحت قائمة الاحداث المعلقة", "success");
              location = "{{ url('events/mobile') }}" ; 
              location.reload(true);
                }
              });


        });


      });
    </script>

        <!-- reject -->
    <script type="text/javascript">
      
      $(document).ready(function () {
        //test1
       /* $('.btn-modal-reject').click(function () {
          var event_id = $(this).closest('tr').attr('data-event-id');
          //alert(event_id);
          var _token = '{{csrf_token()}}';
         var inst = jQuery('[data-remodal-id=popupModal_r').remodal();
         inst.open();
        });*/

        //test2
       // declare global var
       var gEventId;
       // register click event for anchor
       $("[data-remodal-target='popupModal_r']").click(function(){
       // assign into global var
       gEventId = $(this).closest('tr').attr('data-event-id');
        });

       $(document).on('opening', '.remodal', function () {
       // let catch the global var
       var event_id = gEventId;
      //alert( 'The event id is ' + event_id );
       $('#eventID').val( event_id );
       });

       //ajax submit

        $('#reject_form').on('submit', function(e) {
       e.preventDefault(); 
       var _token = '{{csrf_token()}}';
       var reason_ar = $('#ID_No-12').val();
       var reason = $('#ID_No-15').val();
       var event_id = $('#eventID').val();
       $.ajax({
           type: "POST",
           url: '{{ url('event_reject') }}',
           data: {_token: _token ,reason_ar:reason_ar, reason:reason, event_id:event_id},
           success: function( msg ) {
               $("#reject_form").append("<div>"+msg.msg+"</div>");

           // document.getElementById('reject-submit').disabled = true;   
               window.location.replace("{{ url('events/mobile') }}");

           }
       });
       document.getElementById('reject-submit').disabled = true; 
       return false;
   });

      });
    </script>
@endsection @endsection
