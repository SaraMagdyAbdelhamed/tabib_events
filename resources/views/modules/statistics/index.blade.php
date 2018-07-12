   @extends('layouts.app')

@section('content')
    <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:url( {{ asset('img/covers/dummy2.jpg ') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">         
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">@lang('keywords.statistics')</h3>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="all-statistics">
                  <div class="col-md-4 col-xs-6">
                    <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-users"></i></span>
                      <div class="stat-box-content inherit"><span class="stat-box-text">@lang('keywords.Number of all users')</span><span class="stat-box-number">{{$allUsers_no}}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-6">
                    <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-male"></i></span>
                      <div class="stat-box-content inherit"><span class="stat-box-text">@lang('keywords.Number of male users')</span><span class="stat-box-number">{{$maleUsers_no}}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-6">
                    <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-female"></i></span>
                      <div class="stat-box-content inherit"><span class="stat-box-text">@lang('keywords.Number of Female users')</span><span class="stat-box-number">{{$femaleUsers_no}}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-6">
                    <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-user"></i></span>
                      <div class="stat-box-content inherit"><span class="stat-box-text">@lang('keywords.Number of users less than 15 years')</span><span class="stat-box-number">{{$kids}}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-6">
                    <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-user"></i></span>
                      <div class="stat-box-content inherit"><span class="stat-box-text">@lang('keywords.Number of users 15-18 years')</span><span class="stat-box-number">{{$age15_18}}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-6">
                    <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-user"></i></span>
                      <div class="stat-box-content inherit"><span class="stat-box-text">@lang('keywords.Number of users 18-25 years')</span><span class="stat-box-number">{{$age18_25}}</span></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-6">
                    <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-user"></i></span>
                      <div class="stat-box-content inherit"><span class="stat-box-text">@lang('keywords.Number of users more than 25 years')</span><span class="stat-box-number">{{$age25_120}}</span></div>
                    </div>
                  </div>
                </div>
              </div>
 @endsection