@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( '../img/covers/dummy2.jpg ' )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="edit-mode">Edit mode</div>
        <div class="row">
            <div class="col-xs-12">
            <div class="text-xs-center">         
                <div class="text-wraper">
                <h4 class="cover-inside-title">@lang('keywords.Doctors')</h4><i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.generalList')</h4>
                </div>
            </div>
            </div>
            <div class="cover--actions"><span></span>
            </div>
        </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="col-md-12-col-sm-12-col-xs-12" style="text-align:end;">

        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom" id="form_">
            <form action="{{ route('doctor.update') }}" method="POST" enctype="multipart/form-data"  id="new_dr_form">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $doctor->id }}">

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label" for="doctor_name">
                            @lang('keywords.doctorName')
                        </label>
                        <input class="master_input" type="text" maxlength="100" id="doctor_name" name="doctorName" value="{{ $doctor->username ? : '' }}">
                        @if ( $errors->has('doctorName') )
                            <span class="master_message inherit">{{ $errors->first('doctorName') }}</span>    
                        @endif                   
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label" for="doctor_email">
                            @lang('keywords.doctorEmail')
                        </label>
                        <input class="master_input" type="email" maxlength="35" id="doctor_email" name="doctorEmail" value="{{ $doctor->email ? : '' }}">
                        <span class="valid-label"></span>
                        @if ( $errors->has('doctorEmail') )
                            <span class="master_message inherit">{{ $errors->first('doctorEmail') }}</span>    
                        @endif 
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="master_field">
                            <label class="master_label mandatory" for="doctor_country_code">
                                @lang('keywords.countryCode')
                            </label>
                            <select name="doctorTeleCode" class="master_input select2" style="width:100%;">
                                <option disabled selected>-- @lang('keywords.selectTeleCode') --</option>
                                @if (isset($countries) && !empty($countries))
                                    @foreach ($countries as $country)   
                                        @if ($country->tele_code)
                                            <option value="{{ $country->id }}" {{ $country->id == $doctor->tele_code ? "selected" : "" }} class="country">
                                                {{ '('. $country->tele_code .') ' . $country->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="master_field">
                            <label class="master_label" for="doctor_mobile">@lang('keywords.mobile1')</label>
                            <input class="master_input" type="number" id="doctor_mobile" name="mobile1" value="{{ $doctor->mobile ? : '' }}">
                            @if ( $errors->has('mobile1') )
                                <span class="master_message inherit">{{ $errors->first('mobile1') }}</span>    
                            @endif 
                        </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="master_field">
                            <label class="master_label" for="doctor_mobile2">@lang('keywords.mobile2')</label>
                            <input class="master_input" type="number" id="doctor_mobile2" name="mobile2" value="{{ $doctor->userInfo ? $doctor->userInfo->mobile2 : '' }}">
                            @if ( $errors->has('mobile2') )
                                <span class="master_message inherit">{{ $errors->first('mobile2') }}</span>    
                            @endif 
                        </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="master_field">
                            <label class="master_label" for="doctor_mobile3">@lang('keywords.mobile3')</label>
                            <input class="master_input" type="number" id="doctor_mobile3" name="mobile3" value="{{ $doctor->userInfo ? $doctor->userInfo->mobile3 : '' }}">
                            @if ( $errors->has('mobile3') )
                                <span class="master_message inherit">{{ $errors->first('mobile3') }}</span>    
                            @endif 
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label mandatory" for="doctor_country">@lang('keywords.Country')</label>
                        <select name="doctorCountry" class="master_input select2" id="doctor_country" style="width:100%;">
                            <option disabled selected>-- @lang('keywords.selectCountry') --</option>
                            @if (isset($countries) && !empty($countries))
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == $doctor->country->id ? "selected" : "" }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label mandatory" for="doctor_city">@lang('keywords.City')</label>
                        <select name="doctorCity" class="master_input select2" id="doctor_city" style="width:100%;" >
                            <option selected disabled>-- @lang('keywords.selectCity') --</option>

                            @if (isset($cities) && !empty($cities))
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ $city->id == $doctor->city->id ? "selected" : "" }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            @endif

                            {{-- options generated using ajax call --}}

                        </select>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label mandatory" for="doctor_Region">@lang('keywords.region')</label>
                        <select name="doctorRegion" class="master_input select2" id="doctor_Region" style="width:100%;">
                            <option selected disabled>-- @lang('keywords.selectRegion') --</option>

                            @if (isset($regions) && !empty($regions))
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}" {{ $region->city_id == $doctor->city->id ? "selected" : "" }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            @endif

                            {{-- options generated using ajax call --}}

                        </select>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label" for="doctor_address">@lang('keywords.address')</label>
                        <input class="master_input" type="text" id="doctor_address" name="doctorAddress" value="{{ $doctor->userInfo ? $doctor->userInfo->address : '' }}">
                        @if ( $errors->has('doctorAddress') )
                            <span class="master_message inherit">{{ $errors->first('doctorAddress') }}</span>    
                        @endif 
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label" for="filter_cities">@lang('keywords.specialization')</label>
                        <select name="doctorSpecialization" class="master_input select2" id="filter_cities" style="width:100%;">
                            <option selected disabled>-- @lang('keywords.selectSpec') --</option>

                            @if (isset($specs) && !empty($specs))
                                @foreach ($specs as $spec)
                                    <option value="{{ $spec->id }}" {{ $spec->id == $doctor->userInfo->specialization->id ? 'selected' : '' }}>
                                        {{ $spec->name }}
                                    </option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label" for="doctor_password">@lang('keywords.newPassword')</label>
                        <input class="master_input" type="password" name="password" maxlength="20" minlength="8" id="doctor_password">
                        <div class="hide-show show-me">Show</div>
                        @if ( $errors->has('password') )
                            <span class="master_message inherit">{{ $errors->first('password') }}</span>    
                        @endif 
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="master_field">
                        <label class="master_label">@lang('keywords.SelectGender')</label>
                        <div class="funkyradio">
                        <input type="radio" id="checkboxbtn_2" name="gender" value="1" {{ $doctor->gender_id == 1 ? 'checked' : '' }}>
                        <label for="checkboxbtn_2">@lang('keywords.male')</label>
                        </div>
                        <div class="funkyradio">
                        <input type="radio" id="checkboxbtn_3" name="gender" value="2" {{ $doctor->gender_id == 2 ? 'checked' : '' }}>
                        <label for="checkboxbtn_3">@lang('keywords.female')</label>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="master_label" for="doctor_image">صورة الطبيب</label>
                    <div id="fileList"></div>
                    <div class="form-group" id="img_dr_">
                        <input class="inputfile inputfile-1" id="file-1" type="file" name="doctorImage">
                        <label for="file-1"><span>Choose a file</span></label>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="checkboxrobo">
                        <input type="checkbox" id="activation" name="activation" value="1" {{ $doctor->is_active ? "checked" : "" }}>
                        <label for="activation">@lang('keywords.Activate')</label>
                    </div>
                    </div>
                </div>
                <div class="div" style="text-align:end;">
                    <button class="master-btn   undefined bgcolor--main  bshadow--0" type="submit"><i class="fa fa-save"></i><span>@lang('keywords.save')</span>
                    </button>
                    <button class="master-btn   undefined bgcolor--fadebrown  bshadow--0" type="submit"><i class="fa fa-close"></i><span>@lang('keywords.cancel')</span>
                    </button>
                </div>
            </form>
            
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var listimg = [];
   
    //close_btn_in image
    function closebtn(index){
        listimg.splice(index,1);
        $("#img_list_item").empty();
        $("#img_dr_").show();
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
   
                        });
   
                        //Read the image
                        imgReader.readAsDataURL(file);
                        $("#file-1")[i].value='';
                    }
                }
                 $("#img_dr_").hide();
        }
</script>


<script>
    $(document).ready(function(){

        // clicking on any country option will trigger an AJAX call to get all cities related to its country.
        $("#doctor_country").change(function(){

            // delete current options
            $("#doctor_city").children("option").remove();
            $("#doctor_Region").children("option").remove();

            var id = $(this, ':selected').val();
            // console.log(id);

            if(id) {
                $.ajax({
                    type: 'GET',
                    dataType: "JSON",
                    url:  "{{ route('doctor.get.cities') }}",
                    data: {
                        'id': id,
                        '_method': 'GET',
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {

                        // foreach response values, append options
                        $.each( response, function(key, value){
                            for(var key in value) {
                                // console.log(value[key].id +": "+ value[key].name);
                                $("#doctor_city").append($("<option></option>").attr("value", value[key].id).text(value[key].name));
                            }
                            
                        });
                    }
                });
            }
        });

        // clicking on any city option will trigger an AJAX call to get all regions related to its city.
        $("#doctor_city").change(function(){

            var id = $(this, ':selected').val();
            // console.log(id);

            if(id) {
                $.ajax({
                    type: 'GET',
                    dataType: "JSON",
                    url:  "{{ route('doctor.get.regions') }}",
                    data: {
                        'id': id,
                        '_method': 'GET',
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // foreach response values, append options
                        $.each( response, function(key, value){
                            for(var key in value) {
                                $("#doctor_Region").append($("<option></option>").attr("value", value[key].id).text(value[key].name));
                            }
                            
                        });
                    }
                });
            }
        });

    });
</script>

@endsection