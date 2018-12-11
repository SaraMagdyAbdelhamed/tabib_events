@extends('layouts.app')
@section('content')

              <!-- =============== Custom Content ===========-==========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image: url({{ asset('/img/covers/dummy2.jpg ')  }}  )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="add-mode">Adding mode</div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">@lang('keywords.offers_and_deals')</h3>
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
                    <form id="offers_add" action="{{ route('offers_and_deals.create') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="offer_image"> @lang('keywords.offerImage') </label>
                            <div class="file-upload">
                              <div class="file-select">
                                <div class="file-select-name" id="noFile">اضغط لأضافة الصورة</div>
                                <input class="chooseFile" type="file" name="offer_image" id="offer_image" required accept=".jpg,.png,.jpeg">
                              </div>
                            </div><span id="error1" class="master_message color--fadegreen">max 1MB</span>

                          </div>

                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="offer_title"> @lang('keywords.title')</label>
                            <input class="master_input" type="text" maxlength="100" id="offer_title" name="offer_title" required>

                            {{-- Validation message --}}
                            @if ( $errors->has('offer_title') )
                                <span class="master_message inherit">{{ $errors->first('offer_title') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="offer_description">@lang('keywords.offerDescription')</label>
                            <textarea class="master_input" name="offer_description" maxlength="255" id="offer_description" required></textarea>
                            {{-- Validation message --}}
                            @if ( $errors->has('offer_description') )
                            <span class="master_message inherit">{{ $errors->first('offer_description') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="offer_category">@lang('keywords.offerCategory')</label>
                            <select class="master_input select2" id="offer_category" multiple="multiple" style="width:100%;" , name="offer_category[]" required>
                              @foreach ($categories as $category)
                                 <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach


                            </select>
                            {{-- Validation message --}}
                            @if ( $errors->has('offer_category') )
                            <span class="master_message inherit">{{ $errors->first('offer_category') }}</span>
                            @endif
                          </div>
                        </div>
                         <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label mandatory" for="offer_sponsor">@lang('keywords.offerSponsor')</label>
                            @if($isSponsor)
                            <select class="master_input select2" id="offer_sponsor"  style="width:100%;"  name="offer_sponsor" required disabled>
                            @else
                           <select class="master_input select2" id="offer_sponsor"  style="width:100%;"  name="offer_sponsor" required >

                            @endif
                              <option value="-1" selected disabled hidden>Select Sponsor</option>
                              @foreach ($sponsors as $sponsor)
                                 <option value="{{$sponsor->id}}">{{$sponsor->username}}</option>
                              @endforeach


                            </select>
                            {{-- Validation message --}}
                            @if ( $errors->has('offer_sponsor') )
                            <span class="master_message inherit">{{ $errors->first('offer_sponsor') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="start_date_">@lang('keywords.startDate')</label>
                            <div class="bootstrap-timepicker">
                              <input class="datepicker master_input" type="text"  id="start_date_" name="start_date_" required value="{{ \Carbon\Carbon::today()->format('d-m-Y') }}">
                            </div>
                            {{-- Validation message --}}
                             @if ( $errors->has('start_date_') )
                             <span class="master_message inherit">{{ $errors->first('start_date_') }}</span>
                              @endif
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="master_field">
                            <label class="master_label" for="end_date_"> @lang('keywords.endDate')</label>
                            <div class="bootstrap-timepicker">
                              <input class="datepicker master_input" type="text" required id="end_date_" name="end_date_" value="{{ \Carbon\Carbon::tomorrow()->format('d-m-Y') }}">
                            </div>
                            {{-- Validation message --}}
                            @if ( $errors->has('end_date_') )
                            <span class="master_message inherit">{{ $errors->first('end_date_') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-xs-12" style="text-align:end;">
                          <div class="checkboxrobo">
                            <input type="checkbox" id="activation" name="activation">
                            <label for="activation">@lang('keywords.active')</label>
                          </div>
                        </div>
                      </div>

                    <div class="div" style="text-align:end;">
                      <button id="submit" class="master-btn   undefined bgcolor--main  bshadow--0" type="submit" disabled="false"><i class="fa fa-save" ></i><span>@lang('keywords.save')</span>
                      </button>
                      <a class="master-btn   undefined bgcolor--fadebrown  bshadow--0" href="{{route('offers_and_deals')}}"><i class="fa fa-close"></i><span>@lang('keywords.cancel')</span>
                      </a>
                    </div>
                     </form>
                  </div>
                </div><br>
              </div>
 <script>
 //binds to onchange event of your input field
$('#offer_image').bind('change', function() {
if ($('#submit').prop('disabled',false)){
	$('#submit').prop('disabled',true);
	}
 var ext = $('#offer_image').val().split('.').pop().toLowerCase();
if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
{
	$('#error1').text("Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.");
	a=0;
	}
  else{
	var picsize = (this.files[0].size);
	if (picsize > 1000000){
	$('#error1').text("Error Maximum File Size Limit is 1MB.");
	a=0;
	}else{
	a=1;
	$('#error1').text("Max 1MB");
	}
	if (a==1){
		$('#submit').prop('disabled',false);
		}
}
});
 </script>
 <script type="text/javascript">
 $(function(){
   $('.datepicker').datepicker({
        autoclose: true,
        format:'dd-mm-yyyy',
      });

  dateRange('start_date_','end_date_',
    "{{ \Carbon\Carbon::now()->format('Y') }}",
    "{{ \Carbon\Carbon::now()->format('m') }}",
    "{{ \Carbon\Carbon::now()->format('d') }}",
    "{{ \Carbon\Carbon::now()->addYears(1)->format('Y') }}",
    "{{ \Carbon\Carbon::now()->addYears(1)->format('m') }}",
    "{{ \Carbon\Carbon::now()->addYears(1)->format('d') }}",
    '{{ \Carbon\Carbon::now()->addYears(1)->format("d/m/Y") }}'  // end date
    )

 })
 </script>
@endsection