@extends('layouts.app')
@section('content')            
<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">         
            <div class="text-wraper">
              <h4 class="cover-inside-title">@lang('keywords.Users') </h4><i class="fa fa-chevron-circle-right"></i>
              <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.BackendUsers') </h4>
            </div>
          </div>
        </div>

        {{-- Add new backend user --}}
        <div class="cover--actions">
          <a class="bradius--no border-btn master-btn" type="button" href="{{ route('backend_create') }}">@lang('keywords.AddBackendUser')</a>
        </div>

      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
      <div class="full-table">
        <div class="bottomActions__btns">
          <a class="btn-warning-confirm-all master-btn" id="deleteSelected" href="#">@lang('keywords.deleteSelected')</a>
        </div>
        <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
          <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
          <div>
            <div class="row">
              <div class="col-sm-6 col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="filter_countries">@lang('keywords.Countries') </label>
                  <select class="master_input select2" id="filter_countries" multiple="multiple" data-placeholder="Countries" style="width:100%;" >
                    <option>Egypt</option>
                    <option>KSA</option>
                    <option>USA</option>
                    <option>Sudan</option>
                    <option>France</option>
                    <option>Etc</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="filter_cities">@lang('keywords.Cities') </label>
                  <select class="master_input select2" id="filter_cities" multiple="multiple" data-placeholder="Cities" style="width:100%;" >
                    <option>Abha</option>
                    <option>Al-Abwa</option>
                    <option>Al Artaweeiyah</option>
                    <option>Badr</option>
                    <option>Baljurashi</option>
                    <option>Bisha</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <div class="master_field">
                  <label class="master_label">@lang('keywords.SelectGender')</label>
                  <div class="funkyradio">
                    <input type="checkbox" name="radio" id="checkboxbtn_2">
                    <label for="checkboxbtn_2">Male</label>
                  </div>
                  <div class="funkyradio">
                    <input type="checkbox" name="radio" id="checkboxbtn_3">
                    <label for="checkboxbtn_3">Female</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="filter_age">Age</label>
                  <select class="master_input select2" id="filter_age" multiple="multiple" data-placeholder="Age " style="width:100%;" ,>
                    <option>Kids</option>
                    <option>15-18 Y</option>
                    <option>18-25 Y</option>
                    <option>More than 25 Y</option>
                  </select>
                </div>
              </div>
            </div>
          </div><br>
          <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
          <button class="remodal-confirm" data-remodal-action="confirm">@lang('keywords.ApplyFilter')</button>
        </div>
        <form id="dataTableTriggerId_001_form">
          <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
            <thead>
              <tr class="bgcolor--gray_mm color--gray_d">
                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                <th><span class="cellcontent">@lang('keywords.UserName')</span></th>
                <th><span class="cellcontent">@lang('keywords.Email')</span></th>
                <th><span class="cellcontent">@lang('keywords.Phone')</span></th>
                <th><span class="cellcontent">@lang('keywords.UserType')</span></th>
                <th><span class="cellcontent">@lang('keywords.Status')</span></th>
                <th><span class="cellcontent">@lang('keywords.RegisterationDate')</span></th>
                <th><span class="cellcontent">@lang('keywords.Actions')</span></th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr data-id="{{$user->id}}">
                <td><span data-id="{{ $user->id }}" class="cellcontent"></span></td>
                <td><span class="cellcontent">{{ $loop->index + 1 }}</span></td>
                <td><span class="cellcontent">{{$user->username}}</span></td>
                <td><span class="cellcontent">{{$user->email}}</span></td>
                <td><span class="cellcontent">{{$user->mobile}}</span></td>
                <td>
                  <span class="cellcontent">
                    {{$user->CurrentRule()}}
                  </span>
                </td>
                <td>
                  <span class="cellcontent">
                    @if($user->is_active==1)
                      <i class = "fa icon-in-table-true fa-check"></i>
                      @else
                      <i class = "fa icon-in-table-false fa-times"></i>
                    @endif
                  </span>
                </td>
                <td><span class="cellcontent">{{$user->created_at}}</span></td>
                <td>
                  <span class="cellcontent">
                    <a href= "{{ route('backend_edit', $user->id) }}" ,  class= "action-btn bgcolor--fadegreen color--white ">
                      <i class = "fa  fa-pencil"></i>
                    </a>
                    <a href="#" data-id="{{ $user->id }}" id="" class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white deleteRecord">
                      <i class = "fa  fa-trash-o"></i>
                    </a>
                  </span>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </form>
  <!-- <button id="delete-test">Delete Tests</button> -->
</div>
</div>
</div><br>
</div>

@section('js')
<script type="text/javascript">
    function RestrictSpace() {
        if (event.keyCode == 32) {
            return false;
        }
    }

</script>
    
{{-- add active class to sidebar menu --}}
<script>
  $(document).ready(function(){
    $('#menu_2').addClass('openedmenu');
    $('#sub_2_2').addClass('pure-active');

        // delete multi
        $('#deleteSelected').click(function(){
            var allVals = [];                   // selected IDs
            var token = '{{ csrf_token() }}';

            // push cities IDs selected by user
            $('input.input-in-table:checked').each(function() {
                allVals.push( $(this).closest('tr[data-id]').data("id") );
            });

            // check if user selected nothing
            if(allVals.length <= 0) {
            confirm('إختر مستخدم علي الاقل لتستطيع حذفه');
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
                    url: "{{ route('doctor.user.destroy.all') }}",
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
                    url: "{{ route('doctor.user.destroy') }}",
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

  });
</script>
@endsection
@endsection