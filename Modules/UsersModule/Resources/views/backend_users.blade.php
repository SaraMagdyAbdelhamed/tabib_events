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
        <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="#popupModal_1">@lang('keywords.AddBackendUser')</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
      <div class="full-table">
        <div class="bottomActions__btns"><a class="btn-warning-confirm-all master-btn" href="#">@lang('keywords.deleteSelected')</a>
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
                <th><span class="cellcontent">@lang('keywords.Image')</span></th>
                <th><span class="cellcontent">@lang('keywords.UserType')</span></th>
                <th><span class="cellcontent">@lang('keywords.Status')</span></th>
                <th><span class="cellcontent">@lang('keywords.RegisterationDate')</span></th>
                <th><span class="cellcontent">@lang('keywords.Actions')</span></th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr data-user-id="{{$user->id}}">
                <td><span class="cellcontent"></span></td>
                <td><span class="cellcontent">{{ $loop->index + 1 }}</span></td>
                <td><span class="cellcontent">{{$user->username}}</span></td>
                <td><span class="cellcontent">{{$user->email}}</span></td>
                <td><span class="cellcontent">{{$user->mobile}}</span></td>
                <td><span class="cellcontent"><img src = "{{asset(''.$user->photo)}}" class="img-in-table"></span></td>
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
                    <a href= "#popupModal_1{{$user->id}}" ,  class= "action-btn bgcolor--fadegreen color--white ">
                      <i class = "fa  fa-pencil"></i>
                    </a>
                    <a href="#"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white ">
                      <i class = "fa  fa-trash-o"></i>
                    </a>
                  </span>
                </td>

                <div class="remodal" data-remodal-id="popupModal_1{{$user->id}}" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">

                  {{-- START FORM --}}
                  <form role="form" action="{{route('backend_edit',$user->id)}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    {{csrf_field()}}

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="firstName">@lang('keywords.FullName')</label>
                        <input name="firstName" class="master_input" type="text" placeholder="ex:john_doe" 
                          Required id="firstName" value="{{ $user->first_name ? : '' }}">
                          <span class="master_message inherit">
                            @if ($errors->has('firstName'))
                              {{ $errors->first('firstName')}}
                            @endif
                          </span>
                      </div>
                      <div class="clearfix"></div>
                    </div>

                    {{-- <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="lastName">@lang('keywords.LastName')</label>
                        <input name="lastName" class="master_input" type="text" placeholder="ex:john_doe" 
                          Required id="lastName" onkeypress="return RestrictSpace()" value="{{ $user->last_name ? : '' }}">
                        <span class="master_message inherit">
                        @if ($errors->has('lastName'))
                          {{ $errors->first('lastName')}}
                        @endif</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>                    --}}

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="new_user">@lang('keywords.UserName')</label>
                        <input name="username" value="{{$user->username}}" class="master_input" type="text" placeholder="ex:john_doe" Required id="new_user" onkeypress="return RestrictSpace()"><span class="master_message inherit">
                                @if ($errors->has('name'))
                                  {{ $errors->first('name')}}
                                  @endif</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="new_email">@lang('keywords.UserEmail')</label>
                        <input name="email" value="{{$user->email}}" class="master_input" type="email" placeholder="ex:john_doe@domail.com" required id="new_email"><span class="valid-label"></span><span class="master_message inherit">
                                @if ($errors->has('email'))
                                  {{ $errors->first('email')}}
                                  @endif</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>

                    {{-- Password --}}
                    {{-- <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="password">@lang('keywords.Password')</label>
                        <input name="password" class="master_input" type="password" placeholder="make it complex as possible" 
                          Required id="password" onkeypress="return RestrictSpace()" value="">
                        <span class="master_message inherit">
                          @if ($errors->has('password'))
                            {{ $errors->first('password')}}
                          @endif
                        </span>
                      </div>
                      <div class="clearfix"></div>
                    </div> --}}

                    {{-- Confirm Password --}}
                    {{-- <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="cofirm_password">@lang('keywords.confirmPassword')</label>
                        <input name="password_confirmation" class="master_input" placeholder="confirm password.." type="password" Required id="confirm_password" onkeypress="return RestrictSpace()">
                        <span class="master_message inherit">
                          @if ($errors->has('password_confirmation'))
                            {{ $errors->first('password_confirmation')}}
                          @endif
                        </span>
                      </div>
                      <div class="clearfix"></div>
                    </div> --}}

                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="new_phone">@lang('keywords.UserPhone')</label>
                        <input name="phone" value="{{$user->mobile}}" class="master_input" type="number" placeholder="ex:+201234567" required id="new_phone"><span class="master_message inherit"> @if ($errors->has('phone'))
                                  {{ $errors->first('phone')}}
                                  @endif</span>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label mandatory" for="new_User_type">@lang('keywords.UserType')</label>
                        <select name="rule" class="master_input" id="new_User_type">
                          @foreach($rules as $rule)
                          <option value="{{$rule->id}}" {{ Auth::user()->rules->last()->id == $rule->id ? 'selected' : '' }}>{{$rule->name}}</option>
                          @endforeach
                        </select><span class="master_message inherit">
                                @if ($errors->has('rule'))
                                  {{ $errors->first('rule')}}
                                  @endif</span>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field">
                        <label class="master_label" for="user_img">@lang('keywords.UserImage')</label>
                        <div class="file-upload">
                          <div class="file-select">
                            <div class="file-select-name" id="noFile">click to add user image</div>
                            <input class="chooseFile" type="file" name="image" id="user_img">
                          </div>
                        </div><span class="master_message inherit">png,jpg and max size is 5MB</span>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="master_field text-center">
                        <label class="master_label">@lang('keywords.pleaseSetTheUserStatus')</label>
                        <input {{$user->is_active ? 'checked' :''}}  value="1" class="icon" type="radio" name="status" id="radbtn_4{{$user->id}}">
                        <label for="radbtn_4{{$user->id}}">@lang('keywords.Active')</label>
                        <input {{$user->is_active ? '' :'checked'}}  value="0" class="icon" type="radio" name="status" id="radbtn_5{{$user->id}}">
                        <label for="radbtn_5{{$user->id}}">@lang('keywords.Inactive')</label>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                      <button class="remodal-confirm" type="submit">@lang('keywords.save')</button>
                    </div>
                  </form>
                  {{-- END FORM --}}

                </div>

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
<div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
<form role="form" action="{{route('backend_store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        {{csrf_field()}}
      <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
      <div>
        <div class="row">
          <div class="col-xs-12"></div>
          <h3>@lang('keywords.AddBackendUser')</h3>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="master_field">
              <label class="master_label" for="firstName">@lang('keywords.FullName')</label>
              <input name="firstName" class="master_input" type="text" placeholder="ex:john_doe" 
                Required id="firstName"><span class="master_message inherit">
              @if ($errors->has('firstName'))
                {{ $errors->first('firstName')}}
              @endif</span>
            </div>
            <div class="clearfix"></div>
          </div>

          {{-- <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="master_field">
              <label class="master_label" for="lastName">@lang('keywords.LastName')</label>
              <input name="lastName" class="master_input" type="text" placeholder="ex:john_doe" Required id="lastName" onkeypress="return RestrictSpace()"><span class="master_message inherit">
              @if ($errors->has('lastName'))
                {{ $errors->first('lastName')}}
              @endif</span>
            </div>
            <div class="clearfix"></div>
          </div> --}}

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="new_user">@lang('keywords.UserName')</label>
                <input name="username" class="master_input" type="text" placeholder="ex:john_doe" Required id="new_user" onkeypress="return RestrictSpace()"><span class="master_message inherit">
                @if ($errors->has('username'))
                  {{ $errors->first('username')}}
                @endif</span>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="new_email">@lang('keywords.UserEmail')</label>
                <input name="email" class="master_input" type="email" placeholder="ex:john_doe@domail.com" required id="new_email"><span class="valid-label"></span><span class="master_message inherit">
                        @if ($errors->has('email'))
                          {{ $errors->first('email')}}
                          @endif</span>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field">
              </div>
            </div>
            
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="password">@lang('keywords.Password')</label>
                <input name="password" class="master_input" type="password" placeholder="make it complex as possible" Required id="password" onkeypress="return RestrictSpace()">
                <span class="master_message inherit">
                  @if ($errors->has('password'))
                    {{ $errors->first('password')}}
                  @endif
                </span>
              </div>
              <div class="clearfix"></div>
            </div>


            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="cofirm_password">@lang('keywords.confirmPassword')</label>
                <input name="password_confirmation" class="master_input" placeholder="confirm password.." type="password" Required id="confirm_password" onkeypress="return RestrictSpace()">
                <span class="master_message inherit">
                  @if ($errors->has('password_confirmation'))
                    {{ $errors->first('password_confirmation')}}
                  @endif
                </span>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="new_phone">@lang('keywords.UserPhone')</label>
                <input name="phone" class="master_input" type="number" placeholder="ex:+201234567" required id="new_phone"><span class="master_message inherit"> @if ($errors->has('phone'))
                          {{ $errors->first('phone')}}
                          @endif</span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field">
                <label class="master_label mandatory" for="new_User_type">@lang('keywords.UserType')</label>
                <select name="rule" class="master_input" id="new_User_type">
                  @foreach($rules as $rule)
                  <option value="{{$rule->id}}">{{$rule->name}}</option>
                  @endforeach
                </select><span class="master_message inherit">
                        @if ($errors->has('rule'))
                          {{ $errors->first('rule')}}
                          @endif</span>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="user_img">@lang('keywords.UserImage')</label>
                <div class="file-upload">
                  <div class="file-select">
                    <div class="file-select-name" id="noFile">click to add user image</div>
                    <input class="chooseFile" type="file" name="image" id="user_img" >
                  </div>
                </div><span class="master_message inherit">png,jpg and max size is 5MB</span>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="master_field text-center">
                <label class="master_label">@lang('keywords.pleaseSetTheUserStatus')</label>
                <input value="1" class="icon" type="radio" name="status" id="radbtn_2" checked="false">
                <label for="radbtn_2">@lang('keywords.Active')</label>
                <input value="0" class="icon" type="radio" name="status" id="radbtn_3">
                <label for="radbtn_3">@lang('keywords.Inactive')</label>
              </div>
            </div>
            <div class="col-xs-12">
              <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
              <button class="remodal-confirm" type="submit">@lang('keywords.save')</button>
            </div>

        </div>
      </div>
    </form>
    </div>
@section('js')
<script type="text/javascript">
    function RestrictSpace() {
        if (event.keyCode == 32) {
            return false;
        }
    }
    $(document).ready(function(){
      // "use strict";
      //diable space in enter




      $('.btn-warning-confirm').click(function(){
        var user_id = $(this).closest('tr').attr('data-user-id');
        var _token = '{{csrf_token()}}';
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this user!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#281160',
          confirmButtonText: 'Yes, delete it!',
          closeOnConfirm: false
        },
        function(){
         $.ajax({
           type:'POST',
           url:'{{url('mobile_destroy')}}'+'/'+user_id,
           data:{_token:_token},
           success:function(data){
            $('tr[data-user-id='+user_id+']').fadeOut();
          }
        });
          swal("Deleted!", "Your user  has been deleted!", "success");
        });
      });

      $('.btn-warning-confirm-all').click(function(){
        var selectedIds = $("input:checkbox:checked").map(function(){
          return $(this).closest('tr').attr('data-user-id');
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
        function(){
         $.ajax({
           type:'POST',
           url:'{{url('mobile_destroy_all')}}',
           data:{ids:selectedIds,_token:_token},
           success:function(data){
            $.each( selectedIds, function( key, value ) {
              $('tr[data-user-id='+value+']').fadeOut();
            });
          }
        });
         swal("Deleted!", "Your imaginary file has been deleted!", "success");
       });
      });

    });
</script>
    
{{-- add active class to sidebar menu --}}
    <script>
        $(document).ready(function(){
            $('#menu_2').addClass('openedmenu');
            $('#sub_2_2').addClass('pure-active');
        });
    </script>
    @endsection
@endsection