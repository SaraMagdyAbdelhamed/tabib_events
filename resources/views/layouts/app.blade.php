<!DOCTYPE html>
<html lang="{{ Session::get('locale') }}">
  <head>
    <!-- =====================================================-->
    <!-- ==================HEAD=============================-->
    <!-- =====================================================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="طبيب ايفينت">
    <meta name="keywords" content="طبيب ايفينت">
    <!-- =============== APP FAVICON ===============-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <meta name="msapplication-TileColor" content="#ee4a7e">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#281160">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">


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
          @include('layouts.navbar')

          <div class="full-body">
            <div class="overlay-toggle-up"></div>
            
            {{-- sidebar --}}
            @include('layouts.sidebar')

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
                all rights reserved to ©<span class="cp bradius--noborder bshadow--0">Tabib Event</span>2018</p>
              @else
              <p>
                  جميع الحقوق محفوظة  ©<span class="cp     bradius--noborder bshadow--0">طبيب ايفينت</span>2018</p>
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
              "zeroRecords":    "لا توجد نتائج مطابقه",
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
<script>
function request_event(user_id,event_id,type)
{
  var token = '{{ csrf_token() }}';
  $.ajax(
      {
          url: "{{ route('request_event') }}",
          type: 'POST',
          dataType: "JSON",
          data: {
              "user_id": user_id,
              "event_id": event_id,
              "type": type,
              "_method": 'POST',
              "_token": token,
          },
          success: function(data)
          {
            swal("@lang('keywords.request_event_success')!", "@lang('keywords.request_event_success_message') ", "success");
              
          },
              error: function(response) {
                swal("@lang('keywords.request_event_fail')!", "@lang('keywords.request_event_fail_message') ", "error");
              console.log(response);
          }
      });

}
</script>
@yield('js')
@include('layouts.ajax_actions')
  </body>
</html>
