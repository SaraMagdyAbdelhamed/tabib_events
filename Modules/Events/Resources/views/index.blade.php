@extends('layouts.app')
@section('content')

<!-- =============== Custom Content ===========-==========-->
<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url({{ asset('/img/covers/dummy2.jpg ')  }}  )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">         
            <div class="text-wraper">
              <h3 class="cover-inside-title  ">@lang('keywords.events')</h3>
            </div>
          </div>
        </div>
        
        @if (!Helper::hasRule(['Admin Doctor']))
          <div class="cover--actions">
            <a class="bradius--no border-btn master-btn" type="button" href="{{ route('events.create') }}">@lang('keywords.addNewBackend')</a>
          </div>
        @endif

      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
      <div class="full-table">
        <div class="filter__btns"><a class="filter-btn master-btn" href="#filter-users"><i class="fa fa-filter"></i>filters</a></div>
        
        {{-- delete selected --}}
        <div class="bottomActions__btns">
          <a class="master-btn btn-warning-cancel-all" href="#" onclick="delete_many('#dataTableTriggerId_001', '{{ route('events.destroy.all') }}')">@lang('keywords.deleteSelected')</a>
        </div>

        <div class="remodal" data-remodal-id="filter-users" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
          <form role="form"  method="post" action="{{route('events_filter')}}" accept-charset="utf-8">
            {{csrf_field()}}
            <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
            <div>
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="filter_cat">@lang('keywords.events categories')</label>
                    <select name="categories[]" class="master_input select2" id="filter_cat" multiple="multiple" style="width:100%;" ,>
                      <option disabled>Select Category</option>
                      @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label">@lang('keywords.EventStatus')</label>
                    <div class="radiorobo">
                      <input type="radio" value="1" id="event_status_2" name="activation">
                      <label for="event_status_2">@lang('keywords.active')</label>
                    </div>
                    <div class="radiorobo">
                      <input type="radio" value="0" id="event_status_3" name="activation">
                      <label for="event_status_3">@lang('keywords.not active')</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_start_from">@lang('keywords.eventDateStart')</label>
                    <div class="bootstrap-timepicker">
                      <input name="start_from" class="datepicker master_input" type="text" id="bootstrap_date_start_from">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_start_to">@lang('keywords.eventDateEnd')</label>
                    <div class="bootstrap-timepicker">
                      <input name="start_to" class="datepicker master_input" type="text" id="bootstrap_date_start_to">
                    </div>
                  </div>
                </div>
                <!-- <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_End_from">@lang('keywords.endDateFrom')</label>
                    <div class="bootstrap-timepicker">
                      <input name="end_from" class="datepicker master_input" type="text" id="bootstrap_date_End_from">
                    </div>
                  </div>
                </div> -->
                <!-- <div class="col-sm-6 col-xs-12">
                  <div class="master_field">
                    <label class="master_label" for="bootstrap_date_End_to">@lang('keywords.endDateTo')</label>
                    <div class="bootstrap-timepicker">
                      <input name="end_to" class="datepicker master_input" type="text" id="bootstrap_date_End_to">
                    </div>
                  </div>
                </div> -->
              </div>
            </div><br>
            <button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
            <button class="remodal-confirm" type="submit">@lang('keywords.ApplyFilter')</button>
          </div>
        </form>
        <form id="dataTableTriggerId_001_form">
          <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
            <thead>
              <tr class="bgcolor--gray_mm color--gray_d">
                <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                <th><span class="cellcontent">@lang('keywords.eventName')</span></th>
                <th><span class="cellcontent">@lang('keywords.address')</span></th>
                <th><span class="cellcontent">@lang('keywords.eventCat')</span></th>
                <th><span class="cellcontent">@lang('keywords.eventDateStart')</span></th>
                <th><span class="cellcontent">@lang('keywords.eventDateEnd')</span></th>
                <th><span class="cellcontent">@lang('keywords.RegisterationDate')</span></th>
                <th><span class="cellcontent">@lang('keywords.addby')</span></th>
                <th><span class="cellcontent">@lang('keywords.status')</span></th>
                <th><span class="cellcontent">@lang('keywords.actions')</span></th>
              </tr>
            </thead>
            <tbody>
              @if ( isset($events) && !empty($events) )
              @foreach ($events as $event)
              <tr data-id="{{ $event->id }}">
                <td><span class="cellcontent"></span></td>
                <td><span class="cellcontent">{{ $loop->index + 1 }}</span></td>
                <td><span class="cellcontent">{{ $event->name    ? : __('keywords.not') }}</span></td>
                <td><span class="cellcontent">{{ $event->address ? : __('keywords.not') }}</span></td>
                <td>
                  <span class="cellcontent">
                    @foreach ($event->categories as $cat)
                    {{ $cat->name }} {{ count($event->categories) != $loop->index+1 ? ' - ' : '.' }}
                    @endforeach
                  </span>
                </td>
                <td><span class="cellcontent">{{ $event->start_datetime ? $event->start_datetime->format('Y/m/d H:i A') : __('keywords.not') }}</span></td>
                <td><span class="cellcontent">{{ $event->end_datetime   ? $event->end_datetime->format('Y/m/d H:i A')   : __('keywords.not') }}</span></td>
                <td><span class="cellcontent">{{ $event->created_at     ? $event->created_at->format('Y/m/d H:i A')     : __('keywords.not') }}</span></td>
                <td><span class="cellcontent">{{ $event->created_by     ? $event->createdBy->first_name ." ". $event->createdBy->last_name : __('keywords.not') }}</span></td>
                <td>
                  <span class="cellcontent">
                    <i class="fa {{ $event->is_active ? 'icon-in-table-true fa-check' : 'icon-in-table-false fa-times' }}"></i>
                  </span>
                </td>
                <td>
                  <span class="cellcontent">
                    
                    {{-- View Event --}}
                    <a href="{{ route('events.show', $event->id) }}" class= "action-btn bgcolor--main color--white ">
                      <i class = "fa  fa-eye"></i>
                    </a>
                    
                    {{-- Edit Event --}}
                    <a href="{{ route('events.edit', $event->id) }}"  class= "action-btn bgcolor--fadegreen color--white ">
                      <i class = "fa  fa-pencil"></i>
                    </a>
                    
                    {{-- Delete Event --}}
                    <a href="#" onclick="delete_single('{{$event->id }}', '{{ route('events.destroy') }}')"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white deleteRecord">
                      <i class = "fa  fa-trash-o"></i>
                    </a>
                    
                  </span>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </form>
        
      </div>
    </div>
  </div><br>
</div>
@section('js')

<script>
    $(document).ready(function() {

      $('#sub_8_5').addClass('pure-active');

    });
</script>
<script type="text/javascript">
  $(function(){
    dateRange_3('bootstrap_date_start_from','bootstrap_date_start_to')
    // dateRange_3('bootstrap_date_End_from','bootstrap_date_End_to')

  })
</script>
@endsection            
@endsection