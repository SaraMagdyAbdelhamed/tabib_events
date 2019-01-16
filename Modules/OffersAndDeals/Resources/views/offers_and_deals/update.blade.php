@extends('layouts.app')
@section('content')

<!-- =============== Custom Content ===========-==========-->
<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image: url({{ asset('/img/covers/dummy2.jpg ')  }}  )   ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
      <div class="edit-mode">Editing mode</div>
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h3 class="cover-inside-title  "> @lang('keywords.offers_and_deals')</h3>
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
      <form id="offers_edit" action="{{ route('offers_and_deals.update',$offer->id) }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="master_field ">
              <label class="master_label mandatory" for="offer_title"> @lang('keywords.title')</label>
              <input class="master_input" type="text" maxlength="100" id="offer_title" name="offer_title" value="{{$offer->name}}" required>

              {{-- Validation message --}}
              @if ( $errors->has('offer_title') )
                  <span class="master_message inherit">{{ $errors->first('offer_title') }}</span>
              @endif

            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="offer_description">@lang('keywords.offerDescription')</label>
              <textarea class="master_input" name="offer_description" maxlength="255" id="offer_description" required >{{$offer->description}}</textarea>

              {{-- Validation message --}}
              @if ( $errors->has('offer_description') )
                  <span class="master_message inherit">{{ $errors->first('offer_description') }}</span>
              @endif

            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="offer_category">@lang('keywords.offerCategory')</label>
              <select class="master_input select2" id="offer_category" multiple="multiple" style="width:100%;" , name="offer_category[]" required>
                @foreach ($categories as $category)
                <?php $cat=0; ?>
                  @foreach ($offer->categories as $off_cat)

                  @if($off_cat->id == $category->id)
                  <?php $cat=1; ?>
                      <option value="{{$category->id}}" selected>{{$category->name}}</option>

                      @endif


                  @endforeach
                  @if($cat == 0)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif

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
                @if($offer->sponsor_id == $sponsor->id)
                    <option value="{{$sponsor->id}}" selected>{{$sponsor->username}}</option>
                @else
                <option value="{{$sponsor->id}}">{{$sponsor->username}}</option>
                @endif
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
              <label class="master_label mandatory" for="start_date_"> @lang('keywords.startDate')</label>
              <div class="">
                <input class=" master_input" type="text" Required id="start_date_" name="start_date_" value="{{ $offer->start_datetime->format('d/m/Y') }}" required>
              </div>

              {{-- Validation message --}}
              @if ( $errors->has('start_date_') )
                  <span class="master_message inherit">{{ $errors->first('start_date_') }}</span>
              @endif


            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="end_date_"> @lang('keywords.endDate')</label>
              <div class="">
                <input class="datepicker master_input" type="text" Required id="end_date_" name="end_date_" value="{{ $offer->end_datetime->format('d/m/Y') }}" required>
              </div>

              {{-- Validation message --}}
              @if ( $errors->has('end_date_') )
                  <span class="master_message inherit">{{ $errors->first('end_date_') }}</span>
              @endif
              
            </div>
          </div>
         
          <!-- <div class="col-xs-6">
            <label class="master_label mandatory">@lang('keywords.offerImage')</label>
            <div id="fileList"></div>
            <div class="form-group" id="img_dr_btn" style="text-align:end;">
              <input class="inputfile inputfile-1" id="file-1" type="file" name="offer_image" onchange="updateList()">
              <label for="file-1"><span>اختر صورة   </span></label>
            </div>
            <ul class="js-uploader__file-list uploader__file-list" id="img_dr_list" style="text-align:end;padding-left:9%;">
              <li class="js-uploader__file-list uploader__file-list"><span class="uploader__file-list__button"></span><span class="uploader__file-list__button" id="delete"><a class="uploader__icon-button fa fa-times" id="close" onclick="closebtn1()"></a></span><span class="uploader__file-list__thumbnail"><img class="thumbnail" id="img_" src="{{ asset( str_replace('\\', '', $offer->image) ) }}"></span></li>
            </ul>
          </div> -->
          <div class="col-xs-6" >
              <label class="master_label mandatory">@lang('keywords.offerImage')</label>
              <div id="fileList" style="text-align: -webkit-right;text-align: -moz-right;"></div>
              <div class="form-group end-txt" id="img_dr_btn" >
                <input class="inputfile inputfile-1" id="file-1" type="file" name="file-1" onchange="updateList()">
                <label for="file-1"><span>اختر صورة</span></label>
              </div>
              <ul  class="js-uploader__file-list uploader__file-list" id="img_dr_list"padding-left:9%">
                <li class="js-uploader__file-list uploader__file-list"><span class="uploader__file-list__button"></span><span class="uploader__file-list__button" id="delete"><a class="uploader__icon-button fa fa-times" id="close" onclick="closebtn1()"></a></span><span class="uploader__file-list__thumbnail "style="text-align:right"><img class="thumbnail" id="img_" src="{{ asset( str_replace('\\', '', $offer->image) ) }}"></span></li>
              </ul>
            </div>
        </div>
        <div class="col-xs-12 end-txt" id="activationCol" style=" padding-top: 2%;">
            <div class="checkboxrobo">
              @if($offer->is_active)
              <input type="checkbox" id="activation" name="activation" checked>
              @else
              <input type="checkbox" id="activation" name="activation">
              @endif
              <label for="activation">@lang('keywords.active')</label>
            </div>
          </div>
        <!-- <div class="col-xs-12 ">
              <label class="master_label mandatory">@lang('keywords.offerImage')</label>
              <div id="fileList" style="text-align: -webkit-right;text-align: -moz-right;"></div>
              <div class="form-group" id="img_dr_btn" style="text-align:end">
                <input class="inputfile inputfile-1" id="file-1" type="file" name="file-1" onchange="updateList()">
                <label for="file-1"><span>اختر صورة   </span></label>
              </div>
              <ul class="js-uploader__file-list uploader__file-list" id="img_dr_list" style="text-align:end;padding-left:9%">
                <li class="js-uploader__file-list uploader__file-list">
                  <span class="uploader__file-list__thumbnail"><img class="thumbnail" id="img_" src="{{ asset( str_replace('\\', '', $offer->image) ) }}"></span>
                  <span class="uploader__file-list__button"></span>
                  <span class="uploader__file-list__button" id="delete"><a class="uploader__icon-button fa fa-times" id="close" onclick="closebtn1()"></a></span>
                </li>
              </ul>
            </div>
        </div> -->

      <div class="div" style="text-align:end;">
        <button class="master-btn   undefined bgcolor--main  bshadow--0" type="submit"><i class="fa fa-save"></i><span>@lang('keywords.save')</span>
        </button>
        <a class="master-btn   undefined bgcolor--fadebrown  bshadow--0" href="{{route('offers_and_deals')}}"><i class="fa fa-close"></i><span>@lang('keywords.cancel')</span>
        </a>
      </div>
      </form>
    </div>
  </div><br>
</div>

<script type="text/javascript">
  $(function(){
    dateRange('start_date_','end_date_',
    "{{ \Carbon\Carbon::now()->format('Y') }}",
    "{{ \Carbon\Carbon::now()->format('m') }}",
    "{{ \Carbon\Carbon::now()->format('d') }}",
    "{{ \Carbon\Carbon::now()->addYears(1)->format('Y') }}",
    "{{ \Carbon\Carbon::now()->addYears(1)->format('m') }}",
    "{{ \Carbon\Carbon::now()->addYears(1)->format('d') }}",
    '{{ \Carbon\Carbon::now()->addYears(1)->format("d-m-Y") }}'  // end date
    )

  })
</script>
   <script type="text/javascript">
      function closebtn1(){
          $("#img_dr_list").remove();
          $("#img_dr_btn").show();
        }
      $(document).ready(function(){
        $("#img_dr_btn").hide();
      })
      
    </script>
    <script type="text/javascript">
      $(function () {
        $(".select2").select2();
        
      });
      
    </script>
    <script type="text/javascript">
       var listimg = [];
      
       //close_btn_in image
       function closebtn(index){
           listimg.splice(index,1);
           $("#img_list_item").empty();
           $("#img_dr_btn").show();
         }
      //display image
       updateList = function () {
               let input = document.getElementById('file-1');
               let output = document.getElementById('fileList');
               let files1 = input.files;
      
                   if (window.File && window.FileList && window.FileReader) {
      
                       for (var i = 0; i < files1.length; i++) {
                           var file = files1[i];
                           var imgReader = new FileReader();
                           imgReader.addEventListener("load", function (event) {
                               var imgFile = event.target;
                               listimg.push({
                                   
                                   'index': listimg.length,
                                   'image': imgFile.result
                               });
                               if($('html').attr('lang')=='ar'){
                                  output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                                for (var i = 0; i < listimg.length; i++) {
                                    output.innerHTML += `<li class="js-uploader__file-list uploader__file-list" id="img_list_item">
                                    <span class="uploader__file-list__button"></span>
                                    <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(${listimg[i].index})" class="uploader__icon-button fa fa-times" >
                                    </a></span>
                                    <span class="uploader__file-list__text"></span>
                                    <span class="uploader__file-list__thumbnail">
                                    <img class="thumbnail"  src="${listimg[i].image}"></span>
                                    </li>`;
                                }
                                output.innerHTML += '</ul>';
                               }
                               if($('html').attr('lang') == 'en'){
                                output.innerHTML = '<ul class="js-uploader__file-list uploader__file-list">';
                                for (var i = 0; i < listimg.length; i++) {
                                    output.innerHTML += `<li class="js-uploader__file-list uploader__file-list" id="img_list_item">
                                    <span class="uploader__file-list__button"></span>
                                    <span class="uploader__file-list__thumbnail">
                                    <img class="thumbnail"  src="${listimg[i].image}"></span>
                                    <span class="uploader__file-list__text"></span>

                                    <span class="uploader__file-list__button" id="delete" ><a id="close" onclick="closebtn(${listimg[i].index})" class="uploader__icon-button fa fa-times" >
                                    </a></span>
                                   
                                    </li>`;
                                }
                                output.innerHTML += '</ul>';
                               }
                               
      
                           });
      
                           //Read the image
                           imgReader.readAsDataURL(file);
                           $("#file-1")[i].value='';
                       }
                   }
                    $("#img_dr_btn").hide();
           }
      
    </script>
    <script>
      $(function(){
        if($('html').attr('lang')=='en'){
          $("#img_dr_list").empty();
          $("#img_dr_btn").removeClass("end-txt");
          $("#activationCol").removeClass('end-txt');
          $("#img_dr_list").append(`
          
          <li class="js-uploader__file-list uploader__file-list">
                  <span class="uploader__file-list__thumbnail"><img class="thumbnail" id="img_" src="{{ asset( str_replace('\\', '', $offer->image) ) }}"></span>
                  <span class="uploader__file-list__button"></span>
                  <span class="uploader__file-list__button" id="delete"><a class="uploader__icon-button fa fa-times" id="close" onclick="closebtn1()"></a></span>
                </li>
          `)
        }
      })
    </script>
@endsection