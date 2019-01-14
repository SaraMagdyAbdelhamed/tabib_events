@extends('layouts.app')
@section('content')
<style>
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    height: 100% !important;
  }
  /* Optional: Makes the sample page fill the window.
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
  } */
</style>

<div class="remodal" data-remodal-id="mapModal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <h3>Map</h3>
      </div>
      <div class="col-xs-12">
        <form>
          <div class="tabs--wrapper">
            <div class="mapouter">
              <div class="gmap_canvas">
                <iframe id="gmap_canvas" width="600" height="500" src="https://maps.google.com/maps?q=cairo festival&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.embedgooglemap.net"></a></iframe>
              </div>
            </div>
          </div><br>
          <div class="col-xs-12">
            <button class="remodal-cancel" data-remodal-action="cancel">الغاء</button>
            <button class="remodal-confirm" data-remodal-action="confirm">تأكيد</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image: url({{ asset('img/covers/dummy2.jpg') }})   ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
      <div class="add-mode">Adding mode</div>
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h3 class="cover-inside-title  ">@lang('keywords.events')</h3>
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
      <form id="horizontal-pill-steps" action="{{ route('events.add') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        {{ csrf_field() }}
        <h3> @lang('keywords.aboutEvent')</h3>
        <fieldset>
          <div class="row">
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="Event_name">@lang('keywords.eventName') </label>
                <input class="master_input" type="text" maxlength="100" minlength="5" id="Event_name" name="event[name]" Required>
                @if ( $errors->has('event[name]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[name]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="description"> @lang('keywords.eventDescription')</label>
                <textarea class="master_input" name="event[description]" minlength="5" id="description" Required></textarea>
                @if ( $errors->has('event[description]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[description]') }}</span>
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
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="master_field">
                <label class="master_label mandatory" for="searchInput">@lang('keywords.eventPlace') </label>
                <input class="master_input" type="text" id="searchInput" name="event[place]" required>
                @if ( $errors->has('test') )
                  <span class="master_message color--fadegreen">{{ $errors->first('test') }}</span>
                @endif
              </div>
            </div>
              <div class="col-xs-4" hidden>
              <div class="master_field">
                <label class="master_label" for="shop_long">Longtiuide</label>
                <input class="master_input" name="event[long]" id="event_long" placeholder="event_long" type="text">
                @if ( $errors->has('event[long]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[long]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-xs-4" hidden>
              <div class="master_field">
                <label class="master_label" for="shop_lat">Lat</label>
                <input class="master_input" name="event[lat]" id="event_lat" placeholder="event_lat" type="text">
                @if ( $errors->has('event[lat]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[lat]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="master_field">
                <label class="master_label mandatory" for="Specialties">@lang('keywords.special')</label>
                <select class="master_input select2" id="Specialties" multiple="multiple" style="width:100%;"  name="event[special][]" required>
                  @foreach($specializations as $specialization)
                  <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                  @endforeach
                </select>
                @if ( $errors->has('event[special][]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[special][]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="master_field">
                <label class="master_label mandatory" for="Category">@lang('keywords.eventCat')</label>
                <select class="master_input select2" id="Category" multiple="multiple" style="width:100%;"  name="event[category][]" required>
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
                @if ( $errors->has('event[category][]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[category][]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="master_field">
                <label class="master_label mandatory" for="admin_doctor">@lang('keywords.eventDoctor') </label>
                <select class="master_input select2" id="admin_doctor" multiple="multiple" style="width:100%;"  name="event[doctor][]" required>
                    @foreach($doctors as $doctor)
                  <option value="{{$doctor->id}}">{{$doctor->username}}</option>
                  @endforeach
                </select>
                @if ( $errors->has('event[doctor][]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[doctor][]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="start_date">@lang('keywords.eventDateStart')</label>
                <div class="">
                  <input class=" master_input" type="text" Required id="start_date_" name="event[start_date]">
                </div>
                @if ( $errors->has('event[start_date]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[start_date]') }}</span>
                @endif
              </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="end_date">@lang('keywords.eventDateEnd')</label>
                <div class="">
                  <input class=" master_input" type="text" Required id="end_date_" name="event[end_date]">
                </div>
                @if ( $errors->has('event[end_date]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[end_date]') }}</span>
                @endif
              </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="start_time"> @lang('keywords.eventTimeStart')</label>
                <div class="bootstrap-timepicker">
                  <input class="timepicker master_input" type="text" Required id="start_time" name="event[start_time]">
                </div>
                @if ( $errors->has('event[start_time]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[start_time]') }}</span>
                @endif
              </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="master_field">
                <label class="master_label" for="end_time">@lang('keywords.eventTimeEnd')</label>
                <div class="bootstrap-timepicker">
                  <input class="timepicker master_input" type="text" Required id="end_time" name="event[end_time]">
                </div>
                @if ( $errors->has('event[end_time]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[end_time]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-xs-12">
              <hr>
            </div>
          <!----media INfo-->
            <div class="col-sm-12 col-xs-12 text-center">
              <h4 class="text-center">@lang('keywords.EventImage')</h4>
              <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                <div class="main-section">
                  <div id="fileList2"></div>
                  <div class="form-group">
                    <input class="inputfile inputfile-1" id="file-2" type="file" name="event[image]" onchange="updateList2()"  required accept=".jpg,.png,.jpeg">
                    <label for="file-2"><span>@lang('keywords.chooseImage')</span></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <h3>@lang('keywords.tickets')</h3>
        <fieldset>
          <div class="row">
            <div class="col-xs-12" style="text-align:end;">
              <label class="master_label mandatory">@lang('keywords.ticketPayment')</label>
              <div class="col-md-12 col-sm-12 col-xs-12"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="radiorobo">
                  <input type="radio" id="free_ticket" name="event[ticket]" value="0" checked="checked">
                  <label for="free_ticket">@lang('keywords.free')</label>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="radiorobo">
                  <input type="radio" id="paid_ticket" name="event[ticket]" value="1">
                  <label for="paid_ticket">@lang('keywords.paid')</label>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="row" id="paid_section">
            <div class="col-xs-8">
              <div class="master_field">
                <label class="master_label" for="Price">@lang('keywords.price')</label>
                <input class="master_input" type="number" placeholder="50" id="Price" name="event[price]">
                @if ( $errors->has('event[price]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[price]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-xs-4">
              <div class="master_field">
                <label class="master_label mandatory" for="Currency">@lang('keywords.currency')</label>
                <select class="master_input" id="Currency" name="event[currency]">
                @foreach($currencies as $currency)
                  <option value="{{$currency->id}}">{{$currency->symbol}}</option>
                @endforeach
                </select>
                @if ( $errors->has('event[currency]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[currency]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-xs-12">
              <div class="master_field">
                <label class="master_label" for="Available_tickets">@lang('keywords.availableTickets')</label>
                <input class="master_input" type="number" maxlength="50" minlength="2" placeholder="5" id="Available_tickets" name="event[available_tickets]">
                @if ( $errors->has('event[available_tickets]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[available_tickets]') }}</span>
                @endif
              </div>
            </div>
          </div>
        </fieldset>
        <h3> @lang('keywords.eventCall')</h3>
        <fieldset>
          <div class="row">
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="Website">@lang('keywords.website')</label>
                <input class="master_input" type="url" placeholder="ex:www.domain.com" id="Website" name="event[website]">
                @if ( $errors->has('event[website]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[website]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label" for="e_email"> @lang('keywords.email')</label>
                <input class="master_input" type="email" placeholder="ss@test.com" id="e_email" name="event[email]">
                <span class="valid-label"></span>
                @if ( $errors->has('event[email]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[email]') }}</span>
                @endif
              </div>
            </div>
            <div class="col-xs-6">

                <div class="master_field">
                  <label class="master_label mandatory" for="code">@lang('keywords.code')</label>
                  <select class="master_input" id="code" name="event[code]" required>

                    @foreach ($codes as $code)
                        @if ( $code->tele_code != '' && $code->tele_code != null )
                            <option value="{{ $code->id }}">{{ '(' . $code->tele_code . ') ' . $code->name }}</option>
                        @endif
                    @endforeach

                  </select>
                </div>
              <!-- <div class="master_field">
                <label class="master_label" for="Code_numbe">@lang('keywords.code') </label>
                <input class="master_input" type="number" placeholder="ex: 2012545" id="Code_numbe" name="event[code]">
                @if ( $errors->has('event[code]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[code]') }}</span>
                @endif
              </div> -->
            </div>
            <div class="col-xs-6">
              <div class="master_field">
                <label class="master_label mandatory" for="Mobile_number"> @lang('keywords.Phone')</label>
                <input class="master_input" type="number" placeholder="0123456789" id="Mobile_number" name="event[mobile]" required>
                @if ( $errors->has('event[mobile]') )
                  <span class="master_message color--fadegreen">{{ $errors->first('event[mobile]') }}</span>
                @endif
              </div>
            </div>
          </div>
        </fieldset>

                      <h3>@lang('keywords.workshop')</h3>
                      <fieldset>
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="workshop_name">@lang('keywords.workshopName')</label>
                              <input class="master_input" type="text" maxlength="100" minlength="2" id="workshop_name" name="workshop[0][name]">
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="workshop_description">@lang('keywords.workshopDesc')</label>
                              <textarea class="master_input"  maxlength="250" minlength="5" id="workshop_description" name="workshop[0][description]"></textarea>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="workshop_venue">@lang('keywords.workshopPlace') </label>
                              <input class="master_input" type="text" minlength="2" id="workshop_venue" name="workshop[0][place]">
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="workshop_start_date">@lang('keywords.workshopStartDate')</label>
                              <div class="">
                                <input class=" master_input" type="text"  id="workshop_start_date" name="workshop[0][start_date]">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="workshop_end_date">@lang('keywords.workshopEndDate')</label>
                              <div class="">
                                <input class=" master_input" type="text"  id="workshop_end_date" name="workshop[0][end_date]">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="start_time">@lang('keywords.workshopStartTime')</label>
                              <div class="bootstrap-timepicker">
                                <input class="timepicker master_input" type="text"  id="start_time" name="workshop[0][start_time]">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="end_time">@lang('keywords.workshopEndTime')</label>
                              <div class="bootstrap-timepicker">
                                <input class="timepicker master_input" type="text"  id="end_time" name="workshop[0][end_time]">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="Specialties">@lang('keywords.special')</label>
                              <select class="master_input select2" id="Specialties" multiple="multiple" style="width:100%;"  name="workshop[0][special][]">
                                @foreach($specializations as $specialization)
                                <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="admin_workshop_doctor"> @lang('keywords.eventDoctor') </label>
                              <select class="master_input select2" id="admin_workshop_doctor" multiple="multiple" style="width:100%;" name="workshop[0][doctor][]">
                                @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->username}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>






                        </div>
                        <div id="more_workshop"></div>
                        <div class="col-sm-12 col-xs-12">
                          <button class="btn-block master-btn bgcolor--gray_mm" id="add_more_btn" type="button"><i class="fa fa-plus color--main"></i><span class="color--main">Add more</span></button>
                        </div>
                      </fieldset>
                      <h3>@lang('keywords.survey')</h3>
                      <fieldset>
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="master_field">
                              <label class="master_label" for="survey_name">@lang('keywords.Name')</label>
                              <input class="master_input" type="text" id="survey_name" name="survey[0][name]">
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <div class="master_field">
                              <label class="master_label mandatory" for="appears_for">@lang('keywords.surveyFor')</label>
                              <select class="master_input select2" id="appears_for" multiple="multiple" style="width:100%;"  name="survey[0][appears_for]">
                                <option value="1">All attend</option>

                              </select>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="survey_question">@lang('keywords.Squestion')</label>
                              <input class="master_input" type="text" maxlength="100" minlength="10" id="survey_question" name="survey[0][question][0][name]" >
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label " for="survey_answer1">@lang('keywords.Squestion')</label>
                              <input class="master_input" type="text" maxlength="100" id="survey_answer1" name="survey[0][question][0][answer][0]" require >
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label " for="survey_answer2">@lang('keywords.answer')2</label>
                              <input class="master_input" type="text" maxlength="100" id="survey_answer2" name="survey[0][question][0][answer][1]" require>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="survey_answer3">@lang('keywords.answer')3</label>
                              <input class="master_input" type="text" maxlength="100" id="survey_answer3" name="survey[0][question][0][answer][2]">
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="survey_answer4">@lang('keywords.answer')4</label>
                              <input class="master_input" type="text" maxlength="100" id="survey_answer4" name="survey[0][question][0][answer][3]">
                            </div>
                          </div>
                        </div>
                        <div id="more_Question"></div>
                        <div style="text-align:end;">
                          <button class="btn btn-default" id="add_more_question" type="button"><i class="fa fa-plus color--main"></i><span style="color:#004272;">اضافة سؤال</span></button>
                            <div class="checkboxrobo pull-right">
                              <input type="checkbox" id="activation" name="event[active]" checked="true">
                              <label for="activation">@lang('keywords.Active')</label>
                            </div>
                        </div><br>
                        <div id="more_Survey"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 no_padding">
                          <button class="btn-block master-btn" style="background-color:#004272;" id="add_more_survey" type="button"><i class="fa fa-plus color--main"></i><span style="color:white;">اضافة دراسة </span></button>
                        </div>
                      </fieldset>
                      <h3> @lang('keywords.media')</h3>
                      <fieldset>
                        <div class="row">
                          <div class="col-xs-12">
                            <label class="master_label" for="YouTube_video_link">@lang('keywords.addYoutube')</label>
                          </div>
                          <div class="col-xs-6">
                            <div class="master_field">
                              <label class="master_label" for="YouTube_video_link_1">@lang('keywords.link') 1 </label>
                              <input class="master_input" type="url" placeholder="ex:www.youtube.com/video_iD" id="YouTube_video_link_1" name="event[youtube][0]">
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <div class="master_field">
                              <label class="master_label" for="YouTube_video_link_2">@lang('keywords.link') 2</label>
                              <input class="master_input" type="url" placeholder="ex:www.youtube.com/video_iD" id="YouTube_video_link_2" name="event[youtube][1]">
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <hr>
                          </div>
                          <!--media**********************-->
                          <div class="col-sm-12 col-xs-12 text-center">
                            <h4 class="text-center">@lang('keywords.uploadEventImage')</h4>
                            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                              <div class="main-section">
                                <div id="fileList3"></div>
                                <div class="form-group">
                                  <input class="inputfile inputfile-1" id="file-3" type="file" name="event[images][]" data-multiple-caption="{count} files selected" multiple="" onchange="updateList3()" accept=".jpg,.png,.jpeg" >
                                  <label for="file-3"><span>@lang('keywords.chooseImage')</span></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                          <div class="col-xs-12" style="text-align:end;">
                            <div class="checkboxrobo">
                              <input type="checkbox" id="activation" name="event[active]" checked="true">
                              <label for="activation">@lang('keywords.Active')</label>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          </div>
        </fieldset>
      </form>
    </div>
  </div><br>
</div>


<script type="text/javascript" src="../js/scripts.min.js"></script>
<script type="text/javascript">

</script>

<script type="text/javascript">
      var listmedia = [];
      var listinfo= [];
      var check = false;
      function closebtn(index,value){
        if(value==1){
          listmedia.splice(index,1);
          $.each(listmedia,function(id,value){
            value.index = id;
          });
          check = true;
          $("#file-3").prop('disabled', false);
          updateList3();
        }
        if(value==2){
          listinfo.splice(index,1);
          $.each(listinfo,function(id,value){
            value.index = id;
          });
          check = true;
          $("#file-2").prop('disabled', false);
          updateList2();
        }

        }
        //===media
        function updateList3(){
              let input = document.getElementById('file-3');
              let output = document.getElementById('fileList3');
              let files3 = input.files;
              if (check == true) {
                  output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                  for (var i = 0; i < listmedia.length; i++) {
                      output.innerHTML += `<li class="js-uploader__file-list uploader__file-list">
                                      <span class="uploader__file-list__thumbnail">
                                      <img class="thumbnail" id="img_" src="${listmedia[i].image}">
                                      </span><span class="uploader__file-list__text hidden-xs">${listmedia[i].name}</span>
                                      <span class="uploader__file-list__size hidden-xs">${(listmedia[i].size) / 1000} KB</span>
                                      <span class="uploader__file-list__button"></span>
                                      <span class="uploader__file-list__button" id="delete" ><button id="close" onclick="closebtn(${listmedia[i].index},1)" class="uploader__icon-button fa fa-times" >
                                      </button></span></li>`;
                  }
                  output.innerHTML += '</ul>';
                  check = false;
              }

                else {
                  if (files3.length > 5) {
                      alert("max no. 5 images");
                      return;
                  }

                  if (window.File && window.FileList && window.FileReader) {
                         if (files3.length == 5) {
                      $("#file-3").prop('disabled', true);
                  }
                      for (var i = 0; i < files3.length; i++) {
                          var file = files3[i];
                          var imgReadermedia = new FileReader();
                          imgReadermedia.addEventListener("load", function (event) {
                              var imgFilemedia = event.target;
                              listmedia.push({
                                  'name': file.name,
                                  'size': file.size,
                                  'index': listmedia.length,
                                  'image': imgFilemedia.result
                              });
                              output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                              for (var i = 0; i < listmedia.length; i++) {
                                  output.innerHTML += `<li class="js-uploader__file-list uploader__file-list">
                                      <span class="uploader__file-list__thumbnail">
                                      <img class="thumbnail" id="img_" src="${listmedia[i].image}">
                                      </span><span class="uploader__file-list__text hidden-xs">${listmedia[i].name}</span>
                                      <span class="uploader__file-list__size hidden-xs">${(listmedia[i].size) / 1000} KB</span>
                                      <span class="uploader__file-list__button"></span>
                                      <span class="uploader__file-list__button" id="delete" ><button id="close" onclick="closebtn(${listmedia[i].index},1)" class="uploader__icon-button fa fa-times" >
                                      </button></span></li>`;
                              }
                              output.innerHTML += '</ul>';

                          });

                          //Read the image
                          imgReadermedia.readAsDataURL(file);
                      }
                  }

                  if (listmedia.length == 4) {
                      $("#file-3").prop('disabled', true);
                  }
              }


  }
        updateList2 = function(){
              let input = document.getElementById('file-2');
              let output = document.getElementById('fileList2');
              let files2 = input.files;
              if (check == true) {
                  output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                  for (var i = 0; i < listinfo.length; i++) {
                      output.innerHTML += `<li class="js-uploader__file-list uploader__file-list">
                                      <span class="uploader__file-list__thumbnail">
                                      <img class="thumbnail" id="img_" src="${listinfo[i].image}">
                                      </span><span class="uploader__file-list__text hidden-xs">${listinfo[i].name}</span>
                                      <span class="uploader__file-list__size hidden-xs">${(listinfo[i].size) / 1000} KB</span>
                                      <span class="uploader__file-list__button"></span>
                                      <span class="uploader__file-list__button" id="delete" ><button id="close" onclick="closebtn(${listinfo[i].index},2)" class="uploader__icon-button fa fa-times" >
                                      </button></span></li>`;
                  }
                  output.innerHTML += '</ul>';
                  check = false;
              }

              else {
                  if (files2.length > 5) {
                      alert("max no. 5 images");
                      return;
                  }

                  if (window.File && window.FileList && window.FileReader) {
                         if (files2.length == 5) {
                      $("#file-2").prop('disabled', true);
                  }
                      for (var i = 0; i < files2.length; i++) {
                          var file = files2[i];
                          var imgReaderinfo = new FileReader();
                          imgReaderinfo.addEventListener("load", function (event) {
                              var imgFileinfo = event.target;
                              listinfo.push({
                                  'name': file.name,
                                  'size': file.size,
                                  'index': listinfo.length,
                                  'image': imgFileinfo.result
                              });
                              output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                              for (var i = 0; i < listinfo.length; i++) {
                                  output.innerHTML += `<li class="js-uploader__file-list uploader__file-list">
                                      <span class="uploader__file-list__thumbnail">
                                      <img class="thumbnail" id="img_" src="${listinfo[i].image}">
                                      </span><span class="uploader__file-list__text hidden-xs">${listinfo[i].name}</span>
                                      <span class="uploader__file-list__size hidden-xs">${(listinfo[i].size) / 1000} KB</span>
                                      <span class="uploader__file-list__button"></span>
                                      <span class="uploader__file-list__button" id="delete" ><button id="close" onclick="closebtn(${listinfo[i].index},2)" class="uploader__icon-button fa fa-times" >
                                      </button></span></li>`;
                              }
                              output.innerHTML += '</ul>';

                          });

                          //Read the image
                          imgReaderinfo.readAsDataURL(file);
                      }
                  }

                  if (listinfo.length == 4) {
                      $("#file-2").prop('disabled', true);
                  }
              }


          }


    </script>

<script type="text/javascript">
  var form = $("#horizontal-pill-steps").show();
  form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
      onStepChanging: function (event, currentIndex, newIndex)
              {
                  // Allways allow previous action even if the current form is not valid!
                  if (currentIndex > newIndex)
                  {
                      return true;
                  }

                  // Needed in some cases if the user went back (clean up)
                  if (currentIndex < newIndex)
                  {
                      // To remove error styles
                      form.find(".body:eq(" + newIndex + ") span.error").remove();
                      form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                  }
                  form.validate().settings.ignore = ":disabled,:hidden";
                  return form.valid();
              },
              onStepChanged: function (event, currentIndex, priorIndex)
              {
                  // // Used to skip the "Warning" step if the user is old enough.
                  // if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
                  // {
                  //     form.steps("next");
                  // }
                  // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                  if (currentIndex === 2 && priorIndex === 3)
                  {
                      form.steps("previous");
                  }
              },
                  onFinishing: function (event, currentIndex)
                  {


                      var form = $(this);

                      form.submit();
                  },
                  onFinished: function (event, currentIndex) {

                      }
                  }).validate({
              errorPlacement: function errorPlacement(error, element) { element.before(error); }
  });
  dateRange('start_date_','end_date_','2018','7','30','2018','8','30','22/11/2018')
  dateRange('workshop_start_date','workshop_end_date','2018','7','30','2018','8','30','22/11/2018')
</script>

<script type="text/javascript">
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


</script>

<script type="text/javascript">
  (function(){
    var options = {};
    $('.js-uploader__box').uploader(options);
  }());

</script>

<script type="text/javascript">
  $(function () {
    $().bootstrapSwitch && $(".make-switch").bootstrapSwitch();
  });


</script>

<script type="text/javascript">
    var settings={
      labels:{
        current:"current step",
        pagination:"Pagination",
        finish:"FFFFF",
        next:"NNNNN",
        previous:"PPPPP",
        loading:"Loading....."
      }
    }

</script>

<script type="text/javascript">
  $( document ).ready(function() {
    $("#paid_section").hide();
    $("#paid_ticket").on('change',function(){
        swal({
        title: "Paid ticket",
        text: "Will you use our ticketing system?",
        showCancelButton: true,
        closeOnConfirm: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        confirmButtonColor: "#004272"
      },function(){
        $("#paid_section").show();
      })

    });

    $("#free_ticket").on('change',function(){
      $("#paid_section").hide();
    })


      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        var current_count =0;
        var next_count=0;
        $("#add_more_btn").on('click',function(){

          next_count= current_count+1;
          current_count +=1;
          $("#more_workshop").append(`<div><p style="text-align: center;background-color: #1ca6c0;color: azure;"> @lang('keywords.workshop') ${next_count}</p></div>
                          <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop_name">@lang('keywords.workshopName')</label>
                                <input class="master_input" type="text" maxlength="100" minlength="2" placeholder="name" id="workshop_name" name="workshop[${next_count}][name]">
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop_description">@lang('keywords.workshopDesc') </label>
                                <textarea class="master_input"  maxlength="250" minlength="5" id="workshop_description" placeholder="Description" name="workshop[${next_count}][description]"></textarea>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop_venue">@lang('keywords.workshopPlace')</label>
                                <input class="master_input" type="text" minlength="2" placeholder="ex:CFC" id="workshop_venue"  name="workshop[${next_count}][place]">
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop${next_count}_start_date">@lang('keywords.workshopStartDate')</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="start date"  id="workshop${next_count}_start_date" name="workshop[${next_count}][start_date]">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop${next_count}_end_date">@lang('keywords.workshopEndDate')</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="end date"  id="workshop${next_count}_end_date" name="workshop[${next_count}][end_date]">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="start_time">@lang('keywords.workshopStartTime')</label>
                                <div class="bootstrap-timepicker">
                                  <input class="timepicker master_input" type="text" placeholder="start time"  id="start_time" name="workshop[${next_count}][start_time]">
                                </div>
                              </div>
                            </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="end_time">@lang('keywords.workshopEndTime')</label>
                                <div class="bootstrap-timepicker">
                                  <input class="timepicker master_input" type="text" placeholder="end time" Required id="end_time" name="workshop[${next_count}][end_time]">
                                </div>
                              </div>
                              </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="Specialties">@lang('keywords.special')</label>
                                <select class="master_input select2" id="Specialties" multiple="multiple" data-placeholder="placeholder" style="width:100%;"  name="workshop[${next_count}][special][]">
                                   @foreach($specializations as $specialization)
                                <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="admin_workshop_doctor">@lang('keywords.eventDoctor')  </label>
                                <select class="master_input select2" id="admin_workshop_doctor" multiple="multiple" data-placeholder="placeholder" style="width:100%;" name="workshop[${next_count}][doctor][]">
                                  @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->username}}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>

                            `
          )
          $(".timepicker").timepicker({showInputs: false});

          $(".select2").select2();
          dateRange(  `workshop${next_count}_start_date `,`workshop${next_count}_end_date`,'2018','7','30','2018','8','30','22/11/2018')

        })
      })
    </script>
    <script type="text/javascript">

      function add_question(value,question){
        var question_id="more_question_"+value;
        var question = $("#"+question_id+" > div").length+1;

          $(`#more_question_${value}`).append(`
                           <div class="row">

                             <div class="col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_question" style="background-color: beige;">@lang('keywords.Squestion') ${question}</label>
                                 <input class="master_input" type="text" placeholder="question" maxlength="100" minlength="10" id="survey_question" name="survey[${value}][question][${question}][name]">
                               </div>
                             </div>
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label mandatory" for="survey_answer1"> @lang('keywords.answer') 1</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer1" required name="survey[${value}][question][${question}][answer][0]">
                               </div>
                             </div>
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label mandatory" for="survey_answer2">  @lang('keywords.answer') 2</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer2" required name="survey[${value}][question][${question}][answer][1]">
                               </div>
                             </div>
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer3">  @lang('keywords.answer') 3</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer3" name="survey[${value}][question][${question}][answer][2]">
                               </div>
                             </div>
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer4">  @lang('keywords.answer') 4</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer4" name="survey[${value}][question][${question}][answer][3]">
                               </div>
                             </div>
                             </div>
          `)
        }
      $(document).ready(function(){
       var current_count_question = 0;
       var next_count_question = 0;
       var current_count_survey = 0;
       var next_count_survey = 0;
       $("#add_more_question").on('click',function(){

         next_count_question = current_count_question+1;
         current_count_question+=1;
         $("#more_Question").append(
                          `
                           <div class="row">
                             <div class="col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_question" style="background-color: beige;"> @lang('keywords.Squestion') ${next_count_question}</label>
                                 <input class="master_input" type="text" placeholder="question" maxlength="100" minlength="10" id="survey_question" name="survey[0][question][${next_count_question}][name]" required>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label mandatory" for="survey_answer1">  @lang('keywords.answer') 1</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer1" required name="survey[0][question][${next_count_question}][answer][0]">
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label mandatory" for="survey_answer2">  @lang('keywords.answer') 2</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer2" required  name="survey[0][question][${next_count_question}][answer][1]">
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer3">  @lang('keywords.answer') 3</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer3" name="survey[0][question][${next_count_question}][answer][2]">
                               </div>
                             </div>
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer4">  @lang('keywords.answer') 4</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer4" name="survey[0][question][${next_count_question}][answer][3]">
                               </div>
                             </div>
                             </div>
                             `
         );
       });
       $("#add_more_survey").on('click',function(){

         next_count_survey =current_count_survey +1;
       next_count_question = 0;
       current_count_survey +=1;

            $("#more_Survey").append(`

                         <div><p style="text-align: center;background-color: #004272;color: azure;">  @lang('keywords.surveyN') ${next_count_survey}</p></div>
                           <div class="row">
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label" for="survey_name"> @lang('keywords.Name')</label>
                                 <input class="master_input" type="text"  id="survey_name" name="survey[${next_count_survey}][name]">
                               </div>
                             </div>
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label mandatory" for="appears_for_${next_count_survey}"> @lang('keywords.surveyFor')</label>
                                 <select class="master_input select2" id="appears_for_${next_count_survey}" multiple="multiple" data-placeholder="placeholder" style="width:100%;"  name="survey[${next_count_survey}][appears_for]">
                                   <option value="1">All attend</option>

                                 </select>
                               </div>
                             </div>
                             <div class="col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_question">1  @lang('keywords.Squestion')</label>
                                 <input class="master_input" type="text"  maxlength="100" minlength="10" id="survey_question" name="survey[${next_count_survey}][question][0][name]">
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer1">  @lang('keywords.answer') 1 </label>
                                 <input class="master_input" type="text"  maxlength="100" id="survey_answer1" name="survey[${next_count_survey}][question][0][answer][0]">
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer2">  @lang('keywords.answer') 2</label>
                                 <input class="master_input" type="text"  maxlength="100" id="survey_answer2" name="survey[${next_count_survey}][question][0][answer][1]">
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer3">  @lang('keywords.answer') 3</label>
                                 <input class="master_input" type="text"  maxlength="100" id="survey_answer3" name="survey[${next_count_survey}][question][0][answer][2]">
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer4">  @lang('keywords.answer') 4</label>
                                 <input class="master_input" type="text" maxlength="100" id="survey_answer4" name="survey[${next_count_survey}][question][0][answer][3]">
                               </div>
                             </div>
                           </div>
                            <div id="more_question_${next_count_survey}"></div>
                           <div style="text-align:end">
                            <button onclick="add_question(${next_count_survey},${++next_count_question})" class="btn btn-default" id="add_more_question" type="button"><i class="fa fa-plus color--main"></i></button>
                            <div class="checkboxrobo pull-right">
                              <input type="checkbox" id="activation_${next_count_survey}" name="activation_${next_count_survey}" checked="true">
                              <label for="activation_${next_count_survey}">@lang('keywords.Active')</label>
                            </div>
                            </div>
                           <br>
                           `

            );
            $(".select2").select2();

       })

      })
    </script>
       <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
var event_lat;
var event_long;
      function initMap() {

        var input = document.getElementById('event_address');

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {

          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

           shop_lat = place.geometry.location.lat();
         shop_long= place.geometry.location.lng();
         $('#event_lat').val(shop_lat);
         $('#event_long').val(shop_long);
        });

</script>


@endsection