@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image: {{ asset( '/img/covers/dummy2.jpg ' ) }}   ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="add-mode">Adding mode</div>
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">
              <div class="text-wraper">
                <h4 class="cover-inside-title">@lang('keywords.Doctors')</h4><i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.BackendUsers')</h4>
              </div>
            </div>
          </div>
          <div class="cover--actions">
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">

      {{-- Start Form --}}
      <form id="editBEUser" action="{{ route('backend_update',$user) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
          <div class="form" id="backend_user">
            <div class="row">

              {{-- User Type --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="user_type">@lang('keywords.UserType')</label>
                  <select class="master_input" id="user_type" name="user_type" required>

                    {{-- Hint Option --}}
                    <option disabled selected>-- @lang('keywords.selectUserType') --</option>

                    {{-- List all options --}}
                    @if ( isset($userTypes) && !empty($userTypes) )
                        @foreach ($userTypes as $type)
                            <option value="{{ $type->id }}" @if($type->id == $rule_id) selected @endif>
                              {{ \App::isLocale('en') ? $type->name : $type->trans() }}
                            </option>
                        @endforeach
                    @endif
                  </select>

                  {{-- Validation Message --}}
                  @if ( $errors->has('user_type') )
                    <span class="master_message inherit">{{ $errors->first('user_type') }}</span>
                  @endif

                </div>
              </div>

              {{-- User Name --}}
              <div class="col-md-3 col-sm-2 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="username">@lang('keywords.FullName')</label>
                <input class="master_input" value="{{$user->first_name}}" type="text" maxlength="40" id="username" name="fullname" required>

                  @if ( $errors->has('fullname') )

                    <span class="master_message inherit">{{ $errors->first('fullname') }}</span>
                  @endif

                </div>
              </div>

              {{-- Username --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="login_username">@lang('keywords.UserName')</label>
                  <input class="master_input" value="{{$user->username}}" type="text" maxlength="20" id="login_username" name="username" required>


                  @if ( $errors->has('username') )
                    <span class="master_message inherit">{{ $errors->first('username') }}</span>
                  @endif
                </div>
              </div>

              {{-- Email --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="user_email">@lang('keywords.email')</label>
                  <input class="master_input" value="{{$user->email}}" type="email" maxlength="40" placeholder="ex:test@test.com" id="user_email" name="email" required>


                  @if ( $errors->has('email') )
                    <span class="master_message inherit">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>

              {{-- Address --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="user_address">@lang('keywords.address')</label>
                <input class="master_input" value="{{$address}}" type="text" maxlength="100" id="user_address" name="address" required>
                  @if ( $errors->has('address') )
                    <span class="master_message inherit">{{ $errors->first('address') }}</span>
                  @endif
                </div>
              </div>

              {{-- Password --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="user_password">@lang('keywords.Password')</label>
                  <input class="master_input" type="password" name="password" maxlength="8" minlength="3" id="user_password" required>

                  <div class="hide-show show-me">Show</div>

                  @if ( $errors->has('password') )
                    <span class="master_message inherit">{{ $errors->first('password') }}</span>
                  @endif

                </div>
              </div>

              {{-- Telephone --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="user_Phone">@lang('keywords.phone number')</label>
                <input class="master_input" value="{{$user->mobile}}" type="number" maxlength="11" minlength="11" id="user_Phone" name="mobile" required>

                  @if ( $errors->has('mobile') )
                    <span class="master_message inherit">{{ $errors->first('mobile') }}</span>
                  @endif
                </div>
              </div>

              {{-- Optional fields --}}
              {{-- Sponsor Category --}}
              <div id="sponsor_section">
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="master_field">
                    <label class="master_label mandatory" for="sponsor_category">@lang('keywords.sponsorCategories')</label>
                    <select class="master_input select2" id="sponsor_category"
                      multiple="multiple" data-placeholder="Category" style="width:100%;" , name="categories[]" required>


                      {{-- List all options --}}
                      @if ( isset($sponsorCategories) && !empty($sponsorCategories) )
                           @foreach ($sponsorCategories as $cat)

                              <option value="{{ $cat->id }}"
                                @foreach($categories as $cat_select)
                                 {{ ($cat->id == $cat_select->id) ? 'selected' : '' }}
                                @endforeach
                                >
                                  {{ $cat->name ? : __('keywords.not') }}
                              </option>

                          @endforeach
                      @endif
                    </select>

                    {{-- Validation Message --}}
                    @if ( $errors->has('categories') )
                      <span class="master_message inherit">{{ $errors->first('categories') }}</span>
                    @endif
                  </div>
                </div>

                {{-- Cities --}}
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="sponsor_cities"> @lang('keywords.City') </label>
                    <select class="master_input select2" id="sponsor_cities" multiple="multiple" style="width:100%;" , name="cities[]">

                      {{-- List all options --}}
                      @if ( isset($cities) && !empty($cities) )
                          @foreach ($cities as $city)
                              <option value="{{ $city->id }}"
                              @foreach($user->sponsorCities as $targetcity )
                                {{ ($city->id == $targetcity->id) ? 'selected' : '' }}
                                @endforeach
                                >
                                {{ $city->name ? : __('keywords.not') }}
                              </option>
                          @endforeach
                      @endif
                    </select>

                    {{-- Validation Message --}}
                    @if ( $errors->has('cities') )
                      <span class="master_message inherit">{{ $errors->first('cities') }}</span>
                    @endif
                  </div>
                </div>

                {{-- Regions --}}
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="sponsor_regions">@lang('keywords.region') </label>
                    <select class="master_input select2" id="sponsor_regions" multiple="multiple" style="width:100%;" , name="regions[]">

                      {{-- List all options --}}
                      @if ( isset($regions) && !empty($regions) )
                          @foreach ($regions as $region)
                              <option value="{{ $region->id }}"

                                 @foreach ($user->sponsorRegions as $targetregion)
                                {{ ($region->id == $targetregion->id) ? 'selected' : '' }}
                                @endforeach>
                                {{ $region->name ? : __('keywords.not') }}
                              </option>
                          @endforeach
                      @endif
                    </select>

                    {{-- Validation Message --}}
                    @if ( $errors->has('regions') )
                      <span class="master_message inherit">{{ $errors->first('regions') }}</span>
                    @endif
                  </div>
                </div>

                {{-- Doctors Specialities --}}
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="specialization_target">@lang('keywords.doctorSpecialists')</label>
                    <select class="master_input select2" id="specialization_target"
                      multiple="multiple" style="width:100%;" , name="specialization">
                      {{-- List all options --}}
                      @if ( isset($specs) && !empty($specs) )
                          @foreach ($specs as $spec)
                              <option value="{{ $spec->id }}"

                               @foreach($user->sponsorSpecializations as $targetsec)


                               {{ ($spec->id == $targetsec->id) ? 'selected' : '' }}
                               @endforeach>
                                {{ $spec->name ? : __('keywords.not') }}
                              </option>
                          @endforeach
                      @endif
                    </select>

                    {{-- Validation Message --}}
                    @if ( $errors->has('cities') )
                      <span class="master_message inherit">{{ $errors->first('cities') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              {{-- End of optional fields --}}

              {{-- User Image --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <!-- <div class="master_field">
                  <label class="master_label" for="user_photo">صورة المستخدم</label>
                  <div class="file-upload">
                    <div class="file-select">
                      <div class="file-select-name" id="noFile"></div>
                      <input class="chooseFile" type="file" name="user_photo" id="user_photo">
                    </div>
                  </div>

                  {{-- Validation Message --}}
                  @if ( $errors->has('user_photo') )
                    <span class="master_message inherit">{{ $errors->first('user_photo') }}</span>
                  @endif
                </div> -->
                <label class="master_label mandatory">صورة المستخدم</label>
                  <div id="fileList" style="text-align: -webkit-right;text-align: -moz-right;"></div>
                  <div class="form-group end-txt" id="img_btn" >
                    <input class="inputfile inputfile-1" id="file-1" type="file" name="file-1" onchange="updateList()"  accept=".jpg,.png,.jpeg">
                    <label for="file-1"><span>اختر صورة</span></label>
                  </div>
                  <ul  class="js-uploader__file-list uploader__file-list" id="img_list"padding-left:9%">
                    <li class="js-uploader__file-list uploader__file-list"><span class="uploader__file-list__button"></span><span class="uploader__file-list__button" id="delete"><a class="uploader__icon-button fa fa-times" id="close" onclick="closebtn1()"></a></span><span class="uploader__file-list__thumbnail "style="text-align:right"><img class="thumbnail" id="img_" src="../../../img/male.png"></span></li>
                  </ul>

              </div>

              <input type="hidden" name="image_input" id="image_input" />

              {{-- Activation --}}
              <div class="col-md-12 col-sm-12 col-xs-12" id="activationCol" style="text-align:end;">
                <div class="checkboxrobo">
                  <input type="checkbox" id="activation" name="activation" value="1" @if($user->is_active) checked @endif>
                  <label for="activation">@lang('keywords.Active')</label>
                </div>
              </div>

              {{-- Send Notifications --}}
              <div class="col-md-12 col-sm-12 col-xs-12 " id="notificationCol" style="text-align:end;">
                <div class="checkboxrobo">
                  <input type="checkbox" id="notification" name="notification" value="1">
                  <label for="notification">السماح ب ارسال اشعارات</label>
                </div>
              </div>


            </div>
          </div>
          <div class="div" style="text-align:end;">
            <button class="master-btn   undefined bgcolor--main  bshadow--0" type="button" id="save_btn"><i class="fa fa-save"></i><span>@lang('keywords.save')</span>
            </button>
            <button class="master-btn   undefined bgcolor--fadebrown  bshadow--0" type="button"><i class="fa fa-close"></i><span>@lang('keywords.cancel')</span>
            </button>
          </div>
        </div>

      </form>
      {{-- End Form --}}

    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
        $("#sponsor_section").hide();
         let user_type = $("#user_type").val();
           if(user_type == '6'){
             $("#sponsor_section").show();
           }
        $("#user_type").on('change',function(){
           let user_type = $("#user_type").val();
           if(user_type == '6'){
             $("#sponsor_section").show();
           }
           else{
               $("#sponsor_section").hide();
           }

        });

    })
  </script>
  <script>
    if($('html').attr('lang')=='en'){
      $("#notificationCol,#activationCol").addClass("text-left")
    }
    $(function(){
      $("#editBEUser").validate();
    })
  </script>
    <script type="text/javascript">
      function closebtn1(){
          $("#img_list").remove();
          $("#img_btn").show();
        }
      $(document).ready(function(){
        $("#img_btn").hide();
      })

    </script>
      <script type="text/javascript">
       var listimg = [];

       //close_btn_in image
       function closebtn(index){
           listimg.splice(index,1);
           $("#img_list_item").empty();
           $("#img_btn").show();
         }
      //display image
       updateList = function () {
               let input = document.getElementById('file-1');
               let output = document.getElementById('fileList');
               let files1 = input.files;

                   if (window.File && window.FileList && window.FileReader) {

                       for (var i = 0; i < files1.length; i++) {
                           var file = files1[i];
                           var imgReader = new FileReader();
                           imgReader.addEventListener("load", function (event) {
                               var imgFile = event.target;
                               listimg.push({

                                   'index': listimg.length,
                                   'image': imgFile.result
                               });
                               if($('html').attr('lang')=='ar'){
                                  output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                                for (var i = 0; i < listimg.length; i++) {
                                    output.innerHTML += `<li class="js-uploader__file-list uploader__file-list" id="img_list_item">
                                    <span class="uploader__file-list__button"></span>
                                    <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(${listimg[i].index})" class="uploader__icon-button fa fa-times" >
                                    </a></span>
                                    <span class="uploader__file-list__text"></span>
                                    <span class="uploader__file-list__thumbnail">
                                    <img class="thumbnail"  src="${listimg[i].image}"></span>
                                    </li>`;
                                }
                                output.innerHTML += '</ul>';
                               }
                               if($('html').attr('lang') == 'en'){
                                output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                                for (var i = 0; i < listimg.length; i++) {
                                    output.innerHTML += `<li class="js-uploader__file-list uploader__file-list" id="img_list_item">
                                    <span class="uploader__file-list__button"></span>
                                    <span class="uploader__file-list__thumbnail">
                                    <img class="thumbnail"  src="${listimg[i].image}"></span>
                                    <span class="uploader__file-list__text"></span>

                                    <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(${listimg[i].index})" class="uploader__icon-button fa fa-times" >
                                    </a></span>

                                    </li>`;
                                }
                                output.innerHTML += '</ul>';
                               }


                           });

                           //Read the image
                           imgReader.readAsDataURL(file);
                           $("#file-1")[i].value='';
                       }
                   }
                    $("#img_btn").hide();
           }

    </script>
    <script>
      $(function(){
        if($('html').attr('lang')=='en'){
          $("#img_list").empty();
          $("#img_btn").removeClass("end-txt");

        @if( isset($user->photo) && $user->photo != null )
          $("#img_list").append(`
                <li class="js-upl   oader__file-list uploader__file-list" id="img_list_item">
                                    <span class="uploader__file-list__button"></span>
                                    <span class="uploader__file-list__thumbnail">
                                    <img class="thumbnail"  src="{{ asset( $user->photo ) }}"></span>
                                    <span class="uploader__file-list__text"></span>

                                    <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn1()" class="uploader__icon-button fa fa-times" >
                                    </a></span>

                                    </li>
            `)
        @else
            closebtn1();
        @endif
        }
      })
    </script>

    <script type="text/javascript">
        $("#save_btn").on('click',function(e){
            e.preventDefault();

            var img_input = "#image_input";
            $(img_input).val(listimg[0].image);

            $("#editBEUser").submit();
        })
    </script>

@endsection