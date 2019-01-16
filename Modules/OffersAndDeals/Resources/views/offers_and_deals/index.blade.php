@extends('layouts.app')
@section('content')

              <!-- =============== Custom Content ===========-==========-->
              <div class="row">
                <div class="col-xs-12">
                  <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image: url({{ asset('/img/covers/dummy2.jpg ')  }}  )   ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="text-xs-center">
                          <div class="text-wraper">
                            <h3 class="cover-inside-title  ">@lang('keywords.offers_and_deals')</h3>
                          </div>
                        </div>
                      </div>
                      <div class="cover--actions"><a class="bradius--no border-btn master-btn" type="button" href="{{route('offers_and_deals.add')}}">@lang('keywords.addNewOffer')</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
                    <div class="full-table">
                      <div class="bottomActions__btns">
                        <a id="deleteSelected" class="master-btn" href="#" onclick="delete_many('#dataTableTriggerId_001', '{{ route('offers_and_deals.deleteSelected') }}')">@lang('keywords.deleteSelected')</a>
                      </div>
                      <form id="dataTableTriggerId_001_form">
                        <table class="data-table-trigger table-master" id="dataTableTriggerId_001">
                          <thead>
                            <tr class="bgcolor--gray_mm color--gray_d">
                              <th><span class="cellcontent">&lt;input type=&quot;checkbox&quot; data-click-state=&quot;0&quot; name=&quot;select-all&quot; id=&quot;select-all&quot; /&gt;</span></th>
                              <th><span class="cellcontent">@lang('keywords.serialNo')</span></th>
                              <th><span class="cellcontent">@lang('keywords.image')</span></th>
                               <th><span class="cellcontent">@lang('keywords.title')</span></th>
                              <th><span class="cellcontent">@lang('keywords.description')</span></th>
                              <th><span class="cellcontent">@lang('keywords.status')</span></th>
                              <th><span class="cellcontent">@lang('keywords.Actions')</span></th>
                            </tr>
                          </thead>
                          <tbody>
                           @foreach($offers as $offer)
                            <tr data-id="{{$offer->id}}">
                              <td><span class="cellcontent" data-id="{{ $offer->id }}"></span></td>
                              <td><span class="cellcontent">{{$offer->id}}</span></td>
                              <td><span class="cellcontent"><img src = "{{ asset( str_replace('\\', '', $offer->image) ) }}" , class = " img-in-table"></span></td>
                               <td><span class="cellcontent">{{$offer->name}}</span></td>
                              <td><span class="cellcontent">{{$offer->description}}</span></td>
                              @if($offer->is_active)
                              <td><span class="cellcontent"><i class = "fa icon-in-table-true fa-check"></i></span></td>
                             @else
                             <td><span class="cellcontent"><i class = "fa icon-in-table-false fa-times"></i></span></td>

                             @endif
                              <td>
                              <span class="cellcontent">
                              <a href= "{{route('offers_and_deals.edit',$offer->id)}}" ,  class= "action-btn bgcolor--fadegreen color--white "><i class = "fa  fa-pencil"></i></a>
                              <a onclick="delete_single('{{ $offer->id }}', '{{ route('offers_and_deals.delete') }}')"  class= "btn-warning-confirm action-btn bgcolor--fadebrown color--white deleteRecord"><i class = "fa  fa-trash-o"></i></a>
                               </span>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </form>
                      
                    </div>
                  </div>
                </div><br>
              </div>



<script>
    $(document).ready(function() {

     // $('#menu_1').addClass('openedmenu');
      $('#sub_8_3').addClass('pure-active');

    });
</script>

@endsection