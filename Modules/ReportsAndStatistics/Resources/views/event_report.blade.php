@extends('layouts.app')
@section('content')

              <!-- =============== Custom Content ===========-==========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image: url({{ asset('/img/covers/dummy2.jpg ')  }}  )   ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">@lang('keywords.ReportsAndStatistics')</h3>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                <form role="form" action="{{route('event_filter_report')}}"  method="post" accept-charset="utf-8">
                      {{csrf_field()}}
                      <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="organizer_name">@lang('keywords.organizer name')</label>
                            <select class="master_input" id="organizer_name" name="organizer_name">
                              <option value="choose" selected disabled>------------</option>
                              @foreach($organizers as $organizer)
                              <option value="{{$organizer['id']}}">{{$organizer['username']}}</option>
                              @endforeach
                            </select>
                            {{-- <span class="master_message inherit">message content</span> --}}
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="event_category">@lang('keywords.event category')</label>
                    <select name="categories[]" multiple="multiple" class="master_input select2" id="city2" style="width:100%;" ,>
                      @foreach($categories as $category)
                      <option value="{{$category['id']}}">{{$category['name']}}</option>
                      @endforeach
                                  </select>
                            {{-- <input class="master_input" type="number" id="event_category" name="event_category"> --}}
                            {{-- <span class="master_message inherit">message content</span> --}}
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="start_date_">@lang('keywords.added from')</label>
                            <div class="">
                              <input class=" master_input" type="text" id="start_date_" name="start_date_" value="{{ \Carbon\Carbon::today()->format('d/m/Y') }}">
                            </div>
                            {{-- <span class="master_message inherit">message content</span> --}}
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="end_date_">@lang('keywords.added to')</label>
                            <div class="">
                              <input class=" master_input" type="text" id="end_date_" name="end_date_"  value="{{ \Carbon\Carbon::tomorrow()->format('d/m/Y') }}">
                            </div>
                            {{-- <span class="master_message inherit">message content</span> --}}
                          </div>
                        </div>
                      </div>
                  <button  class="btn-block master-btn" id="result_btn" type="submit"><span class="color--gray">@lang('keywords.result')</span></button>
                    </form>
                  </div>
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom" id="result">
                    <div class="full-table">
                      <div class="bottomActions__btns"><a class="master-btn excel-btn" href="#">@lang('keywords.export excel')</a>
                      </div>
                      <form id="datatable_form">
                        <table class="data-table-trigger table-master" id="boshy">
                          <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                              <th><span class="cellcontent">@lang('keywords.serial number')</span></th>
                              <th><span class="cellcontent">@lang('keywords.organizer name')</span></th>
                              <th><span class="cellcontent">@lang('keywords.event name')</span></th>
                              <th><span class="cellcontent">@lang('keywords.event category')</span></th>
                              <th><span class="cellcontent">@lang('keywords.is paid')</span></th>
                              <th><span class="cellcontent">@lang('keywords.number of attendees')</span></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($events as $event)
                            <tr>
                              <td><span class="cellcontent">{{$event['id']}}</span></td>
                              <td><span class="cellcontent">{{$event->user->username}}</span></td>
                              <td><span class="cellcontent">{{$event['name']}}</span></td>
                              <td><span class="cellcontent"></span>
                                @foreach ($event->categories as $category)
                                {{$category['name']}}<br>
                                @endforeach
                              </td>
                              <td><span class="cellcontent">{{ $event['is_paid'] ? 'مجانى' : 'مدفوع' }}</span></td>
                              <td><span class="cellcontent">
                              {{$event->user_going->count() }}
                              </span></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
              @section('js')
               <!-- =============== APP MAIN SCRIPTS ===============-->
               <script type="text/javascript" src="../js/scripts.min.js"></script>
               <!-- =============== PAGE VENDOR SCRIPTS ===============-->
               <script type="text/javascript">
                 $(function () {
                  dateRange('start_date_','end_date_',
                  "{{ \Carbon\Carbon::now()->subYears(5)->format('Y') }}",
                  "{{ \Carbon\Carbon::now()->subYears(5)->format('m') }}",
                  "{{ \Carbon\Carbon::now()->subYears(5)->format('d') }}",
                  "{{ \Carbon\Carbon::now()->addYears(5)->format('Y') }}",
                  "{{ \Carbon\Carbon::now()->addYears(5)->format('m') }}",
                  "{{ \Carbon\Carbon::now()->addYears(5)->format('d') }}",
                  '{{ \Carbon\Carbon::now()->addYears(5)->format("d-m-Y") }}'  // end date
                  )

                 });
               </script>
               <script type="text/javascript">
                 {{--  $(document).ready(function(){
                     $("#result").hide();
                     $("#result_btn").on('click',function(){
                       $("#result").show();
                     })
                 })  --}}
               </script>
               <script type="text/javascript">
                 //--Data table trigger --1
                 $(document).ready(function(){
                   if ( $('html').attr('lang') == 'ar' ) {
                     var datatable_one = $("#boshy").DataTable({
                     'columnDefs': [{
                       'targets': 0,
                       'searchable':false,
                       'orderable':false,
                       'className': 'this-include-check',

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
                     $(document).on('click','#boshy tbody tr input.input-in-table',function(){
                       var RowParent = $(this).parents('tr') ;

                       if ( $(this).parents('tr').hasClass('selected') ) {
                         $(this).parents('tr').removeClass('selected');
                       }
                       else {
                         $(this).parents('tr').addClass('selected');
                       }
                     });

                     //-trigger check All
                     $('#boshy #select-all').on('click',function(){
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
                       var selectedRows = datatable_one.rows( $('#boshy tr.selected') ).data().to$();
                       datatable_one.rows( '.selected' ).remove().draw(false);
                     });


                   } else {

                     var datatable_one = $("#boshy").DataTable({
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
                     $(document).on('click','#boshy tbody tr input.input-in-table',function(){
                       var RowParent = $(this).parents('tr') ;

                       if ( $(this).parents('tr').hasClass('selected') ) {
                         $(this).parents('tr').removeClass('selected');
                       }
                       else {
                         $(this).parents('tr').addClass('selected');
                       }
                     });

                     //-trigger check All
                     $('#boshy #select-all').on('click',function(){
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
                       var selectedRows = datatable_one.rows( $('#boshy tr.selected') ).data().to$();
                       datatable_one.rows( '.selected' ).remove().draw(false);
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


          $('.excel-btn').click(function(){
     var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-offer-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('event_excel')}}',
       data:{ids:selectedIds,filters:filter},
       success:function(response){
        swal("ﺗﻢ اﺳﺘﺨﺮاﺝ اﻟﺠﺪﻭﻝ ﻋﻠﻲ ﻫﻴﺌﺔ ﻣﻠﻒ اﻛﺴﻴﻞ" ,"ﺗﻤﺖ اﻟﻌﻤﻠﻴﺔ ﺑﻨﺠﺎﺡ!", "success");
        // var a = document.createElement("a");
        // a.href = response.file;
        // a.download = response.name+'.xlsx';
        // document.body.appendChild(a);
        // a.click();
        // a.remove();
        location.href = response;
      }
    });
   });

    </script>
              @endsection
@endsection