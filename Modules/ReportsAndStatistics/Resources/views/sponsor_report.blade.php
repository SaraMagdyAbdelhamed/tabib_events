@extends('layouts.app')
@section('content')

              <!-- =============== Custom Content ===========-==========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url({{ asset('/img/covers/dummy2.jpg ')  }}  )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">         
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">@lang('keywords.ReportsِِِِِِAndStatistics')</h3>
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
                    <form role="form" action="{{route('sponsor_filter')}}"  method="post" accept-charset="utf-8">
                    	{{csrf_field()}}
                      <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="sponsor_name">@lang('keywords.sponsor name')</label>
                            <select class="master_input" id="sponsor_name" name="sponsor_name">
                            	<option value="choose" selected disabled>------------</option>
                            	@foreach($sponsors as $sponsor)
                              <option value="{{$sponsor['id']}}">{{$sponsor['username']}}</option>
                              @endforeach
                            </select>
                            {{-- <span class="master_message inherit">message content</span> --}}
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="offer_title">@lang('keywords.offer category')</label>
          					<select name="offers[]" multiple="multiple" class="master_input select2" id="city2" style="width:100%;" ,>
                      @foreach($categories as $category)
                      <option value="{{$category['id']}}">{{$category['name']}}</option>
                      @endforeach
                                  </select>
                            {{-- <input class="master_input" type="number" id="offer_title" name="offer_title"><span class="master_message inherit">message content</span> --}}
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="start_date_">@lang('keywords.added from') </label>
                            <div class="">
                              <input class=" master_input" type="text"  id="start_date_" name="start_date_">
                            </div>
                            {{-- <span class="master_message inherit">message content</span> --}}
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="end_date_">@lang('keywords.added to')</label>
                            <div class="">
                              <input class=" master_input" type="text"  id="end_date_" name="end_date_">
                            </div>
                            {{-- <span class="master_message inherit">message content</span> --}}
                          </div>
                        </div>
                      </div>
                <button class="btn-block master-btn" id="result_btn" type="submit"><span class="color--gray">@lang('keywords.result')</span></button>
                    </form>
                  </div>
                  {{-- <button class="btn-block master-btn" id="result_btn"><span class="color--gray">النتيجة</span></button> --}}
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom" id="result">
                    <div class="full-table">
                      <div class="bottomActions__btns"><a class="master-btn excel-btn " href="#">@lang('keywords.export excel')</a>
                      </div>
                      <form id="datatable1_form">
                        <table class="data-table-trigger table-master" id="datatable1">
                          <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                              <th><span class="cellcontent">@lang('keywords.serial number')</span></th>
                              <th><span class="cellcontent">@lang('keywords.sponsor name')</span></th>
                              <th><span class="cellcontent">@lang('keywords.offer title')</span></th>
                              <th><span class="cellcontent">@lang('keywords.number of views')</span></th>
                              <th><span class="cellcontent">Number of hits</span></th>
                              <th><span class="cellcontent">@lang('keywords.number of call')</span></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($offers as $offer)            
                            <tr data-offer-id="{{$offer['id']}}">
                              <td><span class="cellcontent">{{$offer['id']}}</td>
                              <td><span class="cellcontent">{{$offer->user->username}}</span></td>
                              <td><span class="cellcontent">{{$offer['name']}}</span></td>
                              <td><span class="cellcontent">{{$offer['number_of_views']}}</span></td>
                              <td><span class="cellcontent">don't know yet</span></td>
                              <td><span class="cellcontent">{{$offer['number_of_calls']}}</span></td>
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
                </div>
              </div>
              @section('js')
              <script type="text/javascript" src="js/scripts.min.js"></script>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <script type="text/javascript">
      $(function () {
        dateRange('start_date_','end_date_','2018','7','30','2018','8','30','22/11/2018')

      });
    </script>
{{--     <script type="text/javascript">
      $(document).ready(function(){
          $("#result").hide();
          $("#result_btn").on('click',function(){
            $("#result").show();
          })
      })
    </script> --}}
    <script type="text/javascript">
      function delete_btn_action(){
          swal({
           title: "Are you sure?",
           text: "You will not be able to recover this imaginary file!",
           type: "warning",
           showCancelButton: true,
           confirmButtonColor: '#281160',
           confirmButtonText: 'Yes, delete it!',
           closeOnConfirm: false
         },
         function(){
           swal("Deleted!", "Your imaginary file has been deleted!", "success");
         });
      }
    </script>
    <script type="text/javascript">
      //--Data table trigger --1
      $(document).ready(function(){
        if ( $('html').attr('lang') == 'ar' ) {
          var datatable_one = $("#datatable1").DataTable({
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
          $(document).on('click','#datatable1 tbody tr input.input-in-table',function(){
            var RowParent = $(this).parents('tr') ;
            
            if ( $(this).parents('tr').hasClass('selected') ) {
              $(this).parents('tr').removeClass('selected');
            }
            else {
              $(this).parents('tr').addClass('selected');
            }  
          });
      
          //-trigger check All
          $('#datatable1 #select-all').on('click',function(){
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
            var selectedRows = datatable_one.rows( $('#datatable1 tr.selected') ).data().to$();
            datatable_one.rows( '.selected' ).remove().draw(false);
          });
          
          
        } else {
      
          var datatable_one = $("#datatable1").DataTable({
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
          $(document).on('click','#datatable1 tbody tr input.input-in-table',function(){
            var RowParent = $(this).parents('tr') ;
            
            if ( $(this).parents('tr').hasClass('selected') ) {
              $(this).parents('tr').removeClass('selected');
            }
            else {
              $(this).parents('tr').addClass('selected');
            }  
          });
      
          //-trigger check All
          $('#datatable1 #select-all').on('click',function(){
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
            var selectedRows = datatable_one.rows( $('#datatable1 tr.selected') ).data().to$();
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


//       $("select[name='sponsor_name']").change(function () {
// var sponsor_id = $("select[name='sponsor_name']").val();
// if (sponsor_id !== '' && sponsor_id !== null) {
// $("select[name='offers']").prop('disabled',
// false).find('option[value]').remove();
// $.ajax({
// type: 'GET',
// url: '{{url('sponsor_get_offer')}}', // do not forget to register your route
// data: {id: sponsor_id },
// }).done(function (data) {
// $.each(data, function (key, value) {
// $("select[name='offers[]']")
// .append($("<option></option>")
// .attr("value", key)
// .text(value));
// });
// }).fail(function(jqXHR, textStatus){
// console.log(jqXHR);
// });
// } else {
// $("select[name='offers']").prop('disabled',
// true).find("option[value]").remove();
// }
// });

    $('.excel-btn').click(function(){
     var filter='@if(\session('filter_ids')){{json_encode(\session('filter_ids'))}}@endif';
     var selectedIds = $("input:checkbox:checked").map(function(){
      return $(this).closest('tr').attr('data-offer-id');
    }).get();
     $.ajax({
       type:'GET',
       url:'{{route('sponsor_excel')}}',
       data:{ids:selectedIds,filters:filter},
       success:function(response){
        swal("تمت العملية بنجاح!", "تم استخراج الجدول علي هيئة ملف اكسيل", "success");
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