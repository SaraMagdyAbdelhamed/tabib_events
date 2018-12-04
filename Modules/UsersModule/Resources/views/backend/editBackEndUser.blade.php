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
      <form action="{{ route('backend_update',$user) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
          <div class="form" id="backend_user">
            <div class="row"> 

              {{-- User Type --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label mandatory" for="user_type">@lang('keywords.UserType')</label>
                  <select class="master_input" id="user_type" name="user_type">

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
                  <label class="master_label" for="username">@lang('keywords.FullName')</label>
                <input class="master_input" value="{{$user->first_name}}" type="text" maxlength="40" id="username" name="fullname">
                  
                  @if ( $errors->has('fullname') )                      
                    <span class="master_message inherit">{{ $errors->first('fullname') }}</span>
                  @endif

                </div>
              </div>

              {{-- Username --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="login_username">@lang('keywords.UserName')</label>
                  <input class="master_input" value="{{$user->username}}" type="text" maxlength="20" id="login_username" name="username">
                  
                  @if ( $errors->has('username') )
                    <span class="master_message inherit">{{ $errors->first('username') }}</span>
                  @endif
                </div>
              </div>

              {{-- Email --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="user_email">@lang('keywords.email')</label>
                  <input class="master_input" value="{{$user->email}}" type="email" maxlength="40" placeholder="ex:test@test.com" id="user_email" name="email">
                  
                  @if ( $errors->has('email') )
                    <span class="valid-label"></span><span class="master_message inherit">{{ $errors->first('email') }}</span>
                  @endif
                </div>
              </div>

              {{-- Address --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="user_address">@lang('keywords.address')</label>
                <input class="master_input" value="{{$address}}" type="text" maxlength="100" id="user_address" name="address">
                  @if ( $errors->has('address') )
                    <span class="master_message inherit">{{ $errors->first('address') }}</span>
                  @endif
                </div>
              </div>

              {{-- Password --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="user_password">@lang('keywords.Password')</label>
                  <input class="master_input" type="password" name="password" maxlength="8" minlength="3" id="user_password">

                  <div class="hide-show show-me">Show</div>
                  
                  @if ( $errors->has('password') )
                    <span class="master_message inherit">{{ $errors->first('password') }}</span>
                  @endif

                </div>
              </div>

              {{-- Telephone --}}
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="user_Phone">@lang('keywords.phone number')</label>
                <input class="master_input" value="{{$user->mobile}}" type="number" maxlength="11" minlength="11" id="user_Phone" name="mobile">

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
                    <label class="master_label" for="sponsor_category">@lang('keywords.sponsorCategories')</label>
                    <select class="master_input select2" id="sponsor_category" 
                      multiple="multiple" data-placeholder="Category" style="width:100%;" , name="categories[]">

                      {{-- List all options --}}
                      @if ( isset($sponsorCategories) && !empty($sponsorCategories) )
                          @foreach ($sponsorCategories as $cat)
                              <option value="{{ $cat->id }}">
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
                              <option value="{{ $city->id }}">
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
                              <option value="{{ $region->id }}">
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
                              <option value="{{ $spec->id }}">
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
                <div class="master_field">
                  <label class="master_label" for="user_photo">صورة المستخدم</label>
                  <div class="file-upload">
                    <div class="file-select">
                      <div class="file-select-name" id="noFile"></div>
                      <input class="chooseFile" type="file" name="user_photo" id="user_photo">
                    </div>
                  </div><span class="master_message inherit">message content</span>
                </div>
              </div>

              {{-- Activation --}}
              <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:end;">
                <div class="checkboxrobo">
                  <input type="checkbox" id="activation" name="activation" value="1" @if($user->is_active) checked @endif>
                  <label for="activation">@lang('keywords.Active')</label>
                </div>
              </div>

              {{-- Send Notifications --}}
              <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:end;">
                <div class="checkboxrobo">
                  <input type="checkbox" id="notification" name="notification" value="1">
                  <label for="notification">السماح ب ارسال اشعارات</label>
                </div>
              </div>

            </div>
          </div>
          <div class="div" style="text-align:end;">
            <button class="master-btn   undefined bgcolor--main  bshadow--0" type="submit"><i class="fa fa-save"></i><span>@lang('keywords.save')</span>
            </button>
            <button class="master-btn   undefined bgcolor--fadebrown  bshadow--0" type="submit"><i class="fa fa-close"></i><span>@lang('keywords.cancel')</span>
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
        $("#user_type").on('change',function(){
           let user_type = $("#user_type").val();
           if(user_type == '6'){
             $("#sponsor_section").show();
           }
           else{
               $("#sponsor_section").hide();
           }
    
        });

        // clicking on any city option will trigger an AJAX call to get all regions related to its city.
        // $("#sponsor_cities").change(function(){
        //     var ids = $(this, ':selected').val();
        //     console.log(ids);

        //     if(ids) {
        //       $.each( ids, function(key, value){
        //         console.log(key + " " + value);
        //         $.ajax({
        //           type: 'GET',
        //           dataType: "JSON",
        //           url:  "{{ route('doctor.get.regions') }}",
        //           data: {
        //               'id': key,
        //               '_method': 'GET',
        //               '_token': '{{ csrf_token() }}',
        //           },
        //           success: function(response) {
        //               // foreach response values, append options
        //               $.each( response, function(key, value){
        //                   for(var key in value) {
        //                       $("#sponsor_regions").append($("<option></option>").attr("value", value[key].id).text(value[key].name));
        //                   }
                          
        //               });
        //           }
        //         });
        //       }
        //     }
        // });
    })
  </script>

@endsection