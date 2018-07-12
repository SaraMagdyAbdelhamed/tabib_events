@extends('layouts.app')

@section('content')

<style>
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    height: 100% !important;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  #submit {
    color: white;
    background-color: #281160;
    border: 0px;
    padding: 12px 36px;
  }
</style>


<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg ') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
      <div class="add-mode">Adding mode</div>
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">         
            <div class="text-wraper">
              <h4 class="cover-inside-title">@lang('keywords.events')</h4><i class="fa fa-chevron-circle-right"></i>
              <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.addfrombackend')</h4>
            </div>
          </div>
        </div>
        <div class="cover--actions"><span></span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">

      <form id="horizontal-pill-steps" action="{{ route('event_backend.store') }}" method="POST" role="form" enctype="multipart/form-data" >
        {{ csrf_field() }}
        
        <h3>@lang('keywords.infoEn')</h3>
        <fieldset>
          <div class="row">

            {{-- Event name --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="Event_name">@lang('keywords.eventName')</label>
                <input class="master_input" type="text" placeholder="ex:Redbull fl shar3"  id="Event_name" name="english_event_name" value="{{ old('english_event_name') }}">
                @if ($errors->has('event_name'))
                  <span class="master_message color--fadegreen">{{ $errors->first('event_name') }}</span>
                @endif
              </div>
            </div>


            {{-- Description --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="description">@lang('keywords.description')</label>
                <textarea class="master_input" id="description" placeholder="Description"  name="english_description">{{ old('english_description') }}</textarea>
                @if ($errors->has('english_description'))
                  <span class="master_message color--fadegreen">{{ $errors->first('english_description') }}</span>
                @endif
              </div>
            </div>


            {{-- Google Maps API --}}
            <div class="col-xs-12">
              <div class="mapouter">

                {{-- Map Latitude & Longtuide --}}
                <div id="map" style="width: 100%; height: 100%; position: absolute;"></div>
                  <input type="hidden" name="lat" id="lat" >
                  <input type="hidden" name="lng" id="lng" >
              </div>
            </div>

            {{-- Search address --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="venue">@lang('keywords.address')</label>
                <input class="master_input" id="searchInput" type="text" placeholder="ex:CFC" Required id="location" name="address" value="">
                @if ($errors->has('address'))
                  <span class="master_message color--fadegreen">{{ $errors->first('address') }}</span>
                @endif
              </div>
            </div>

            {{-- English Venu --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="venue">@lang('keywords.venue')</label>
                <input class="master_input" type="text" placeholder="ex:CFC"  id="venue" name="english_venu" value="{{ old('english_venu') }}">
                @if ($errors->has('english_venu'))
                  <span class="master_message color--fadegreen">{{ $errors->first('english_venu') }}</span>
                @endif
              </div>
            </div>


            {{-- English Hashtags --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label mandatory">@lang('keywords.Hashtags')</label>
                <input type="text" value="" minlength=2 maxlength=12 data-role="tagsinput" name="english_hashtags" max="2" value="{{ old('english_hashtags') }}">
              </div>
              <div class="clearfix"></div>
            </div>


            {{-- Allowed Genders --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label mandatory" for="gender">@lang('keywords.Gender')</label>
                <select class="master_input select2" id="gender" style="width:100%;" name="gender">
                  <option value="" disabled selected>-- @lang('keywords.Please select a gender') --</option>
                  @if ( isset($genders) && !empty($genders) )
                      @foreach ($genders as $gender)
                          <option value="{{ $gender->id }}">{{ \App::isLocale('en') ? $gender->name : \Helper::localization('Genders', 'name', $gender->id, 2, '') }}</option>
                      @endforeach
                  @endif
                </select>

              </div>
            </div>

            {{-- Allowed Age ranges --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label mandatory" for="age">@lang('keywords.Please select age range')</label>
                <select class="master_input select2" id="age" style="width:100%;" name="age_range">
                  <option value="" disabled selected>-- @lang('keywords.Please select age range') --</option>
                  @if ( isset($age_range) && !empty($age_range) )
                      @foreach ($age_range as $range)
                          <option value="{{ $range->id }}">{{ \App::isLocale('en') ? $range->name : \Helper::localization('age_ranges', 'name', $range->id, 2, '') }}</option>
                      @endforeach
                  @endif
                </select>
                @if ($errors->has('age_range'))
                  <span class="master_message color--fadegreen">{{ $errors->first('age_range') }}</span>
                @endif
              </div>
            </div>


            {{-- Start date --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="start_date">@lang('keywords.start date')</label>
                <div class="bootstrap-timepicker">
                  <input class="datepicker master_input" type="text" placeholder="start date"  id="start_date" name="start_date" value="{{ old('start_date') }}">
                </div>
                @if ($errors->has('start_date'))
                  <span class="master_message color--fadegreen">{{ $errors->first('start_date') }}</span>
                @endif
              </div>
            </div>


            {{-- Start time --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="start_time">@lang('keywords.start date time')</label>
                <div class="bootstrap-timepicker">
                  <input class="timepicker master_input" type="text" placeholder="start time"  id="start_time" name="start_time" value="{{ old('start_time') }}">
                </div>
                @if ($errors->has('start_time'))
                  <span class="master_message color--fadegreen">{{ $errors->first('start_time') }}</span>
                @endif
              </div>
            </div>


            {{-- End date --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="end_date">@lang('keywords.end date')</label>
                <div class="bootstrap-timepicker">
                  <input class="datepicker master_input" type="text" placeholder="end date"  id="end_date" name="end_date" value="{{ old('end_date') }}">
                </div>
                @if ($errors->has('end_date'))
                  <span class="master_message color--fadegreen">{{ $errors->first('end_date') }}</span>
                @endif
              </div>
            </div>


            {{-- End time --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="end_time">@lang('keywords.end date time')</label>
                <div class="bootstrap-timepicker">
                  <input class="timepicker master_input" type="text" placeholder="end time" id="end_time" name="end_time" value="{{ old('end_date') }}">
                </div>
                @if ($errors->has('end_time'))
                  <span class="master_message color--fadegreen">{{ $errors->first('end_time') }}</span>
                @endif
              </div>
            </div>


            {{-- Categories --}}
            <div class="col-sm-6 col-xs-12">
              <div class="master_field">
                <label class="master_label mandatory" for="category">@lang('keywords.category')</label>
                <select class="master_input select2" id="category" multiple="multiple" data-placeholder="Music, Arts..." style="width:100%;" name="categories[]">
                  @if ( isset($categories) && !empty($categories) )
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ \App::isLocale('en') ? $category->name : \Helper::localization('interests', 'name', $category->id, 2, $category->name) }}</option>
                      @endforeach
                  @endif
                </select>
                @if ($errors->has('categories'))
                  <span class="master_message color--fadegreen">{{ $errors->first('categories') }}</span>
                @endif
              </div>
            </div>

            {{-- Suggest as big Event --}}
            <div class="col-sm-3 col-xs-6">
                <div class="master_field">
                  <label class="master_label" for="big_event">@lang('keywords.Suggest as big event')</label>
                  <input class="make-switch" type="checkbox" name="is_big_event" value="1">
                </div>
              </div>


            {{-- Is Event Active or Not --}}
            <div class="col-sm-3 col-xs-6">
                <div class="master_field">
                  <label class="master_label" for="big_event">@lang('keywords.is your event active or in active')</label>
                  <input class="make-switch" type="checkbox" name="is_active" value="1">
                </div>
              </div>

          </div>
        </fieldset>

        <h3>@lang('keywords.infoAr')</h3>
        <fieldset>
          <div class="row">

            {{-- Arabic Event Name --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="Event_name">اسم الحدث</label>
                <input class="master_input" type="text" placeholder="ex:Redbull fl shar3" id="Event_name" name="arabic_event_name" value="{{ old('arabic_event_name') }}">
                @if ($errors->has('arabic_event_name'))
                  <span class="master_message color--fadegreen">{{ $errors->first('arabic_event_name') }}</span>
                @endif
              </div>
            </div>


            {{-- Arabic Description --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="description">وصف الحدث</label>
                <textarea class="master_input" id="description" placeholder="Description" name="arabic_description">{{ old('arabic_description') }}</textarea>
                @if ($errors->has('arabic_description'))
                  <span class="master_message color--fadegreen">{{ $errors->first('arabic_description') }}</span>
                @endif
              </div>
            </div>


            {{-- Arabic Venu --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="venue">مكان الحدث</label>
                <input class="master_input" type="text" placeholder="ex:CFC" id="venue" name="arabic_venu" value="{{ old('arabic_venu') }}">
                @if ($errors->has('arabic_venu'))
                  <span class="master_message color--fadegreen">{{ $errors->first('arabic_venu') }}</span>
                @endif
              </div>
            </div>


            {{-- Arabic Hashtags --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label mandatory">الكلمات البحثية</label>
                <input type="text"  minlength=2 maxlength=12 value="" data-role="tagsinput" name="arabic_hashtags" value="{{ old('arabic_hashtags') }}">
              </div>
              @if ($errors->has('arabic_hashtags'))
                  <span class="master_message color--fadegreen">{{ $errors->first('arabic_hashtags') }}</span>
                @endif
              <div class="clearfix"></div>
            </div>
          </div>
        </fieldset>

        <h3>@lang('keywords.tickets')</h3>
        <fieldset>

          {{-- Is Event for Free or Paid --}}
          <div class="row">
            <div class="col-xs-12">
              <div class="master_field">
                <label class="master_label mandatory">@lang('keywords.Is it free or paid ?')</label>
                <input class="icon" type="radio" name="is_paid" id="radbtn_2_free" checked="true" value="0">
                <label for="radbtn_2_free">@lang('keywords.free')</label>
                <input class="icon" type="radio" name="is_paid" id="radbtn_3_paid" value="1">
                <label for="radbtn_3_paid">@lang('keywords.paid')</label>
              </div>
            </div>
          </div>
          <div class="paid-details">

            {{-- Ticket Price --}}
            <div class="row">
              <div class="col-xs-8">
                <div class="master_field">
                  <label class="master_label" for="Price">@lang('keywords.Price')</label>
                  <input class="master_input" type="number" placeholder="50" min="0" id="Price" name="price" value="{{ old('price') }}">
                  @if ($errors->has('price'))
                    <span class="master_message color--fadegreen">{{ $errors->first('price') }}</span>
                  @endif
                </div>
              </div>


              {{-- Currency Symbol --}}
              <div class="col-xs-4">
                <div class="master_field">
                  <label class="master_label mandatory" for="Currency">@lang('keywords.Currency')</label>
                  <select class="master_input" id="Currency" name="currency">
                    <option value="" disabled selected>-- @lang('keywords.Please Select a Currency Symbol') --</option>
                    @if ( isset($currencies) && !empty($currencies) )
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->symbol }}</option>
                        @endforeach
                    @endif
                  </select>
                  @if ($errors->has('currency'))
                    <span class="master_message color--fadegreen">{{ $errors->first('currency') }}</span>
                  @endif
                </div>
              </div>


              {{-- Number of Tickets --}}
              <div class="col-xs-12">
                <div class="master_field">
                  <label class="master_label" for="Available_tickets">@lang('keywords.Available tickets')</label>
                  <input class="master_input" type="number" placeholder="5" min="0"  id="Available_tickets" name="number_of_tickets" value="{{ old('number_of_tickets') }}">
                  @if ($errors->has('number_of_tickets'))
                  <span class="master_message color--fadegreen">{{ $errors->first('number_of_tickets') }}</span>
                @endif
                </div>
              </div>
            </div>
          </div>
        </fieldset>


        <h3>@lang('keywords.contactInfo')</h3>
        <fieldset>
          <div class="row">

            {{-- Website URL --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="Website">@lang('keywords.Website')</label>
                <input class="master_input" type="url" placeholder="ex:www.domain.com" id="Website" name="website" value="{{ old('website') }}">
                @if ($errors->has('website'))
                  <span class="master_message color--fadegreen">{{ $errors->first('website') }}</span>
                @endif
              </div>
            </div>


            {{-- Email --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="e_email">@lang('keywords.email')</label>
                <input class="master_input" type="email" placeholder="email"  id="e_email" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                  <span class="master_message color--fadegreen">{{ $errors->first('email') }}</span>
                @endif
              </div>
            </div>


            {{-- Code Number --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="Code_numbe">@lang('keywords.Code number')</label>
                <input class="master_input" type="number" placeholder="ex: 2012545"  id="Code_numbe" name="code_number" value="{{ old('code_number') }}">
                @if ($errors->has('code_number'))
                  <span class="master_message color--fadegreen">{{ $errors->first('code_number') }}</span>
                @endif
              </div>
            </div>


            {{-- Mobile Number --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="Mobile_number">@lang('keywords.mobile number')</label>
                <input class="master_input" type="number" placeholder="0123456789"  id="Mobile_number" name="mobile_number" value="{{ old('mobile_number') }}">
                @if ($errors->has('mobile_number'))
                  <span class="master_message color--fadegreen">{{ $errors->first('mobile_number') }}</span>
                @endif
              </div>
            </div>
          </div>
        </fieldset>


        <h3>@lang('keywords.media')</h3>
        <fieldset>
          
          <div class="row">

            {{-- 1st Youtube vedio in Arabic --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="YouTube_video_en">@lang('keywords.YouTube-ar-1')</label>
                <input class="master_input" type="url" placeholder="ex:www.youtube.com/video_iD" id="YouTube_video_en" name="youtube_ar_1" value="{{ old('youtube_ar_1') }}">
                @if ($errors->has('youtube_ar_1'))
                  <span class="master_message inherit">{{ $errors->first('youtube_ar_1') }}</span>
                @endif
              </div>
            </div>

            {{-- 1st Youtube video in English --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="YouTube_video_ar">@lang('keywords.YouTube-en-1')</label>
                <input class="master_input" type="url" placeholder="ex:www.youtube.com/video_iD" id="YouTube_video_ar" name="youtube_en_1" value="{{ old('youtube_en_1') }}">
                @if ($errors->has('youtube_en_1'))
                  <span class="master_message inherit">{{ $errors->first('youtube_en_1') }}</span>
                @endif
              </div>
            </div>

            {{-- 2nd Youtube video in Arabic --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="YouTube_video_en">@lang('keywords.YouTube-ar-2')</label>
                <input class="master_input" type="url" placeholder="ex:www.youtube.com/video_iD" id="YouTube_video_en" name="youtube_ar_2" value="{{ old('youtube_ar_2') }}">
                @if ($errors->has('youtube_ar_2'))
                  <span class="master_message inherit">{{ $errors->first('youtube_ar_2') }}</span>
                @endif
              </div>
            </div>

            {{-- 2nd Youtube video in English --}}
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="YouTube_video_ar">@lang('keywords.YouTube-en-2')</label>
                <input class="master_input" type="url" placeholder="ex:www.youtube.com/video_iD" id="YouTube_video_ar" name="youtube_en_2" value="{{ old('youtube_en_2') }}">
                @if ($errors->has('youtube_en_2'))
                  <span class="master_message inherit">{{ $errors->first('youtube_en_2') }}</span>
                @endif
              </div>
            </div>
            <div class="col-xs-12">
              <hr>
            </div>
              
          {{-- Arabic images --}}
          <div class="col-sm-6 col-xs-12 text-center">
            <h4 class="text-center">upload event images (in Arabic ) (max no. 5 images)</h4>
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="main-section">
                <div id="fileList"></div>
                <div class="form-group">
                  <input class="inputfile inputfile-1" id="file-1" type="file" name="arabic_images[]" data-multiple-caption="{count} files selected" multiple="" onchange="updateList()">
                  <label for="file-1"><span>Choose a file</span></label>
                </div>
              </div>
            </div>
          </div>

          {{-- English images --}}
          <div class="col-sm-6 col-xs-12 text-center">
            <h4 class="text-center">upload event images (in English ) (max no. 5 images)</h4>
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <div class="main-section">
                <div id="fileList2"></div>
                <div class="form-group">
                  <input class="inputfile inputfile-1" id="file-2" type="file" name="english_images[]" data-multiple-caption="{count} files selected" multiple="" onchange="updateList2()">
                  <label for="file-2"><span>Choose a file</span></label>
                </div>
              </div>
            </div>
          </div>

          </div>

          <button type="submit" id="submitButton" hidden>Submit</button>
        </fieldset>
      </form>


    </div>
  </div><br>
</div>



<script type="text/javascript">
  $(document).ready(function(){
    $(function () {
      $(".select2").select2();
    });

    var listAr = [];
    var listEn = [];
    var check = false;
    var img;
    var reader=new FileReader();
    function updateIndexList(){
    
    }

    function closebtn(index,value) {
      if(value==1){
        listAr.splice(index,1);
        $.each(listAr,function(id,value){
          value.index = id;
        });
        check = true;
        $("#file-1").prop('disabled', false);
        updateList();
      }
      if(value==2){
        listEn.splice(index,1);
        $.each(listEn,function(id,value){
          value.index = id;
        });
        check = true;
        $("#file-2").prop('disabled', false);
        updateList2();
      }
    }

    updateList = function() {
      let input = document.getElementById('file-1');
      let output = document.getElementById('fileList');
      let files1 = input.files; 
      if(check==true){
        
        output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
        for (var i = 0; i < listAr.length; i++) {
        output.innerHTML += '<li class="js-uploader__file-list uploader__file-list">'+
                            '<span class="uploader__file-list__thumbnail">'+
                            '<img class="thumbnail" id="img_" src="+list.img+">'+
                            '</span>'+'<span class="uploader__file-list__text">'+listAr[i].name+'</span>'+
                            '<span class="uploader__file-list__size">' +(listAr[i].size)/1000 +'KB'+'</span>'+
                            '<span class="uploader__file-list__button">'+'</span>'+
                            '<span class="uploader__file-list__button" id="delete" >'+''+'<button id="close" onclick="closebtn('+listAr[i].index+','+1+')" class="uploader__icon-button fa fa-times" >'+
                            '</button>'+'</span>'+'</li>';
                      
                      
      }
      output.innerHTML += '</ul>';
      check = false;
      }
      else{
        if(files1.length > 5){
        alert("max no. 5 images");
        return;
      }
      for (var i = 0; i < files1.length; i++) {
        var file = files1[i];
        
            listAr.push({'name':file.name,'size':file.size,'index':listAr.length});
    
        }
    
      output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
      for (var i = 0; i < listAr.length; i++) {
        output.innerHTML += '<li class="js-uploader__file-list uploader__file-list">'+
                            '<span class="uploader__file-list__thumbnail">'+
                            '<img class="thumbnail" id="img_" src="+list.img+">'+
                            '</span>'+'<span class="uploader__file-list__text">'+listAr[i].name+'</span>'+
                            '<span class="uploader__file-list__size">' +(listAr[i].size)/1000 +'KB'+'</span>'+
                            '<span class="uploader__file-list__button">'+'</span>'+
                            '<span class="uploader__file-list__button" id="delete" >'+''+'<button id="close" onclick="closebtn('+listAr[i].index+','+1+')" class="uploader__icon-button fa fa-times" >'+
                            '</button>'+'</span>'+'</li>';
      }
      output.innerHTML += '</ul>';
      }
    
      if(listAr.length == 5){
          $("#file-1").prop('disabled', true);
        }
      
      }
    
    updateList2 = function(){
      let input = document.getElementById('file-2');
      let output = document.getElementById('fileList2');
      let files2 = input.files; 
      if(check==true){
        output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
      for (var i = 0; i < listEn.length; i++) {
        output.innerHTML += '<li class="js-uploader__file-list uploader__file-list">'+
        '<span class="uploader__file-list__thumbnail">'+
        '<img class="thumbnail" id="img_" src="+list.img+">'+'</span>'+
        '<span class="uploader__file-list__text">'+listEn[i].name+'</span>'+
        '<span class="uploader__file-list__size">' +(listEn[i].size)/1000 +'KB'+
        '</span>'+'<span class="uploader__file-list__button">'+'</span>'+
        '<span class="uploader__file-list__button" id="delete" >'+''
        +'<button id="close" onclick="closebtn('+listEn[i].index+','+2+')" class="uploader__icon-button fa fa-times" >'+'</span>'+'</li>';
      }
      output.innerHTML += '</ul>';
      check=false;
    
      }
      else{
        if(files2.length > 5){
          alert("max no. 5 images");
          return;
        }
        for (var j = 0; j < files2.length; j++) {
        var file = files2[j];
        listEn.push({'name':file.name,'size':file.size,'index':listEn.length});
        if(listEn.length == 5){
          $("#file-2").prop("disabled",true);
        }
        }  
      output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
      for (var i = 0; i < listEn.length; i++) {
        output.innerHTML += '<li class="js-uploader__file-list uploader__file-list">'+
        '<span class="uploader__file-list__thumbnail">'+
        '<img class="thumbnail" id="img_" src="+list.img+">'+'</span>'+
        '<span class="uploader__file-list__text">'+listEn[i].name+'</span>'+
        '<span class="uploader__file-list__size">' +(listEn[i].size)/1000 +'KB'+
        '</span>'+'<span class="uploader__file-list__button">'+'</span>'+
        '<span class="uploader__file-list__button" id="delete" >'+''
        +'<button id="close" onclick="closebtn('+listEn[i].index+','+2+')" class="uploader__icon-button fa fa-times" >'+'</span>'+'</li>';
      }
      output.innerHTML += '</ul>';
      }
      if(listEn.length == 5){
          $("#file-2").prop("disabled",true);
        }
        
      }
    
  
    
    var form = $("#horizontal-pill-steps").show();
    form.steps({
      headerTag: "h3",
      bodyTag: "fieldset",
      transitionEffect: "slideLeft",
    });

    $(function() {
      $('input, select').on('change', function(event) {
        var $element = $(event.target),
          $container = $element.closest('.example');
    
        if (!$element.data('tagsinput'))
          return;
    
        var val = $element.val();
        if (val === null)
          val = "null";
        $('code', $('pre.val', $container)).html( ($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\"") );
        $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));
      }).trigger('change');
    });

  });
  
  $(function () {
    $('.datepicker').datepicker({autoclose: true});
    $(".timepicker").timepicker({showInputs: false});
  });

  (function(){
    var options = {};
    $('.js-uploader__box').uploader(options);
  }());

  $(function () {
    $().bootstrapSwitch && $(".make-switch").bootstrapSwitch();
  });

  
</script>

<script>
  $( document ).ready(function() {
      
      
      $('.paid-details').fadeOut();
      
      $('label[for="radbtn_3_paid"]').on('click' , function(){
        $('.paid-details').fadeIn(100);
      });
      
      $('label[for="radbtn_2_free"]').on('click' , function(){
        $('.paid-details').fadeOut();
      });
    
    });
</script>

{{-- Prevent Enter key from submitting form --}}
<script>
  $(document).ready(function() {
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });
</script>


{{-- Click on finish button triggers a hidden submit button --}}
<script>
  
  $(document).ready(function() {
    $("#finish1").click(function(){
      $("#submitButton").trigger('click');
    });
  });
</script>


@endsection