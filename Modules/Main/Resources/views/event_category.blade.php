@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url('{{ asset( '/img/covers/dummy2.jpg ' ) }}')  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">         
              <div class="text-wraper">
                <h4 class="cover-inside-title">@lang('keywords.mainData')</h4><i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.eventCategories')</h4>
              </div>
            </div>
          </div>
          <div class="cover--actions"><a id="addNewCat" class="bradius--no border-btn master-btn" type="button" href="#popupModal_1">@lang('keywords.addNew')</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
        <div class="full-table">
          <div class="bottomActions__btns"><a id="deleteSelected" class="master-btn" href="#">@lang('keywords.deleteSelected')</a>
          </div>
          <form id="dataTableTriggerId_001_form">
            <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
              <thead>
                <tr class="bgcolor--gray_mm color--gray_d">
                  <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                  <th><span class="cellcontent">@lang('keywords.serialNo') </span></th>
                  <th><span class="cellcontent">@lang('keywords.eventCategories')</span></th>
                  <th><span class="cellcontent">@lang('keywords.actions')</span></th>
                </tr>
              </thead>

              <tbody>
                
                @if ( isset($events) && !empty($events) )
                    @foreach ($events as $event)
                        <tr data-id="{{ $event->id }}">
                            <td><span class="cellcontent" id="chbox" data-id="{{ $event->id }}"></span></td>
                            <td><span class="cellcontent">{{ $loop->index + 1 }}</span></td>
                            <td><span class="cellcontent">
                                {{ \App::isLocale('en') ? $event->name : Helper::localization('interests', 'name', $event->id, 2)  }}
                            </span></td>
                            <td>
                                <span class="cellcontent">
                                    <a href="#Edit" data-id="{{ $event->id }}" data-en="{{ $event->name }}" data-arabic="{{ \Helper::localization('interests', 'name', $event->id, 2) }}" class= "action-btn bgcolor--fadegreen color--white editRow"><i class = "fa  fa-pencil"></i></a>
                                    <a data-id="{{ $event->id }}" href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white deleteRecord"><i class = "fa  fa-trash-o"></i></a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @endif

              </tbody>

            </table>
          </form>
        </div>
      </div>
    </div><br>
  </div>

  {{-- Add modal --}}
  <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc" id="modal1">
    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
    <div>
      <div class="row">
        <div class="col-lg-12">
          <h3>@lang('keywords.addNew') @lang('keywords.eventCategories')</h3>
        </div>

        <form action="{{ route('event.add') }}" method="POST">
            {{ csrf_field() }}

            <div class="col-xs-12">
                <div class="tabs--wrapper">
                <div class="clearfix"></div>
                <ul class="tabs">
                    <li id="arabic">العربية</li>
                    <li id="english">English</li>
                </ul>
                <ul class="tab__content">
                    <li class="tab__content_item active" id="arabic-content">
                    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                        <div class="master_field">
                        <label class="master_label" for="cat_id_ar">اضف الحدث باللغة العربية</label>
                        <input name="arabicContent" class="master_input" type="text" placeholder="new categories in arabic"  id="cat_id_ar" required oninvalid="this.setCustomValidity('من فضلك لا تترك هذا الحقل فارغاَ')">
                        </div>
                    </div>
                    </li>
                    <li class="tab__content_item" id="english-content">
                    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                        <div class="master_field">
                        <label class="master_label" for="cat_id_en">Add event name in English</label>
                        <input name="englishContent" class="master_input" type="text" placeholder="new categories in English" id="cat_id_en" required >
                        </div>
                    </div>
                    </li>
                </ul>
                </div>
                <div class="col-xs-12">
                <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                <button type="submit" class="remodal-confirm">@lang('keywords.save')</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- edit modal --}}
  <div class="remodal" data-remodal-id="Edit" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
    <div>
      <div class="row">
        <div class="col-lg-12">
          <h3>@lang('keywords.edit') @lang('keywords.eventCategories')</h3>
        </div>
        <div class="col-xs-12">
          <form action="{{ route('event.edit') }}" method="POST">
            {{ csrf_field() }}

            <input type="hidden" name="id" id="hiddenID">

            <div class="tabs--wrapper">
              <div class="clearfix"></div>
              <ul class="tabs">
                <li id="arabic1">العربية</li>
                <li id="english1">English</li>
              </ul>
              <ul class="tab__content">
                <li class="tab__content_item active" id="arabic1-content">
                  <div class="master_field">
                    <label class="master_label" for="cat_id_ar">تعديل الحدث باللغة العربية</label>
                    <input name="arabicContent"class="master_input" type="text" placeholder="new categories in arabic" Required id="edit_id_ar" oninvalid="this.setCustomValidity('من فضلك لا تترك هذا الحقل فارغاَ')">
                  </div>
                </li>
                <li class="tab__content_item" id="english1-content">
                  <div class="master_field">
                    <label class="master_label" for="cat_id_en">Edit categories in English</label>
                    <input name="englishContent" class="master_input" type="text" placeholder="new categories in English" Required id="edit_id_en">
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-xs-12">
              <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
              <button class="remodal-confirm">@lang('keywords.save')</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function() {

      $('#menu_1').addClass('openedmenu');
      $('#sub_1_5').addClass('pure-active');


        // delete multi
        $('#deleteSelected').click(function(){
            var allVals = [];                   // selected IDs
            var token = '{{ csrf_token() }}';

            // push cities IDs selected by user
            $('input.input-in-table:checked').each(function() {
                allVals.push( $(this).data("id") );
            });

            // check if user selected nothing
            if(allVals.length <= 0) {
            confirm('إختر عميل علي الاقل لتستطيع حذفه');
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
                    url: "{{ route('event.deleteSelected') }}",
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        "ids": ids,
                        "_method": 'POST',
                        "_token": token,
                    },
                    success: function ()
                    {
                        swal("تم الحذف!", "تم الحذف بنجاح", "success");

                        // fade out selected checkboxes after deletion
                        $.each(allVals, function( index, value ) {
                            $('tr[data-id='+value+']').fadeOut();
                        });
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
                } else {
                swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                }
            });
            }
        });

        // delete a row
        $('.deleteRecord').click(function(){
            
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
                    url: "{{ route('event.delete') }}",
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_method": 'POST',
                        "_token": token,
                    },
                    success: function ()
                    {
                        swal("تم الحذف!", "تم الحذف بنجاح", "success");
                        $('tr[data-id='+id+']').fadeOut();
                    },
                        error: function(response) {
                        console.log(response);
                    }
                });
                    
                } else {
                    swal("تم الإلغاء", "المعلومات مازالت موجودة :)", "error");
                }
            });
        });


        $('.editRow').click(function(){

            var id      = $(this).data("id");
            var english = $(this).data("en");
            var arabic  = $(this).data("arabic");
console.log(english);
            $('#hiddenID').val(id);
            $('#edit_id_ar').val(arabic);
            $('#edit_id_en').val(english);
            
        });


    });
</script>


    
@endsection
