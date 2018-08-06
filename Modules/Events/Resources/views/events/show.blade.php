@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url({{ asset('/img/covers/dummy2.jpg ')  }}  )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">         
              <div class="text-wraper">
                <h3 class="cover-inside-title  ">{{ $event->name ? : __('keywords.events') }}</h3>
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
          <li id="info">@lang('keywords.aboutEvent')</li>
          <li id="survey">@lang('keywords.surveys')</li>
          <li id="tickets">@lang('keywords.tickets')</li>
        </ul>
        <ul class="tab__content">
          <li class="tab__content_item active" id="info-content">
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="full-table">
                <table class="verticaltable table-master">
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.eventName')</span></th>
                    <td><span class="cellcontent">{{ $event->name ? : __('keywords.not') }}</span></td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.address')</span></th>
                    <td><span class="cellcontent">{{ $event->address ? : __('keywords.not') }}</span></td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.eventDateStart')</span></th>
                    <td><span class="cellcontent">{{ $event->start_datetime ? $event->start_datetime->format('Y/m/d H:i A') : '' }}</span></td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.eventDateEnd')</span></th>
                    <td><span class="cellcontent">{{ $event->end_datetime ? $event->end_datetime->format('Y/m/d H:i A') : '' }}</span></td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.addby')</span></th>
                    <td><span class="cellcontent">{{ $event->createdBy->first_name .' '. $event->createdBy->last_name }}</span></td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.eventCat')</span></th>
                    <td>
                        <span class="cellcontent">
                            @foreach ($event->categories as $cat)
                                {{ $cat->name }} {{ count($event->categories) != $loop->index+1 ? ' - ' : '.' }}
                            @endforeach
                        </span>
                    </td>
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
          <li class="tab__content_item" id="survey-content">
              @if($questions->count()==0)
                <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                  <p class="text-center">there is no surveys for this event</p>
                </div>
              @endif
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="full-table">
                <div class="bottomActions__btns">
                </div>
                <form id="dataTableTriggerId_003_form">
                  <table class="data-table-trigger table-master" id="dataTableTriggerId_003">
                      <thead>
                          <tr class="bgcolor--gray_mm color--gray_d">
                            <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                            <th><span class="cellcontent">@lang('keywords.serial number')</span></th>
                            <th><span class="cellcontent">@lang('keywords.survey name')</span></th>
                            <th><span class="cellcontent">@lang('keywords.Squestion')</span></th>
                            <th><span class="cellcontent">@lang('keywords.answer') 1</span></th>
                            <th><span class="cellcontent">@lang('keywords.answer') 2</span></th>
                            <th><span class="cellcontent">@lang('keywords.answer') 3</span></th>
                            <th><span class="cellcontent">@lang('keywords.answer') 4</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($questions as $question)
                            <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">{{$question->id}}</span></td>
                              <td><span class="cellcontent">{{$question->survey->name}}</span></td>
                              <td><span class="cellcontent">{{$question->name}}</span></td>
                              @foreach($question->answers->take(4) as $answer)
                                <td>
                                  <span class="cellcontent">{{$answer->name}}</span>
                                </td>
                              @endforeach
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
          </li>
          <li class="tab__content_item" id="tickets-content">
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <p class="text-center">
                @if ( $event->is_paid == 1 )
                    @lang('keywords.foundTickets') {{ $event->tickets()->first()->current_available_tickets ? : 0 }} @lang('keywords.ticket') 
                @else 
                  @lang('keywords.noTickets')
                @endif
              </p>
            </div>
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="full-table">
                <table class="verticaltable table-master">
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.price')</span></th>
                    <td>
                        <span class="cellcontent">
                            @if ( $event->is_paid == 1 )
                                {{ count($event->tickets) ? $event->tickets()->first()->price : __('keywords.free') }}  {{ count($event->tickets) ? $event->tickets()->first()->currency->symbol: '' }}                                    
                            @else
                                {{ __('keywords.free') }}
                            @endif
                        </span>
                    </td>
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
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="col-xs-12" style="text-align:end;">
                <h4><strong> بيانات التذكرة</strong></h4>
              </div>
              <div class="full-table">
                <form id="dataTableTriggerId_002_form">
                  <table class="data-table-trigger table-master" id="dataTableTriggerId_002">
                        <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                                <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                                <th><span class="cellcontent">@lang('keywords.Ticket Barcode')</span></th>
                                <th><span class="cellcontent">@lang('keywords.Ticket serial')</span></th>
                                <th><span class="cellcontent">@lang('keywords.Ticket Status')</span></th>
                                <th><span class="cellcontent">@lang('keywords.UserName')</span></th>
                                <th><span class="cellcontent">@lang('keywords.Booking date')</span></th>
                                <th><span class="cellcontent">@lang('keywords.Status')</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ( $event->is_paid == 1 && isset($event->tickets) && !empty($event->tickets) )
                                @foreach($event->tickets as $ticket)
                                <tr>
                                    <td><span class="cellcontent"></span></td>
                                    <td><span class="cellcontent">{{ $loop->index+1 }}</span></td>
                                    <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                                    <td><span class="cellcontent">{{ $ticket->serial_number ? : '' }}</span></td>
                                    <td><span class="cellcontent">Booked</span></td>
                                    <td><span class="cellcontent">{{ $ticket->event->createdBy->username ? : '' }}</span></td>
                                    <td><span class="cellcontent">{{ $ticket->created_at ? $ticket->created_at->format('Y-m-d h:i A') : '' }}</span></td>
                                    <td><span class="cellcontent">@if($ticket->is_used==1)<i class = "fa icon-in-table-true fa-check"></i> @else  <i class = "fa icon-in-table-false fa-times"></i> @endif</span></td>
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
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection