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
          <div class="cover--actions"><span></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="tabs--wrapper">
        <div class="clearfix"></div>
        <ul class="tabs">
          <li id="info">@lang('keywords.info')</li>
          <li id="posts">@lang('keywords.posts')</li>
          <li id="tickets">@lang('keywords.tickets')</li>
        </ul>
        <ul class="tab__content">
          <li class="tab__content_item active" id="info-content">
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="full-table">
                <table class="verticaltable table-master">
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.eventName')</span></th>
                    <td>
                      <span class="cellcontent">
                        {{ \App::isLocale('en') ? $event->name : Helper::localization('events', 'name', $event->id, 2) }}
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.venue')</span></th>
                    <td>
                      <span class="cellcontent">
                          {{ \App::isLocale('en') ? $event->venue : Helper::localization('events', 'venue', $event->id, 2) }}
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.start')</span></th>
                    <td><span class="cellcontent">{{ $event->start_datetime->format('Y-m-d h:i A') }}</span></td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.end')</span></th>
                    <td><span class="cellcontent">{{ $event->end_datetime->format('Y-m-d h:i A') }}</span></td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.addby')</span></th>
                    <td><span class="cellcontent">{{ $event->user->first_name .' '. $event->user->last_name  }}</span></td>
                  </tr>
                  <tr>
                    <th><span class="cellcontent">@lang('keywords.category')</span></th>
                    <td>
                      <span class="cellcontent">
                        @if ( \App::isLocale('en') )
                          @foreach( $event->categories as $cat )
                            {{ $cat->name }}
                          @endforeach
                        @else
                          @foreach( $event->categories as $cat )
                            {{ Helper::localization('interests', 'name', $cat->id, 2) }}
                          @endforeach
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
          </li>
          <li class="tab__content_item" id="posts-content">
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="full-table">
                <div class="bottomActions__btns"><a class="master-btn" href="#">Delete selected</a>
                </div>
                <form id="dataTableTriggerId_003_form">
                  <table class="data-table-trigger table-master" id="dataTableTriggerId_003">
                    <thead>
                      <tr class="bgcolor--gray_mm color--gray_d">
                        <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                        <th><span class="cellcontent">serial</span></th>
                        <th><span class="cellcontent">Added by</span></th>
                        <th><span class="cellcontent">content</span></th>
                        <th><span class="cellcontent">Added date</span></th>
                        <th><span class="cellcontent">actions</span></th>
                      </tr>
                    </thead>
                    <tbody>

                      @if ( isset($event->post) && !empty($event->post) )
                          @foreach ($event->post as $post)
                          <tr>
                              <td><span class="cellcontent"></span></td>
                              <td><span class="cellcontent">{{ $loop->index + 1 }}</span></td>
                              <td><span class="cellcontent">{{ $post->user ? $post->user->username : '' }}</span></td>
                              <td><span class="cellcontent">{{ $post->post ? : '' }}</span></td>
                              <td><span class="cellcontent">{{ $post->created_at->format('Y-m-d H:m:i A ') }}</span></td>
                              <td>
                                <span class="cellcontent">
                                  <a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white "><i class = "fa  fa-trash-o"></i></a>
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
          </li>
          <li class="tab__content_item" id="tickets-content">
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <p class="text-center">
                @if ( $event->is_paid == 1 )
                    @lang('keywords.foundTickets') {{ $event->ticket()->first()->current_available_tickets ? : 0 }} @lang('keywords.ticket') 
                @else 
                  @lang('keywords.noTickets')
                @endif
              </p>
            </div>
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="full-table">
                <table class="verticaltable table-master">
                  <tr>
                    <th><span class="cellcontent">
                      @lang('keywords.Price')
                    </span></th>
                    <td><span class="cellcontent">
                      {{ count($event->ticket) ? $event->ticket()->first()->price : __('keywords.free') }}  {{ count($event->ticket) ? $event->ticket()->first()->currency->symbol: '' }}
                    </span></td>
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
                      @if ( isset($booked_tickets) && !empty($booked_tickets) )
                        @foreach($booked_tickets as $ticket)
                          <tr>
                            <td><span class="cellcontent"></span></td>
                            <td><span class="cellcontent">{{ $loop->index+1 }}</span></td>
                            <td><span class="cellcontent"><img src = "https://source.unsplash.com/random" , class = " img-in-table"></span></td>
                            <td><span class="cellcontent">{{ $ticket->serial_number ? : '' }}</span></td>
                            <td><span class="cellcontent">Booked</span></td>
                            <td><span class="cellcontent">{{ $ticket->booking->user->username ? : '' }}</span></td>
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

  <script>
        $(document).ready(function(){
        if ( $('html').attr('lang') == 'ar' ) {
          var datatable_one = $("#dataTableTriggerId_003").DataTable({
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
              var rows = datatable_one.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',this.checked).parents('tr').addClass('selected');
              
            } else {
              var rows = datatable_one.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',false).parents('tr').removeClass('selected');
              $(this).attr('data-click-state', 0);
            }
          });
      
          //-Delete buttons
          $('#delete-test').on('click', function() {
            var selectedRows = datatable_one.rows( $('#dataTableTriggerId_003 tr.selected') ).data().to$();
            datatable_one.rows( '.selected' ).remove().draw(false);
          });
          
          
        } else {
      
          var datatable_one = $("#dataTableTriggerId_003").DataTable({
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
              var rows = datatable_one.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',this.checked).parents('tr').addClass('selected');
              
            } else {
              var rows = datatable_one.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',false).parents('tr').removeClass('selected');
              $(this).attr('data-click-state', 0);
            }
          });
      
          //-Delete buttons
          $('#delete-test').on('click', function() {
            var selectedRows = datatable_one.rows( $('#dataTableTriggerId_003 tr.selected') ).data().to$();
            datatable_one.rows( '.selected' ).remove().draw(false);
          });
      
        }
      });
      
  </script>
@endsection