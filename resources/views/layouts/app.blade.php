<!DOCTYPE html>
<html lang="{{ Session::get('locale') }}">
  <head>
    <!-- =====================================================-->
    <!-- ==================HEAD=============================-->
    <!-- =====================================================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="ايفنتكوم">
    <meta name="keywords" content="ايفنتكوم">
    <!-- =============== APP FAVICON ===============-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ee4a7e">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <meta name="msapplication-TileColor" content="#ee4a7e">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#281160">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- =============== APP TITLE ===============-->
    <title>@lang('keywords.website_name')</title>
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset( App::isLocale('ar') ? 'css/style__0__rtl.min.css' : 'css/style__0__ltr.min.css') }}">
    <!-- =============== APP SCRIPT ===============-->
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    {{-- Custom CSS --}}
  </head>
  <body>
    <div class="toggled" id="wrapper">
      <div class="layout_sidebar">
        <div class="wrapper">
          <!-- top navbar-->
          <header class="topnavbar-wrapper">
            <nav class="top-navbar navbar-expand-lg     bradius--noborder bshadow--1 ">
              <div class="container"><span></span>
                <button class="navbar-toggler  " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars  "></span></button>
                <ul class="actionsbar moile-view hidden-lg hidden-md hidden-sm">
                  <li class="dropdowny"><a class="nav-link dropdowny-toggle  " href="#"><i class="fa fa-bell"></i></a>
                    <ul class="dropdowny-menu" role="menu">
                      <li><a href="#">
                          <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                          <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                            11:00:00AM</span></a></li>
                      <li><a href="#">
                          <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                          <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                            11:00:00AM</span></a></li>
                      <li><a href="#">
                          <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                          <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                            11:00:00AM</span></a></li>
                      <li><a href="#">
                          <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                          <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                            11:00:00AM</span></a></li>
                      <li><a href="#">
                          <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                          <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                            11:00:00AM</span></a></li>
                      <li><a href="#">
                          <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                          <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                            11:00:00AM</span></a></li>
                    </ul>
                  </li>
                </ul>
                <div class="collapse navbar-collapse nav pull-right  " id="navbarSupportedContent">
                  <ul class="navbar-nav">

                  <li class="nav-item" style="font-size: 14px important; padding: 0px;">
                    <form action="{{ route('changeLang') }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="url" value="{{ Request::url() }}">
                      <input type="hidden" name="locale" value="{{ \Helper::getUserLocale() }}">
                        <button type="submit" class="nav-link English" style="background-color: inherit; border: 0px; color: white; ">{{ App::isLocale('ar') ? 'English' : 'العربية' }}</button>
                    </form>

                  </li>
                  </ul>
                  <ul class="actionsbar desktop-view hidden-xs">
                    <li class="dropdowny"><a class="nav-link dropdowny-toggle  " href="#"><i class="fa fa-bell"></i></a>
                      @if(App::isLocale("en"))
                        <ul class="dropdowny-menu" role="menu">

                        {{-- @foreach(\App\Helpers\Helper::ListNotifications() as $notification)
                          <li><a href="{{url('/mark_read')}}/{{$notification->id}}">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>{{$notification->msg}}</p><span class="notification_date"><i class="fa fa-clock-o"></i>{{date('d/m/Y', strtotime($notification->created_at))}}
                              {{date('H:i:s', strtotime($notification->created_at))}}</span></a></li>
                        @endforeach --}}
                         </ul>
                      @else
                      <ul class="dropdowny-menu" role="menu">
                        {{-- @if( count(\Helper::ListNotifications()) > 0 )
                          @foreach(\App\Helpers\Helper::ListNotifications() as $notification)
                          <li><a href="{{url('/mark_read')}}/{{$notification->id}}">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>{{$notification->msg_ar}}</p><span class="notification_date"><i class="fa fa-clock-o"></i>{{date('d/m/Y', strtotime($notification->created_at))}}
                              {{date('H:i:s', strtotime($notification->created_at))}}</span></a></li>
                          @endforeach
                        @endif --}}
                         </ul>
                      @endif
                      <!-- <ul class="dropdowny-menu" role="menu">
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>Medo ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum dollarss</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                        <li><a href="#">
                            <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                            <p>lorem ipsum dollar lorem ipsum</p><span class="notification_date"><i class="fa fa-clock-o"></i>5/11/2015
                              11:00:00AM</span></a></li>
                      </ul> -->
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </header>
          <div class="full-body">
            <div class="overlay-toggle-up"></div>
            <!-- sidebar-->
            <!-- ==============================================================-->
            <!-- ============================SIDEBAR==============================-->
            <!-- ==============================================================-->
            <!-- Sidebar-->
            <nav class="navbar navbar-fixed-top   bshadow--0 bradius--noborder " id="sidebar-wrapper" role="navigation">
              <ul class="sidebar-navigation">
                <li class="brand   bshadow--0"><a href="{{ route('about') }}"> <img src="{{ asset('img/logo/logo__light.svg') }}" alt="طبيب"></a></li>
              </ul>
              <div class="coverglobal text-center bshadow--2" style="background:undefined url( '{{ asset('img/covers/dummy.jpg') }}') no-repeat center center; background-size:cover;">
                <button class="hamburger is-closed" type="button" data-toggle="offcanvas"><span class="hamb-top"></span><span class="hamb-middle"></span><span class="hamb-bottom"></span></button>
                <div class="text-center">
                    <img class="coverglobal__avatar bradius--circle" src="{{ asset('img/avaters/male.jpg') }}">
                    <h3 class="coverglobal__title">{{ Auth::user()->first_name .' '. Auth::user()->last_name }}</h3>
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
                  @if(\App\Helpers\Helper::hasRule(['Super Admin','Admin']) )
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
                  @if(\App\Helpers\Helper::hasRule(['Super Admin']) )
                  <li class="side__list" id="menu_2"> <a class="side__item side__item--sub">@lang('keywords.Users')</a>
                    <ul class="side__submenu">
                      <li class="side__sublist"><a class="side__subitem" id="sub_2_1" href="{{ route('users_mobile')  }}">@lang('keywords.MobileAppUsers')</a></li>
                      <li class="side__sublist"><a class="side__subitem" id="sub_2_2" href="{{ route('users_backend')  }}">@lang('keywords.BackendUsers')</a></li>
                    </ul>
                  </li>
                  @endif


                  @if(\App\Helpers\Helper::hasRule(['Super Admin','Admin Doctor']) )
                  <li class="side__list openedmenu"><a class="side__item" id="sub_8_2" href="{{ route('reports_and_statistics')  }}">@lang('keywords.ReportsِِِِِِAndStatistics')</a>
                      </li>
                  <li class="side__list openedmenu"><a class="side__item " id="sub_8_3" href="{{route('offers_and_deals')}}">@lang('keywords.offers_and_deals')</a></li>
                  <li class="side__list openedmenu"><a class="side__item " id="sub_8_3" href="{{route('notifications')}}">@lang('keywords.notifications')</a></li>
                  <li class="side__list openedmenu"><a class="side__item " id="sub_8_4" href="{{route('events')}}">@lang('keywords.events')</a></li>

                  @endif
                </ul>
              </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">

              {{-- Start alert messages --}}
              @include('layouts.alerts')
              {{-- End alert --}}

              {{-- yield data --}}
              @yield('content')

            </div>
          </div>
          <!-- Page footer-->
          <footer>
            <!-- =====================================================-->
            <!-- ==================FOOTER=============================-->
            <!-- =====================================================-->
            <div class="clear-fix"></div>
            <div class="footer--1 text-center     bradius--noborder bshadow--3">
              @if (\App::isLocale('en'))
              <p>
                all rights reserved to ©<span class="cp bradius--noborder bshadow--0">Eventakom</span>2018</p>
              @else
              <p>
                  جميع الحقوق محفوظة  ©<span class="cp     bradius--noborder bshadow--0">ايفنتكوم</span>2018</p>
              @endif
            </div>
          </footer>
        </div>
      </div>
    </div>
    <!-- =============== APP MAIN SCRIPTS ===============-->

    <script type="text/javascript" src="{{ asset('js/scripts.min.js') }}"></script>

    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
      <script type="text/javascript">
      $(function () {
        // $('.datepicker-popup').pickadate();
        $('.timepicker-popup').pickatime();
      });

    </script>
    <script type="text/javascript">
      $(function () {
        // $('.datepicker').datepicker({autoclose: true});
        $(".timepicker").timepicker({showInputs: false});
      });

    </script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.4/tinymce.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        tinyMCE.init({
          selector: "textarea.tinyMce",
          plugins: [ "image" , "code visualblocks"],
          valid_elements : '*[*]',
          toolbar: "image | undo | redo | styleselect | bold | italic | fontsizeselect | alignleft | aligncenter | alignright | alignjustify | preview ",
          schema: "html5",
        });

      });

      // hide alert message after 4 seconds => 4000 ms
      window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove();
              });
          }, 4000);
    </script>

    <script type="text/javascript">
      //--Data table trigger --1
      $(document).ready(function(){
        if ( $('html').attr('lang') == 'ar' ) {
          var datatable_one = $("#dataTableTriggerId_001").DataTable({
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
          $(document).on('click','#dataTableTriggerId_001 tbody tr input.input-in-table',function(){
            var RowParent = $(this).parents('tr') ;

            if ( $(this).parents('tr').hasClass('selected') ) {
              $(this).parents('tr').removeClass('selected');
            }
            else {
              $(this).parents('tr').addClass('selected');
            }
          });

          //-trigger check All
          $('#dataTableTriggerId_001 #select-all').on('click',function(){
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
            var selectedRows = datatable_one.rows( $('#dataTableTriggerId_001 tr.selected') ).data().to$();
            datatable_one.rows( '.selected' ).remove().draw(false);
          });


        } else {

          var datatable_one = $("#dataTableTriggerId_001").DataTable({
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
          $(document).on('click','#dataTableTriggerId_001 tbody tr input.input-in-table',function(){
            var RowParent = $(this).parents('tr') ;

            if ( $(this).parents('tr').hasClass('selected') ) {
              $(this).parents('tr').removeClass('selected');
            }
            else {
              $(this).parents('tr').addClass('selected');
            }
          });

          //-trigger check All
          $('#dataTableTriggerId_001 #select-all').on('click',function(){
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
            var selectedRows = datatable_one.rows( $('#dataTableTriggerId_001 tr.selected') ).data().to$();
            datatable_one.rows( '.selected' ).remove().draw(false);
          });

        }
      });

     //--Data table trigger --2
      $(document).ready(function(){
        if ( $('html').attr('lang') == 'ar' ) {
          var datatable_two = $("#dataTableTriggerId_002").DataTable({
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
          $(document).on('click','#dataTableTriggerId_002 tbody tr input.input-in-table',function(){
            var RowParent = $(this).parents('tr') ;

            if ( $(this).parents('tr').hasClass('selected') ) {
              $(this).parents('tr').removeClass('selected');
            }
            else {
              $(this).parents('tr').addClass('selected');
            }
          });

          //-trigger check All
          $('#dataTableTriggerId_002 #select-all').on('click',function(){
            if($(this).attr('data-click-state') == 0) {
              $(this).attr('data-click-state',1)
              var rows = datatable_two.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',this.checked).parents('tr').addClass('selected');

            } else {
              var rows = datatable_two.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',false).parents('tr').removeClass('selected');
              $(this).attr('data-click-state', 0);
            }
          });

          //-Delete all selected Function
          function deleteIt() {
           var selectedRows = datatable_two.rows( $('#dataTableTriggerId_002 tr.selected') ).data().to$();
           datatable_two.rows( '.selected' ).remove().draw(false);
          };

          //-Delete buttons
          $('#delete-test-2').on('click', function() {
           deleteIt();
          });

          //-Accept btn-single
          $('button.accepted-btn').on('click' , function(){
           var acceptedRow = $(this).parents('tr');
           var selectedRows = datatable_two.rows( $('#dataTableTriggerId_002 tr.selectAccepted') ).data().to$();
           acceptedRow.addClass('selectAccepted');
           datatable_two.rows( '.selectAccepted' ).remove().draw(false);
           console.log("clicked");
          });


        } else {

          var datatable_two = $("#dataTableTriggerId_002").DataTable({
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



          $(document).on('click','#dataTableTriggerId_002 tbody tr input.input-in-table',function(){
           var RowParent = $(this).parents('tr') ;

           if ( $(this).parents('tr').hasClass('selected') ) {
             $(this).parents('tr').removeClass('selected');
           }
           else {
             $(this).parents('tr').addClass('selected');
           }
          });

          //-trigger check All
          $('#dataTableTriggerId_002 #select-all').on('click',function(){
            if($(this).attr('data-click-state') == 0) {
              $(this).attr('data-click-state',1)
              var rows = datatable_two.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',this.checked).parents('tr').addClass('selected');

            } else {
              var rows = datatable_two.rows().nodes();
              $('input.input-in-table' , rows).prop('checked',false).parents('tr').removeClass('selected');
              $(this).attr('data-click-state', 0);
            }
          });

          //-Delete all selected Function
          function deleteIt() {
           var selectedRows = datatable_two.rows( $('#dataTableTriggerId_002 tr.selected') ).data().to$();
           datatable_two.rows( '.selected' ).remove().draw(false);
          };

          //-Delete buttons
          $('#delete-test-2').on('click', function() {
           deleteIt();
          });

          //-Accept btn-single
          $('button.accepted-btn').on('click' , function(){
           var acceptedRow = $(this).parents('tr');
           var selectedRows = datatable_two.rows( $('#dataTableTriggerId_002 tr.selectAccepted') ).data().to$();
           acceptedRow.addClass('selectAccepted');
           datatable_two.rows( '.selectAccepted' ).remove().draw(false);
           console.log("clicked");
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

        //--Data table trigger --3
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
          $(document).on('click','#dataTableTriggerId_001 tbody tr input.input-in-table',function(){
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
          $('#dataTableTriggerId_001 #select-all').on('click',function(){
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


      //-============================================================
      //-===============================comp__#009__select
      //-============================================================
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
      $(function () {
        $(".select2").select2();
      });


    </script>


{{-- Google maps API key --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCknR0jhKTIB33f2CLFhBzgp0mj2Tn2q5k&libraries=places&callback=initMap" type="text/javascript"></script>

{{-- Map script --}}
<script>
/* script */
function initMap() {
      @if( isset($event->latitude) && isset($event->longtuide) )
        var latlng = {lat: {{ $event->latitude }}, lng: {{ $event->longtuide }} };
      @elseif( isset($famous->latitude) && isset($famous->longtuide) )
        var latlng = {lat: {{ $famous->latitude }}, lng: {{ $famous->longtuide }} };
      @else
        var latlng = {lat: 30.042701, lng: 31.432662};
      @endif

   // var latlng = new google.maps.LatLng(28.5355161,77.39102649999995);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var input = document.getElementById('searchInput');
    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);

    });
    // this function will work on marker move event into map
    google.maps.event.addListener(marker, 'dragend', function() {
      geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
            bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
          }
        }
      });
    });

}

function bindDataToForm(address,lat,lng){

  // If user searched in searchbox && marker moved then don't replace marker's address with user's address.
 /* if ( document.getElementById('searchInput').value == '' ) {
    document.getElementById('searchInput').value = address;
  }*/
document.getElementById('searchInput').value = address;
  document.getElementById('lat').value = lat;
  document.getElementById('lng').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script type="text/javascript">
  @if(\App::isLocale('ar'))
 var next = $('#next1').text();
    $(this).text(next.replace('Next', 'التالي'));
@endif
</script>

@yield('js')

  </body>
</html>
