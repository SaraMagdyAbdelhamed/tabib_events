@extends('layouts.app')
@section('content')
  <!-- =============== Custom Content ===========-==========-->
  <div class="row">
    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( 'img/covers/dummy2.jpg' )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">         
              <div class="text-wraper">
                <h3 class="cover-inside-title  ">التقارير والاحصائيات</h3>
              </div>
            </div>
          </div>
          <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="{{route('sponsor_report')}}">تقرير الراعى</a><a class="bradius--no border-btn master-btn" type="button" href="{{route('event_report')}}">تقرير الايفينت</a>
          </div>
        </div>
      </div>
    </div>
    <div class="all-statistics">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-users"></i></span>
          <div class="stat-box-content inherit"><span class="stat-box-text">العدد الكلى للاطباء ب النظام</span><span class="stat-box-number">{{$doctors}}</span></div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-male"></i></span>
          <div class="stat-box-content inherit"><span class="stat-box-text">عدد الاطباء الذين تم اضافتهم من قبل المنظمين</span><span class="stat-box-number">{{$doc_org}}</span></div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-female"></i></span>
          <div class="stat-box-content inherit"><span class="stat-box-text">العدد الكلى للاطباء الذين تم تسجيلهم من تطبيق الموبيل</span><span class="stat-box-number">{{$doc_mob}}</span></div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-user"></i></span>
          <div class="stat-box-content inherit"><span class="stat-box-text">العدد الكلى للايفنت المضافة</span><span class="stat-box-number">{{$events}}</span></div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-user"></i></span>
          <div class="stat-box-content inherit"><span class="stat-box-text">عدد الايفنتات المضافة من قبل المنظمين</span><span class="stat-box-number">{{$event_org}}</span></div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="stat-box margin--small-top-bottom inherit bshadow--0 inherit"><span class="stat-box-icon inherit inherit"><i class="fa fa fa-user"></i></span>
          <div class="stat-box-content inherit"><span class="stat-box-text">العدد الكلى للايفنتات المضافة من قبل المسئولين</span><span class="stat-box-number">{{$event_super}}</span></div>
        </div>
      </div>
    </div>
  </div>

@endsection