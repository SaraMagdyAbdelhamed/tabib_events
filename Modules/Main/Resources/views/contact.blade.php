@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg') }} )  ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
        <div class="row">
          <div class="col-xs-12">
            <div class="text-xs-center">         
              <div class="text-wraper">
                <h4 class="cover-inside-title">@lang('keywords.mainData') </h4><i class="fa fa-chevron-circle-right"></i>
                <h4 class="cover-inside-title sub-lvl-2">@lang('keywords.contactUs')</h4>
              </div>
            </div>
          </div>
          <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="#popupModal_1">@lang('keywords.EditContact')</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
        <div class="main-title-conts">
          <div class="caption">
            <h3 class="inherit"></h3>
          </div>
        </div>
        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
          <div class="full-table">
            <table class="verticaltable table-master">
              <tr>
                <th><span class="cellcontent">@lang('keywords.email')</span></th>
                <td><span class="cellcontent" style="text-transform: lowercase;">{{ $email }}</span></td>
              </tr>
            </table>
          </div>
          <div class="clearfix"></div>
        </div>
      </div><br>
    </div>
  </div>
  <div class="remodal" data-remodal-id="popupModal_1" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
    <div>
      <div class="row">

        <form action="{{ route('contact.edit') }}" method="POST">
          {{ csrf_field() }}
          
        <div class="col-lg-12">
          <h3>@lang('keywords.EditContact')</h3>
        </div>
        <div class="col-xs-12">
          
            <div class="master_field">
              <label class="master_label" for="client_email">@lang('keywords.email')</label>
              <input name="email" value="{{ $email }}" class="master_input" type="email" placeholder="ex:info@eventakom.com" id="client_email" required ><span class="valid-label"></span>
            </div>
        </div>
        <div class="col-xs-12"><button class="remodal-cancel" data-remodal-action="cancel">@lang('keywords.cancel')</button>
        <button type="submit" class="remodal-confirm">@lang('keywords.save')</button>
        </div>
        </form>

      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
        $('#menu_1').addClass('openedmenu');
        $('#sub_1_4').addClass('pure-active');
    });
</script>
@endsection