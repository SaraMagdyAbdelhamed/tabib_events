@extends('layouts.app')
@section('content')
		<form role="form" action="{{route('send_notification')}}"  method="post" accept-charset="utf-8">
          {{csrf_field()}}
          <div class="container-fluid">
              <!-- =============== Custom Content ===========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image: url({{ asset('/img/covers/dummy2.jpg ')  }}  )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">         
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">@lang('keywords.notifications')</h3>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><span></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">

                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="event_categories">@lang('keywords.event category')</label>
                          <select class="master_input select2" id="event_categories" multiple="multiple" style="width:100%;" , name="categories[]">
                     <!-- <option selected disabled>choose category</option> -->
                      @foreach($categories as $category)
                      <option value="{{$category['id']}}">{{$category['name']}}</option>
                      @endforeach
                          </select>
                          {{-- <span class="master_message inherit">message content</span> --}}
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="master_field">
                          <label class="master_label mandatory" for="offer_category">@lang('keywords.Doctors')</label>
                          <select class="master_input" id="offer_category" name="doctors">
                          <option selected disabled>choose type</option>
                            <option value="1">All doctors</option>
                            <option value="2">General list doctors</option>
                            <option value="3">My list doctors</option>
                          </select>
                          {{-- <span class="master_message inherit">message content</span> --}}
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="master_field">
                          <label class="master_label">@lang('keywords.gender')</label>
                          <div class="funkyradio">
                            <input name="gender[]" value="1" type="checkbox" id="checkboxbtn_2">
                            <label for="checkboxbtn_2">@lang('keywords.Male')</label>
                          </div>
                          <div class="funkyradio">
                            <input name="gender[]" value="2" type="checkbox" id="checkboxbtn_3">
                            <label for="checkboxbtn_3">@lang('keywords.Female')</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="master_field">
                          <label class="master_label" for="notifiaction_text">@lang('keywords.notification text')</label>
                          <textarea class="master_input" name="notifiaction_text" id="notifiaction_text" required></textarea>
                          {{-- <span class="master_message inherit">message content</span> --}}
                        </div>
                      </div>
                    </div>

                  </div>
                </div><br><br>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                    <div class="col-lg-3 col-lg-offset-3 col-md-3 col-sm-6 col-xs-6">
                      <button class="master-btn  btn-block color--white bgcolor--fadegreen bradius--noborder bshadow--0" type="submit"><span>@lang('keywords.send')</span>
                      </button>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                      <a href="{{ route('notifications') }}" class="master-btn  btn-block color--white bgcolor--fadeblue bradius--noborder bshadow--0" ><span>@lang('keywords.cancel')</span>
                      </a>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
  </form>
@endsection
