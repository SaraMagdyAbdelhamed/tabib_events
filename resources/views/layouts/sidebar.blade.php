<!-- sidebar-->
            <!-- ==============================================================-->
            <!-- ============================SIDEBAR==============================-->
            <!-- ==============================================================-->
            <!-- Sidebar-->
            <nav class="navbar navbar-fixed-top   bshadow--0 bradius--noborder " id="sidebar-wrapper" role="navigation">
                <ul class="sidebar-navigation">
                  <li class="brand   bshadow--0"><a href="{{ route('about') }}"> <img src="{{ asset('img/logo__light.png') }}" alt="طبيب"></a></li>
                </ul>
                <div class="coverglobal text-center bshadow--2" style="background:undefined url( '{{ asset('img/covers/dummy.jpg') }}') no-repeat center center; background-size:cover;">
                  <button class="hamburger is-closed" type="button" data-toggle="offcanvas"><span class="hamb-top"></span><span class="hamb-middle"></span><span class="hamb-bottom"></span></button>
                  <div class="text-center">
                      <img class="coverglobal__avatar bradius--circle" src="{{(Auth::user()->photo != null)? asset(Auth::user()->photo):asset('img/avaters/male.jpg') }}">
                     
                      <h3 class="coverglobal__title">{{ __('keywords.welcome') .' '. Auth::user()->first_name .' '. Auth::user()->last_name }}</h3>
                      <small class="coverglobal__slogan">
                        <div class="row text-center">
                          {{ Auth::user()->last_login->format('h:i A - M d, Y')  }}
                        </div>
                      </small>
  
                      <div style="margin-top: 5%;">
                        <a href="{{ route('logout') }}" class="master-btn bradius--small">{{ __('keywords.logout') }}</a>
                      </div>
                  </div>
                </div>
                <div class="side">
                  <ul class="side-menu">
                    @if(\App\Helpers\Helper::hasRule(['Super Admin','Admin' , 'Data Entry']) )
                    <li class="side__list" id="menu_1"><a class="side__item side__item--sub">@lang('keywords.mainData')</a>
  
                      <ul class="side__submenu">
                        <li class="side__sublist"><a class="side__subitem" id="sub_1_1" href="{{ route('about') }}">@lang('keywords.aboutUs')</a>
                        </li>
                        <li class="side__sublist"><a class="side__subitem" id="sub_1_2" href="{{ route('terms')  }}">@lang('keywords.terms')</a>
                        </li>
                        <li class="side__sublist"><a class="side__subitem" id="sub_1_3" href="{{ route('privacy')  }}">@lang('keywords.privacy')</a>
                        </li>
                        <li class="side__sublist"><a class="side__subitem" id="sub_1_4" href="{{ route('contact')  }}">@lang('keywords.contactUs')</a>
                        </li>
                        <li class="side__sublist"><a class="side__subitem" id="sub_1_5" href="{{ route('event.categories')  }}">@lang('keywords.eventCategories')</a>
                        </li>
  
                        <li class="side__sublist"><a class="side__subitem" id="sub_1_6" href="{{ route('sponsor.categories')  }}">@lang('keywords.sponsorCategories')</a>
                        </li>
  
                        <li class="side__sublist"><a class="side__subitem" id="sub_1_7" href="{{ route('offers.categories')  }}">@lang('keywords.offerCategories')</a>
                        </li>
  
                        <li class="side__sublist"><a class="side__subitem" id="sub_1_8" href="{{ route('speciality.categories')  }}">@lang('keywords.doctorSpecialists')</a>
                        </li>
  
                      </ul>
                    </li>
                    @endif
                    @if(\App\Helpers\Helper::hasRule(['Super Admin' , 'Organizer']) )
                    <li class="side__list" id="menu_2"> <a class="side__item side__item--sub">@lang('keywords.Users')</a>
                      <ul class="side__submenu">
                        <li class="side__sublist"><a class="side__subitem" id="sub_2_1" href="{{ route('users_mobile')  }}">@lang('keywords.MobileAppUsers')</a></li>
                        <li class="side__sublist"><a class="side__subitem" id="sub_2_2" href="{{ route('users_backend')  }}">@lang('keywords.BackendUsers')</a></li>
                      </ul>
                    </li>
                    @endif
  
  
                    @if(\App\Helpers\Helper::hasRule(['Super Admin']) )
                    <li class="side__list openedmenu"><a class="side__item" id="sub_8_2" href="{{ route('reports_and_statistics')  }}">@lang('keywords.ReportsِِِِِِAndStatistics')</a>
                        </li>
                        @endif
                     @if(\App\Helpers\Helper::hasRule(['Super Admin' , 'Data Entry' , 'Sponsor']) )
                    <li class="side__list openedmenu"><a class="side__item " id="sub_8_3" href="{{route('offers_and_deals')}}">@lang('keywords.offers_and_deals')</a></li>
                    @endif
                    @if(\App\Helpers\Helper::hasRule(['Super Admin' , 'Organizer' , 'Sponsor']) )
                    
                    <li class="side__list openedmenu"><a class="side__item " id="sub_8_4" href="{{route('notifications')}}">@lang('keywords.notifications')</a></li>
                    @endif
                    @if(\App\Helpers\Helper::hasRule(['Super Admin','Admin Doctor' , 'Organizer' ]) )
                    <li class="side__list openedmenu"><a class="side__item " id="sub_8_5" href="{{route('events')}}">@lang('keywords.events')</a></li>
  
                    @endif
                  </ul>
                </div>
              </nav>