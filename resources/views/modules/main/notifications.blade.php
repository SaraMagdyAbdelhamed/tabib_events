@extends('layouts.app')

@section('content')
<div class="row">

    <form action="{{ route('notifications.add') }}" method="POST">
      {{ csrf_field() }}

    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">         
              <div class="text-wraper">
                <h4 class="cover-inside-title">@lang('keywords.mainData') </h4><i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.notifications') </h4>
              </div>
            </div>
          </div>
          <div class="cover--actions"><span></span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12">
      <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
        <div class="row">

            <div class="col-lg-6">
              <div class="master_field">
                <label class="master_label" for="new_cat">@lang('keywords.distance')</label>
                <input name="notification" class="master_input" type="text" placeholder="@lang('keywords.notifications')" required id="new_cat" value="{{ isset($distance) ? $distance : '' }}">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="master_field">
                <label class="master_label mandatory" for="distance">@lang('keywords.unit') </label>
                <select name="measurement" class="master_input" id="distance">
                  <option value="1" {{ isset($unit) ? ($unit == 1 ? 'selected' : '') : '' }}>@lang('keywords.km') </option>
                  <option value="2" {{ isset($unit) ? ($unit == 2 ? 'selected' : '') : '' }}>@lang('keywords.m')</option>
                  <option value="3" {{ isset($unit) ? ($unit == 3 ? 'selected' : '') : '' }}>@lang('keywords.mi')</option>
                </select>
              </div>
            </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12"> 
      <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
        <div class="col-lg-3 pull-right">
          <button class="master-btn  btn-block color--white bgcolor--fadegreen bradius--noborder bshadow--0" type="submit"><i class="fa fa-check"></i><span>@lang('keywords.save')</span>
          </button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </form>

  </div>    

<script>
  $(document).ready(function(){
      $('#menu_1').addClass('openedmenu');
      $('#sub_1_9').addClass('pure-active');
  });
</script>
@endsection