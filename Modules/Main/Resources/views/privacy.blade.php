@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg ') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">         
              <div class="text-wraper">
                <h4 class="cover-inside-title">@lang('keywords.mainData') </h4><i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.privacy') </h4>
              </div>
            </div>
          </div>
          <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="#popupModal_1">@lang('keywords.EditPrivacy')</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="tabs--wrapper">
        <div class="clearfix"></div>
        <ul class="tabs">
          <li id="arabic" class="{{ App::isLocale('ar') ? 'active' : '' }}">العربية</li>
          <li id="english" class="{{ App::isLocale('en') ? 'active' : '' }}">English</li>
        </ul>
        <ul class="tab__content">
          <li class="tab__content_item {{ App::isLocale('ar') ? 'active' : '' }}" id="arabic-content">
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <p class="text-center">{!! $about_us_arabic !!}</p>
            </div>
          </li>
          <li class="tab__content_item {{ App::isLocale('en') ? 'active' : '' }}" id="english-content">
            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
              <p class="text-center">{!! $about_us_english !!}</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
    <div>
      <div class="row">
        <div class="col-lg-12">
          <h3>@lang('keywords.EditPrivacy')</h3>
        </div>
        <div class="col-xs-12">
          <form action="{{ route('about.edit', ['id' => 3]) }}" method="POST">
            {{ csrf_field() }}
            
            <div class="tabs--wrapper">
                <div class="clearfix"></div>
                <ul class="tabs">
                <li id="arabic_inpopups" class="{{ App::isLocale('ar') ? 'active' : '' }}">العربية</li>
                <li id="english_inpopups" class="{{ App::isLocale('en') ? 'active' : '' }}">English</li>
                </ul>
                <ul class="tab__content">

                <li class="tab__content_item {{ App::isLocale('ar') ? 'active' : '' }}" id="arabic_inpopups-content">
                    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                    <p class="text-left">اضف المحتوي باللغة العربية</p>
                    <textarea class="tinyMce form-control" id="tinyMce-1" name="arabicContent" cols="100" rows="10">{!! $about_us_arabic ? $about_us_arabic : '' !!}</textarea>
                    </div>
                </li>
                <li class="tab__content_item {{ App::isLocale('en') ? 'active' : '' }}" id="english_inpopups-content">
                    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                    <p class="text-left">Add English Content</p>
                    <textarea class="tinyMce form-control" id="tinyMce-2" name="englishContent" cols="100" rows="10">{!! $about_us_english ? $about_us_english : '' !!}</textarea>
                    </div>
                </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            
            <div class="col-xs-12">
                <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
                <button type="submit" class="remodal-confirm">@lang('keywords.save')</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
        $('#menu_1').addClass('openedmenu');
        $('#sub_1_3').addClass('pure-active');
    });
</script>
@endsection