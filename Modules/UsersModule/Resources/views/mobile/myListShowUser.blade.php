@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- =============== Custom Content ====================-->
    <div class="row">
      <div class="col-lg-12">
        <div class="coverglobal text-center bshadow--2" style="background:  url( '../img/covers/dummy2.jpg') ; background-position:center center ; background-repeat:no-repeat ;background-size:cover;"><span></span>
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <div class="text-xs-center cont-avatar"><a href="user_profile.html"><img class="coverglobal__avatar bradius--circle" src="../img/avaters/male.jpg">
                    <h3 class="coverglobal__title  ">
                        {{ $user->username ? : __('keywords.not') }}    
                    </h3><small class="coverglobal__slogan  "></small></a></div>
                <div class="coverglobal__actions"><span></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12">
        <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
          <div class="full-table">
            <table class="verticaltable table-master">
              <tr>
                <th><span class="cellcontent">@lang('keywords.countryCode')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->tele_code ? : __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.mobile1')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->mobile ? : __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.mobile2')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->userInfo ? ($user->userInfo->mobile2 ? :  __('keywords.not')) : __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.mobile3')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->userInfo != NULL ? ($user->userInfo->mobile3 ? :  __('keywords.not')) : __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.email')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->email ? :  __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.Country')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->country ? ($user->country->name ? :  __('keywords.not')) :  __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.City')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->city ? ($user->city->name ? :  __('keywords.not')) :  __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.region')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->userInfo ? $user->userInfo->getRegion(__('keywords.not')) : __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.address')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->userInfo ? ($user->userInfo->address ? : __('keywords.not')) : __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.specialization')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->userInfo ? $user->userInfo->getSpecialization(__('keywords.not')) : __('keywords.not') }}
                    </span>
                </td>
              </tr>
              <tr>
                <th><span class="cellcontent">@lang('keywords.gender')</span></th>
                <td>
                    <span class="cellcontent">
                        {{ $user->gender ? $user->gender->name : __('keywords.not') }}
                    </span>
                </td>
              </tr>
            </table>
            <div class="remodal log-custom" data-remodal-id="log_linkX" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
              <button class="remodal-close" data-remodal-action="close" aria-label="Close"></button>
              <div>
                <h2 class="title">title of the changing log in</h2>
                <div class="log-content">
                  <div class="log-container">
                    <table class="log-table">
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <th>log title</th>
                        <th>user</th>
                        <th>time</th>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>January</td>
                        <td>$100</td>
                        <td>$100</td>
                      </tr>
                      <tr class="log-row" data-link="https://www.google.com.eg/">
                        <td>February</td>
                        <td>$80</td>
                        <td>$80</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:end;">

            <form action="{{ route('myList.status.update') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="checkboxrobo">
                <input type="checkbox" id="activation" value="1" name="activation" {{ $user->is_active ? 'checked' : '' }}>
                <label for="activation">@lang('keywords.Activate')</label>
                </div>
                <div class="row">
                <div class="div" style="text-align:center;">
                    <button class="master-btn   undefined bgcolor--main  bshadow--0" type="submit">
                        <i class="fa fa-save"></i><span>@lang('keywords.save')</span>
                    </button>
                    <button class="master-btn   undefined bgcolor--fadebrown  bshadow--0" type="submit">
                        <i class="fa fa-close"></i><span>@lang('keywords.cancel')</span>
                    </button>
                </div>
                </div>
            </form>

          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
@endsection