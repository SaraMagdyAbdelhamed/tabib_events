@extends('layouts.app')
@section('content')
<div class="row">

                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url({{asset( 'img/covers/dummy2.jpg ' )}})  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="edit-mode">Editing mode</div>
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
                  <div class="tabs--wrapper">
                    <div class="clearfix"></div>
                    <ul class="tabs">
                      <li id="info"> @lang('keywords.aboutEvent')</li>
                      <li id="tickets">@lang('keywords.tickets')</li>
                      <li id="contactInfo"> @lang('keywords.eventCall')</li>
                      <li id="workshops"> @lang('keywords.workshop')</li>
                      <li id="surveys">@lang('keywords.survey') </li>
                      <li id="media">@lang('keywords.media')</li>
                    </ul>
                     <form action="{{ route('events.update',$event->id) }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    {{csrf_field()}}
                    <ul class="tab__content">
                   
                      <li class="tab__content_item active" id="info-content">
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                          <div class="row">
                            <div class="col-xs-6">
                              <div class="master_field">
                                <label class="master_label" for="Event_name">@lang('keywords.eventName') </label>
                                <input class="master_input" type="text" maxlength="100" minlength="5" id="Event_name" name="event[name]" Required value="{{$event->name}}">
                                @if ( $errors->has('event[name]') )
                                <span class="master_message color--fadegreen">{{ $errors->first('event[name]') }}</span>
                                @endif
                              </div>
                            </div>
                            <div class="col-xs-6">
                              <div class="master_field">
                                <label class="master_label" for="description"> @lang('keywords.eventDescription')</label>
                                 <textarea class="master_input" name="event[description]" minlength="5" id="description" Required>{{$event->description}}</textarea>
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
                                <label class="master_label" for="venue">@lang('keywords.eventPlace')</label>
                                <input class="master_input" type="text" id="searchInput" name="event[place]" value="{{$event->address}}">
                                    @if ( $errors->has('test') )
                                    <span class="master_message color--fadegreen">{{ $errors->first('test') }}</span>
                                    @endif                            
                              </div>
                            </div>
                            <div class="col-xs-6" hidden>
                            <div class="master_field">
                                <label class="master_label" for="shop_long">Longtiuide</label>
                                <input class="master_input" name="event[long]" id="event_long" placeholder="event_long" type="text" value="{{$event->longtuide}}">
                                @if ( $errors->has('event[long]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[long]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-xs-6" hidden>
                            <div class="master_field">
                                <label class="master_label" for="shop_lat">Lat</label>
                                <input class="master_input" name="event[lat]" id="event_lat" placeholder="event_lat" type="text" value="{{$event->latitude}}">
                                @if ( $errors->has('event[lat]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[lat]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                 <label class="master_label mandatory" for="Specialties">@lang('keywords.special')</label>
                                    <select class="master_input select2" id="Specialties" multiple="multiple" style="width:100%;"  name="event[special][]">
                                    @foreach($specializations as $specialization)
                                    <?php $i=0; ?>
                                    @foreach ($event->specializations as $spec )
                                    @if($spec->id == $specialization->id)
                                    <?php $i=1; ?>
                                  <option value="{{$specialization->id}}" selected>{{$specialization->name}}</option>
                                    @endif
                                    @endforeach
                                    @if($i == 0)
                                    <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                    @endif
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
                                <select class="master_input select2" id="Category" multiple="multiple" style="width:100%;"  name="event[category][]">
                                @foreach($categories as $category)
                                <?php $i=0; ?>
                                 @foreach ($event->categories as $cat)
                                 @if($cat->id == $category->id)
                                 <?php $i=1; ?>
                                 <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                
                                @endif
                                 @endforeach
                                 @if($i == 0)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
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
                                <select class="master_input select2" id="admin_doctor" multiple="multiple" style="width:100%;"  name="event[doctor][]">
                                @foreach($doctors as $doctor)
                                <?php $i=0; ?>
                                @foreach($event->owners as $owner)
                                @if($owner->id == $doctor->id)
                                <?php $i=1; ?>
                                <option value="{{$doctor->id}}" selected>{{$doctor->username}}</option>
                                @endif
                                @endforeach
                                @if($i == 0)
                                <option value="{{$doctor->id}}">{{$doctor->username}}</option>
                                @endif
                                @endforeach
                                </select>
                                @if ( $errors->has('event[doctor][]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[doctor][]') }}</span>                 
                                @endif
                              </div>
                            </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                                <label class="master_label" for="start_date_">@lang('keywords.eventDateStart')</label>
                                <div class="">
                                <input class=" master_input" type="text" Required id="start_date_" name="event[start_date]" value="{{$event->start_datetime->format('Y-m-d')}}">
                                </div>
                                @if ( $errors->has('event[start_date_]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[start_date]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                                <label class="master_label" for="start_time"> @lang('keywords.eventTimeStart')</label>
                                <div class="bootstrap-timepicker">
                                <input class="timepicker master_input" type="text" Required id="start_time" name="event[start_time]" value="{{$event->start_datetime->format('h:i:s')}}">
                                </div>
                                @if ( $errors->has('event[start_time]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[start_time]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                                <label class="master_label" for="end_date_">@lang('keywords.eventDateEnd')</label>
                                <div class="">
                                <input class=" master_input" type="text" Required id="end_date_" name="event[end_date]" value="{{$event->end_datetime->format('Y-m-d')}}">
                                </div>
                                @if ( $errors->has('event[end_date_]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[end_date]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                                <label class="master_label" for="end_time">@lang('keywords.eventTimeEnd')</label>
                                <div class="bootstrap-timepicker">
                                <input class="timepicker master_input" type="text" Required id="end_time" name="event[end_time]" value="{{$event->end_datetime->format('h:i:s')}}">
                                </div>
                                @if ( $errors->has('event[end_time]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[end_time]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-xs-12">
                              <hr>
                            </div>
                            <div class="col-sm-12 col-xs-12 text-center">
                             <h4 class="text-center">@lang('keywords.EventImage')</h4>
                            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                                <div class="main-section">
                                <div id="fileList"></div>
                                <div class="form-group">
                                    <input class="inputfile inputfile-1" id="file-1" type="file" name="event[image]"   onchange="updateList('file-1','fileList','img')" accept=".jpg,.png,.jpeg">
                                    <label for="file-1"><span>@lang('keywords.chooseImage')</span></label>
                                </div>
                                </div>
                            </div>
                            </div>
                          </div>
                        </div><br>
                      </li>
                      <li class="tab__content_item" id="tickets-content">
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                          <div class="row">
                            <div class="col-xs-12 "style="text-align:right">
                              <label class="master_label mandatory">@lang('keywords.ticketPayment')</label>
                              <div class="col-md-12 col-sm-12 col-xs-12"></div>
                              @if($event->is_paid == 0)
                              <div class="col-md-12 col-sm-12 col-xs-12 ">
                              
                                <div class="radiorobo">
                                
                                  <input type="radio" id="free_ticket" name="event[ticket]" value="0" checked>
                                    <label for="free_ticket">@lang('keywords.free')</label>
                                </div>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12"> 
                                <div class="radiorobo">
                                  <input type="radio" id="paid_ticket" name="event[ticket]" value="1">
                                    <label for="paid_ticket">@lang('keywords.paid')</label>
                                </div>
                              </div>
                              @else
                              <div class="col-md-12 col-sm-12 col-xs-12">
                              
                                <div class="radiorobo">
                                
                                  <input type="radio" id="free_ticket" name="event[ticket]" value="0" >
                                    <label for="free_ticket">@lang('keywords.free')</label>
                                </div>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12 "> 
                                <div class="radiorobo">
                                  <input type="radio" id="paid_ticket" name="event[ticket]" value="1" checked>
                                    <label for="paid_ticket">@lang('keywords.paid')</label>
                                </div>
                              </div>
                              @endif
                            </div>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom" id="paid_section">
                          <div class="row" id="paid_section">
                            <div class="col-xs-8">
                            <div class="master_field">
                                <label class="master_label" for="Price">@lang('keywords.price')</label>
                                <input class="master_input" type="number" placeholder="50" id="Price" name="event[price]" value="(isset($event->tickets->price))?  $event->tickets->price : ''">
                                @if ( $errors->has('event[price]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[price]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-xs-4">
                            <div class="master_field">
                                <label class="master_label mandatory" for="Currency">@lang('keywords.currency')</label>
                                <select class="master_input" id="Currency" name="event[currency]" >
                                @foreach($currencies as $currency)
                                <?php $i=0; ?>
                                @if(isset($event->tickets->currency_id))
                                @if($event->tickets->currency_id == $currency->id)
                                <?php $i=1; ?>
                                <option value="{{$currency->id}}" selected>{{$currency->symbol}}</option>
                                 @endif
                                @endif
                                @if($i == 0 )
                                <option value="{{$currency->id}}">{{$currency->symbol}}</option>
                                @endif
                                
                                
                                @endforeach
                                </select>
                                @if ( $errors->has('event[currency]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[currency]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-xs-12">
                            <div class="master_field">
                                <label class="master_label" for="Available_tickets">@lang('keywords.avaliableTickets')</label>
                                <input class="master_input" type="number" maxlength="50" minlength="2" placeholder="5" id="Available_tickets" name="event[available_tickets]" value="(isset($event->tickets->available_tickets))?  $event->tickets->available_tickets : ''">
                                @if ( $errors->has('event[available_tickets]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[available_tickets]') }}</span>                 
                                @endif
                            </div>
                            </div>
                          </div>
                        </div><br>
                      </li>
                      <li class="tab__content_item" id="contactInfo-content">
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                           <div class="row">
                            <div class="col-xs-6">
                            <div class="master_field">
                                <label class="master_label" for="Website">@lang('keywords.website')</label>
                                <input class="master_input" type="url" placeholder="ex:www.domain.com" id="Website" name="event[website]" value="{{ $event->website }}">
                                @if ( $errors->has('event[website]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[website]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-xs-6">
                            <div class="master_field">
                                <label class="master_label" for="e_email"> @lang('keywords.email')</label>
                                <input class="master_input" type="email" placeholder="ss@test.com" id="e_email" name="event[email]" value="{{ $event->email }}">
                                <span class="valid-label"></span>
                                @if ( $errors->has('event[email]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[email]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-xs-6">
                            <div class="master_field">
                                <label class="master_label" for="Code_numbe">@lang('keywords.code') </label>
                              
                                <select class="master_input" id="code" name="event[code]" required>

                                  @foreach ($codes as $code)
                                      @if ( $code->tele_code != '' && $code->tele_code != null )
                                       @if($event->code == $code->id)
                                          <option value="{{ $code->id }}" selected>{{ '(' . $code->tele_code . ') ' . $code->name }}</option>
                                      @else
                                       <option value="{{ $code->id }}">{{ '(' . $code->tele_code . ') ' . $code->name }}</option>
                                      @endif
                                      @endif
                                  @endforeach

                                </select>
                                @if ( $errors->has('event[code]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[code]') }}</span>                 
                                @endif
                            </div>
                            </div>
                            <div class="col-xs-6">
                            <div class="master_field">
                                <label class="master_label" for="Mobile_number"> @lang('keywords.Phone')</label>
                                <input class="master_input" type="number" placeholder="0123456789" id="Mobile_number" name="event[mobile]" value="{{ $event->mobile }}">
                                @if ( $errors->has('event[mobile]') )                   
                                <span class="master_message color--fadegreen">{{ $errors->first('event[mobile]') }}</span>                 
                                @endif
                            </div>
                            </div>
                        </div>
                        </div><br>
                      </li>
                      <li class="tab__content_item" id="workshops-content">
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                          @foreach($event->workshops as $workshop)
                          <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="workshop_name">@lang('keywords.workshopName')</label>
                              <input class="master_input" type="text" maxlength="100" minlength="2" id="workshop_name" name="workshop[0][name]" value="{{ $workshop->name }}">
                              <span class="master_message color--fadegreen">validation message will be here</span>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="workshop_description">@lang('keywords.workshopDesc')</label>
                              <textarea class="master_input"  maxlength="250" minlength="5" id="workshop_description" name="workshop[0][description]">{{ $workshop->description }}</textarea>
                              <span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="workshop_venue">@lang('keywords.workshopPlace') </label>
                              <input class="master_input" type="text" minlength="2" id="workshop_venue" name="workshop[0][place]" value="{{ $workshop->venue }}">
                              <span class="master_message color--fadegreen">validation message will be here</span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="start_date">@lang('keywords.workshopStartDate')</label>
                              <div class="bootstrap-timepicker">
                                <input class="datepicker master_input" type="text"  id="start_date" name="workshop[0][start_date]" value="{{ $workshop->start_datetime->format('Y-m-d') }}">
                              </div><span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="end_date">@lang('keywords.workshopEndDate')</label>
                              <div class="bootstrap-timepicker">
                                <input class="datepicker master_input" type="text"  id="end_date" name="workshop[0][end_date]" value="{{ $workshop->end_datetime->format('Y-m-d') }}">
                              </div><span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="start_time">@lang('keywords.workshopStartTime')</label>
                              <div class="bootstrap-timepicker">
                                <input class="timepicker master_input" type="text"  id="start_time" name="workshop[0][start_time]" value="{{ $workshop->start_datetime->format('h:i:s') }}">
                              </div><span class="master_message inherit">message content</span>
                            </div>
                          </div>
                         

                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="end_time">@lang('keywords.workshopEndTime')</label>
                              <div class="bootstrap-timepicker">
                                <input class="timepicker master_input" type="text"  id="end_time" name="workshop[0][end_time]" value="{{ $workshop->end_datetime->format('h:i:s') }}">
                              </div><span class="master_message inherit">message content</span>
                            </div>
                          </div>
                        </div>

                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="Specialties">@lang('keywords.special')</label>
                              <select class="master_input select2" id="Specialties" multiple="multiple" style="width:100%;"  name="workshop[0][special][]">
                                @foreach($specializations as $specialization)
                                <?php $i=0; ?>
                                @foreach($workshop->specializations as $spec)
                                @if($spec->id == $specialization->id )
                                <?php $i=1; ?>
                                <option value="{{$specialization->id}}" selected>{{$specialization->name}}</option>
                                @endif
                                @endforeach
                                @if($i == 0)
                                <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                @endif
                                @endforeach
                              </select><span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="master_field">
                              <label class="master_label mandatory" for="admin_workshop_doctor"> @lang('keywords.eventDoctor') </label>
                              <select class="master_input select2" id="admin_workshop_doctor" multiple="multiple" style="width:100%;" name="workshop[0][doctor][]">
                                @foreach($doctors as $doctor)
                                <?php $i=0; ?>
                                @foreach($workshop->owners as $owner)
                                @if($owner->id == $doctor->id )
                                <?php $i=1; ?>
                                <option value="{{$doctor->id}}" selected>{{$doctor->username}}</option>
                                @endif
                                @endforeach
                                @if($i == 0)
                                <option value="{{$doctor->id}}">{{$doctor->username}}</option>
                                @endif
                                @endforeach
                              </select><span class="master_message inherit">message content</span>
                            </div>
                          </div>
                         

                         
                        @endforeach
                        <div id="more_workshop"></div>
                        <div class="col-sm-12 col-xs-12">
                          <button class="btn-block master-btn bgcolor--gray_mm" id="add_more_btn" type="button"><i class="fa fa-plus color--main"></i>
                          <span class="color--main">Add more</span></button>
                        </div>
                        </div><br>
                      </li>
                      <li class="tab__content_item" id="surveys-content">
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                          <?php $survey_number=1; ?>
                          @foreach($event->surveys as $survey)
                          <?php $question_number=1;?>
                          <p style="text-align: center;background-color: #004272;color: azure;"> 
                          @lang('keywords.surveyN') {{ $survey_number++ }}</p>
                          <div class="row">
                          <div class="col-xs-6">
                            <div class="master_field">
                              <label class="master_label" for="survey_name">@lang('keywords.Name')</label>
                              <input class="master_input" type="text" id="survey_name" name="survey[{{ $survey_number-1 }}][name]" value="{{ $survey->name }}">
                              <span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <div class="master_field">
                              <label class="master_label mandatory" for="appears_for">@lang('keywords.surveyFor')</label>
                              <select class="master_input select2" id="appears_for" multiple="multiple" style="width:100%;"  name="survey[{{ $survey_number-1 }}][appears_for]">
                                <option value="1">All attend</option>
                               
                              </select><span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          @foreach($survey->questions as $question)
                          <div class="col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="survey_question" style="background-color: beige;">@lang('keywords.Squestion'){{ $question_number++ }}</label>
                              <input class="master_input" type="text" maxlength="100" minlength="10" id="survey_question" name="survey[{{ $survey_number-1 }}][question][{{ $question_number-1 }}][name]"  value="{{ $question->name }}">
                              <span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="survey_answer1">@lang('keywords.answer')1</label>
                              <input class="master_input" type="text" maxlength="100" id="survey_answer1" name="survey[{{ $survey_number-1 }}][question][{{ $question_number-1 }}][answer][0]"  value="{{ $question->answers[0]->name }}">
                              <span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="survey_answer2">@lang('keywords.answer')2</label>
                              <input class="master_input" type="text" maxlength="100" id="survey_answer2" name="survey[{{ $survey_number-1 }}][question][{{ $question_number-1 }}][answer][1]"  value="{{ $question->answers[1]->name }}">
                              <span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="survey_answer3">@lang('keywords.answer')3</label>
                              <input class="master_input" type="text" maxlength="100" id="survey_answer3" name="survey[{{ $survey_number-1 }}][question][{{ $question_number-1 }}][answer][2]" value="{{(isset($question->answers[2]))? $question->answers[2]->name:''  }} ">
                              <span class="master_message inherit ">message content</span>
                            </div>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="master_field">
                              <label class="master_label" for="survey_answer4">@lang('keywords.answer')4</label>
                              <input class="master_input" type="text" maxlength="100" id="survey_answer4" name="survey[{{ $survey_number-1 }}][question][{{ $question_number-1 }}][answer][3]" value="{{(isset($question->answers[3]))? $question->answers[3]->name:''  }} ">
                              <span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          
                          @endforeach
                        </div>
                        <div>
                        
                          </div>

                        
                        
                        <div id="more_question_{{ $survey_number -1}}"></div>
                           <div style="text-align:end">
                            <button onclick="add_question({{ $survey_number-1 }},{{ $question_number }})" class="btn btn-default" id="add_more_question" type="button">
                              <i class="fa fa-plus color--main"></i>
                          <span style="color:#004272;">اضافة سؤال</span></button>

                          <div class="checkboxrobo pull-right">
                              <input type="checkbox" id="activation" name="event[active]" checked="true">
                              <label for="activation">@lang('keywords.Active')</label>
                            </div>
                        </div><br>
                        @endforeach
                        <div id="more_Survey"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 no_padding">
                          <button class="btn-block master-btn" style="background-color:#004272;" id="add_more_survey" type="button"><i class="fa fa-plus color--main"></i><span style="color:white;">اضافة دراسة </span></button>
                        </div>
                        </div><br>
                      </li>
                      <li class="tab__content_item" id="media-content">
                        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                           <div class="row">
                          <div class="col-xs-12">
                            <label class="master_label" for="YouTube_video_link">@lang('keywords.addYoutube')</label>
                          </div>
                          <div class="col-xs-6">
                            <div class="master_field">
                              <label class="master_label" for="YouTube_video_link_1">@lang('keywords.link') 1 </label>
                              <input class="master_input" type="url" placeholder="ex:www.youtube.com/video_iD" id="YouTube_video_link_1" name="event[youtube][0]" >
                              <span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-xs-6">
                            <div class="master_field">
                              <label class="master_label" for="YouTube_video_link_2">@lang('keywords.link') 2</label>
                              <input class="master_input" type="url" placeholder="ex:www.youtube.com/video_iD" id="YouTube_video_link_2" name="event[youtube][1]"><span class="master_message inherit">message content</span>
                            </div>
                          </div>
                          <div class="col-xs-12">
                            <hr>
                          </div>
                          <div class="col-sm-12 col-xs-12 text-center">
                            <h4 class="text-center">@lang('keywords.uploadEventImage')</h4>
                            <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                              <div class="main-section">
                                <div id="fileList2"></div>
                                <div class="form-group">
                                  <input class="inputfile inputfile-1" id="file-2" type="file" name="event[images][]" data-multiple-caption="{count} files selected" multiple="" onchange= 'updateList("file-2","fileList2","imgs")' accept=".jpg,.png,.jpeg">
                                  <label for="file-2"><span>@lang('keywords.chooseImage')</span></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                          <div class="col-xs-12" style="text-align:end;">
                            <div class="checkboxrobo">
                              <input type="checkbox" id="activation" name="event[active]" checked="true" accept=".jpg,.png,.jpeg">
                              <label for="activation">@lang('keywords.Active')</label>
                            </div>
                          </div>
                        </div>
                        </div>
                      </li>
                      <div class="div" style="text-align:end;">
                        <button class="master-btn   undefined bgcolor--main  bshadow--0" type="submit"><i class="fa fa-save"></i><span>@lang('keywords.save')</span>
                        </button>
                       <a href="{{ route('events') }}"> <button class="master-btn   undefined bgcolor--fadebrown  bshadow--0" type="button"><i class="fa fa-close"></i><span>@lang('keywords.cancel')</span>
                        </button></a>
                      </div>
                      
                    </ul>
                    </form>
                  </div>
                </div>
                <div class="clearfix"></div>
              
</div>
@endsection
@section('js')


    <script type="text/javascript">
      var eventImgList = [];
      var eventImg=[];
      var check = false;
      var img;
      var reader=new FileReader();

    function closebtn(index,value){
        if(value==1){
          eventImgList.splice(index,1);
          $.each(eventImgList,function(id,value,){
            value.index = id;
          });
          check = true;
          $("#file-2").prop('disabled', false);
          updateList('file-2','fileList2',"imgs");
        }
        if(value==2){
          console.log("value 2")
          console.log("index = "+ index)
          eventImg.splice(index,1);
          $.each(eventImg,function(id,value){
            value.index = id;
          });
          console.log(eventImg);

          check = true;
          $("#file-1").prop('disabled', false);
          updateList('file-1','fileList',"img");
        }
      
      }
    function updateList (inputID,outputID,listName) {
          console.log("upadteList")
          let input = document.getElementById(inputID);
          let output = document.getElementById(outputID);
          let files1 = input.files;

        if(listName =='imgs'){
          console.log("da5el el if")
              if (check == true) {
              output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
              for (var i = 0; i < eventImgList.length; i++) {
                  output.innerHTML += `<li  class="${eventImgList[i].class} js-uploader__file-list uploader__file-list">
                                  <span class="uploader__file-list__thumbnail">
                                  <img class="thumbnail" id="img_" src="${eventImgList[i].image}">
                                  </span><span class="uploader__file-list__text hidden-xs">${eventImgList[i].name}</span>
                                  <span class="uploader__file-list__size hidden-xs">${(eventImgList[i].size) / 1000} KB</span>
                                  <span class="uploader__file-list__button"></span>
                                  <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(${eventImgList[i].index},1)" class="uploader__icon-button fa fa-times" >
                                  </a></span></li>`;
              }
              output.innerHTML += '</ul>';
              check = false;
          }
          else {
              if (files1.length > 5) {
                  alert("max no. 5 images");
                  return;
              }

              if (window.File && window.FileList && window.FileReader) {
                      if (files1.length == 5) {
                  $(`#${inputID}`).prop('disabled', true);
              }
                  for (var i = 0; i < files1.length; i++) {
                      var file = files1[i];
                      var imgReaderImgs = new FileReader();
                      imgReaderImgs.addEventListener("load", function (event) {
                          var imgFile_ = event.target;
                        
                            eventImgList.push({
                                'name': file.name,
                                'size': file.size,
                                'index': eventImgList.length,
                                'image': imgFile_.result,
                            });

                          output.innerHTML = '<ul  class="js-uploader__file-list uploader__file-list" >';
                          for (var i = 0; i < eventImgList.length; i++) {
                              output.innerHTML += `<li class="${eventImgList[i].class} js-uploader__file-list uploader__file-list">
                                  <span class="uploader__file-list__thumbnail">
                                  <img class="thumbnail" id="img_" src="${eventImgList[i].image}">
                                  </span><span class="uploader__file-list__text hidden-xs">${eventImgList[i].name}</span>
                                  <span class="uploader__file-list__size hidden-xs">${(eventImgList[i].size) / 1000} KB</span>
                                  <span class="uploader__file-list__button"></span>
                                  <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(${eventImgList[i].index},1)" class="uploader__icon-button fa fa-times" >
                                  </a></span></li>`;
                          }
                          output.innerHTML += '</ul>';
                      });
                      //Read the image
                      imgReaderImgs.readAsDataURL(file);
                  }
              }
                $(`#${inputID}`).val('');
              if (eventImgList.length == 4) {
                  $(`#${inputID}`).prop('disabled', true);
              }
          }
        }

        if(listName =='img'){
          
          if (check == true) {
              output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
              for (var i = 0; i < eventImg.length; i++) {
                  output.innerHTML += `<li  class="${eventImg[i].class} js-uploader__file-list uploader__file-list">
                                  <span class="uploader__file-list__thumbnail">
                                  <img class="thumbnail" id="img_" src="${eventImg[i].image}">
                                  </span><span class="uploader__file-list__text hidden-xs">${eventImg[i].name}</span>
                                  <span class="uploader__file-list__size hidden-xs">${(eventImg[i].size) / 1000} KB</span>
                                  <span class="uploader__file-list__button"></span>
                                  <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(0,2)" class="uploader__icon-button fa fa-times" >
                                  </a></span></li>`;
              }
              output.innerHTML += '</ul>';
              check = false;
          }
          else {
              

              if (window.File && window.FileList && window.FileReader) {
                      if (files1.length == 1) {
                  $(`#${inputID}`).prop('disabled', true);
              }
                  for (var i = 0; i < files1.length; i++) {
                      var file = files1[i];
                      var imgReaderImgs = new FileReader();
                      imgReaderImgs.addEventListener("load", function (event) {
                          var imgFile_ = event.target;
                        
                          eventImg.push({
                                'name': file.name,
                                'size': file.size,
                                'index': eventImgList.length,
                                'image': imgFile_.result,
                            });
                            console.log(eventImg)

                          output.innerHTML = '<ul  class="js-uploader__file-list uploader__file-list" >';
                          for (var i = 0; i < eventImgList.length; i++) {
                              output.innerHTML += `<li  js-uploader__file-list uploader__file-list">
                                  <span class="uploader__file-list__thumbnail">
                                  <img class="thumbnail" id="img_" src="${eventImg[i].image}">
                                  </span><span class="uploader__file-list__text hidden-xs">${eventImg[i].name}</span>
                                  <span class="uploader__file-list__size hidden-xs">${(eventImg[i].size) / 1000} KB</span>
                                  <span class="uploader__file-list__button"></span>
                                  <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(0,2)" class="uploader__icon-button fa fa-times" >
                                  </a></span></li>`;
                          }
                          output.innerHTML += '</ul>';
                      });
                      //Read the image
                      imgReaderImgs.readAsDataURL(file);
                  }
              }
                $(`#${inputID}`).val('');
              if (eventImg.length == 1) {
                  $(`#${inputID}`).prop('disabled', true);
              }
          }
        }

        }
    

    function get_images(){
      eventImgList.push({
                                'name': 'test1',
                                'size': '25',
                                'image': '../../../img/avaters/male.jpg',
                                'id':'55'
      },
      {
                                'name': 'test1',
                                'size': '25',
                                'image': '../../../img/avaters/female.jpg',
                                'id':'25',
      }
      )
      eventImg.push({
                                'name': 'test1',
                                'size': '25',
                                'image': '../../../img/avaters/male.jpg',
                                'id':'55'
      },
      
      )
      add_index(eventImgList);
      add_index(eventImg);
    }

     //add index 
     function add_index(list){
        $.each(list,function(id,value){
          value.index = id;
        })
        
        show_image(eventImgList,"fileList2","imgs");
    }

     //draw images
     function show_image(list,output_section,ref){
      let value;
      switch(ref){
          case 'imgs':
                value=1;
                break;
          case 'img':
                value=2;
                break;
        
      }
                  let output = document.getElementById(output_section);
                   output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                            for (var i = 0; i < list.length; i++) {
                                output.innerHTML += `<li class="js-uploader__file-list uploader__file-list">
                                    <span class="uploader__file-list__thumbnail">
                                    <img class="thumbnail" id="img_" src="${list[i].image}">
                                    </span><span class="uploader__file-list__text hidden-xs">${list[i].name}</span>
                                    <span class="uploader__file-list__size hidden-xs">${(list[i].size) / 1000} KB</span>
                                    <span class="uploader__file-list__button"></span>
                                    <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(${list[i].index},${value})" class="uploader__icon-button fa fa-times" >
                                    </a></span></li>`;
                            }
                            output.innerHTML += '</ul>';
    }

    </script>
    <script type="text/javascript">
        $(function(){
          get_images();
          show_image(eventImg,'fileList','img')
        })
    </script>
    <script type="text/javascript">
     dateRange_2('start_date_','end_date_')
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
                                <input class="master_input" type="text" maxlength="100" minlength="2" placeholder="name" id="workshop_name" name="workshop[${next_count}][name]"><span class="master_message color--fadegreen">validation message will be here</span>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop_description">@lang('keywords.workshopDesc') </label>
                                <textarea class="master_input"  maxlength="250" minlength="5" id="workshop_description" placeholder="Description" name="workshop[${next_count}][description]"></textarea><span class="master_message inherit">message content</span>
                              </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop_venue">@lang('keywords.workshopPlace')</label>
                                <input class="master_input" type="text" minlength="2" placeholder="ex:CFC" id="workshop_venue"  name="workshop[${next_count}][place]"><span class="master_message color--fadegreen">validation message will be here</span>
                              </div>
                            </div>

                            
                          <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop${next_count}_start_date">@lang('keywords.workshopStartDate')</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="start date"  id="workshop${next_count}_start_date" name="workshop[${next_count}][start_date]">
                                </div><span class="master_message inherit">message content</span>
                              </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="workshop${next_count}_end_date">@lang('keywords.workshopEndDate')</label>
                                <div class="bootstrap-timepicker">
                                  <input class="datepicker master_input" type="text" placeholder="end date"  id="workshop${next_count}_end_date" name="workshop[${next_count}][end_date]">
                                </div><span class="master_message inherit">message content</span>
                              </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="start_time">@lang('keywords.workshopStartTime')</label>
                                <div class="bootstrap-timepicker">
                                  <input class="timepicker master_input" type="text" placeholder="start time"  id="start_time" name="workshop[${next_count}][start_time]">
                                </div><span class="master_message inherit">message content</span>
                              </div>
                            </div>
                           

                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <div class="master_field">
                                <label class="master_label" for="end_time">@lang('keywords.workshopEndTime')</label>
                                <div class="bootstrap-timepicker">
                                  <input class="timepicker master_input" type="text" placeholder="end time"  id="end_time" name="workshop[${next_count}][end_time]">
                                </div><span class="master_message inherit">message content</span>
                              </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="Specialties">@lang('keywords.special')</label>
                                <select class="master_input select2" id="Specialties" multiple="multiple" data-placeholder="placeholder" style="width:100%;"  name="workshop[${next_count}][special][]">
                                   @foreach($specializations as $specialization)
                                <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                @endforeach
                                </select><span class="master_message inherit">message content</span>
                              </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="master_field">
                                <label class="master_label mandatory" for="admin_workshop_doctor">@lang('keywords.eventDoctor')  </label>
                                <select class="master_input select2" id="admin_workshop_doctor" multiple="multiple" data-placeholder="placeholder" style="width:100%;" name="workshop[${next_count}][doctor][]">
                                  @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->username}}</option>
                                @endforeach
                                </select><span class="master_message inherit">message content</span>
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
        var question = $("#"+question_id+" > div").length+question;
       
          $(`#more_question_${value}`).append(`
                           <div class="row">
                          
                             <div class="col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_question" style="background-color: beige;">@lang('keywords.Squestion') ${question}</label>
                                 <input class="master_input" type="text" placeholder="question" maxlength="100" minlength="10" id="survey_question" name="survey[${value}][question][${question}][name]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer1"> @lang('keywords.answer') 1</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer1" required name="survey[${value}][question][${question}][answer][0]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer2">  @lang('keywords.answer') 2</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer2" required name="survey[${value}][question][${question}][answer][1]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer3">  @lang('keywords.answer') 3</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer3" name="survey[${value}][question][${question}][answer][2]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer4">  @lang('keywords.answer') 4</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer4" name="survey[${value}][question][${question}][answer][3]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             </div>
          `)
        }
      $(document).ready(function(){
       var current_count_question = 0;
       var next_count_question = 0;
       var current_count_survey = {{ $survey_number }};
       var next_count_survey = 0;
       $("#add_more_question").on('click',function(){
         
         next_count_question = current_count_question;
         current_count_question+=1;
         $("#more_Question").append(
                          `
                           <div class="row">
                             <div class="col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_question" style="background-color: beige;"> @lang('keywords.question') ${next_count_question}</label>
                                 <input class="master_input" type="text" placeholder="question" maxlength="100" minlength="10" id="survey_question" name="survey[0][question][${next_count_question}][name]" required><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer1">  @lang('keywords.answer') 1</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer1" required name="survey[0][question][${next_count_question}][answer][0]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer2">  @lang('keywords.answer') 2</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer2" required  name="survey[0][question][${next_count_question}][answer][1]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer3">  @lang('keywords.answer') 3</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer3" name="survey[0][question][${next_count_question}][answer][2]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer4">  @lang('keywords.answer') 4</label>
                                 <input class="master_input" type="text" placeholder="answer" maxlength="100" id="survey_answer4" name="survey[0][question][${next_count_question}][answer][3]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             </div>
                             `
         );
       });
       $("#add_more_survey").on('click',function(){
          
         next_count_survey = current_count_survey;
       next_count_question = 1;
       current_count_survey +=1;
       
            $("#more_Survey").append(` 
                         
                         <div><p style="text-align: center;background-color: #004272;color: azure;">  @lang('keywords.surveyN') ${next_count_survey}</p></div>
                           <div class="row">
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label" for="survey_name"> @lang('keywords.Name')</label>
                                 <input class="master_input" type="text"  id="survey_name" name="survey[${next_count_survey}][name]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-xs-6">
                               <div class="master_field">
                                 <label class="master_label mandatory" for="appear_for"> @lang('keywords.surveyFor')</label>
                                 <select class="master_input select2" id="appears_for" multiple="multiple" data-placeholder="placeholder" style="width:100%;"  name="survey[${next_count_survey}][appears_for]">
                                   <option value="1">All attend</option>
                                  
                                 </select><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_question">1  @lang('keywords.Squestion')</label>
                                 <input class="master_input" type="text"  maxlength="100" minlength="10" id="survey_question" name="survey[${next_count_survey}][question][0][name]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer1">  @lang('keywords.answer') 1 </label>
                                 <input class="master_input" type="text"  maxlength="100" id="survey_answer1" name="survey[${next_count_survey}][question][0][answer][0]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer2">  @lang('keywords.answer') 2</label>
                                 <input class="master_input" type="text"  maxlength="100" id="survey_answer2" name="survey[${next_count_survey}][question][0][answer][1]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer3">  @lang('keywords.answer') 3</label>
                                 <input class="master_input" type="text"  maxlength="100" id="survey_answer3" name="survey[${next_count_survey}][question][0][answer][2]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                             <div class="col-md-3 col-sm-3 col-xs-12">
                               <div class="master_field">
                                 <label class="master_label" for="survey_answer4">  @lang('keywords.answer') 4</label>
                                 <input class="master_input" type="text" maxlength="100" id="survey_answer4" name="survey[${next_count_survey}][question][0][answer][3]"><span class="master_message inherit">message content</span>
                               </div>
                             </div>
                           </div>
                            <div id="more_question_${next_count_survey}"></div>
                           <div style="text-align:end">
                            <button onclick="add_question(${next_count_survey},${++next_count_question})" class="btn btn-default" id="add_more_question" type="button">
                            <i class="fa fa-plus color--main"></i><span style="color:#004272;">اضافة سؤال</span></button>
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
<script type="text/javascript">
  $( document ).ready(function() {
      @if($event->use_ticketing_system == 1)
      $("#paid_section").show();
      @else
    $("#paid_section").hide();
    @endif
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
@endsection