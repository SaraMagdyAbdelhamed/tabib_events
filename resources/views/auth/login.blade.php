<!DOCTYPE html>
<html lang="ar">
  <head>
    <!-- =====================================================-->
    <!-- ==================HEAD=============================-->
    <!-- =====================================================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="طبيب">
    <meta name="keywords" content="طبيب">
    <!-- =============== APP FAVICON ===============-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ee4a7e">
    <meta name="msapplication-TileColor" content="#ee4a7e">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#281160">
    <!-- =============== APP TITLE ===============-->
    <title>{{ __('keywords.login_page_name') }}</title>
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('css/style__0__rtl.min.css') }}">
    <!-- =============== APP SCRIPT ===============-->
    <script src="{{ asset('js/modernizr.js') }}"></script>

    <style>
      #submit-button {
        border: 0px;
        padding: 10px 35px;
        background-color: #281160;
        color: white;
      }

      #submit-button:hover {
        background-color: #473670;
      }

      .alert-danger {
        color: #e74c3c !important;
      }
    </style>
  </head>
  <body>
    <div class="layout_page">
      <div class="wrapper">
        <!-- =============== Custom Content ===========-==========-->
        <div class="row">
          <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
            <div class="login-page">
              <div class="form-login inherit bradius--small inherit ">
                <img class="logo" src="{{ asset('img/logo/logo__dark.svg') }}" alt="">

                {{-- login form --}}
                <form class="login-form" action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}

                    <input name="username" class="inherit inherit bradius--small inherit" type="text" placeholder="username" required>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif

                    <input name="password" class="inherit inherit bradius--small inherit" type="password" placeholder="password" required>
                     @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    {{-- timezone --}}
                    <input type="hidden" name="timezone" id="timezone">

                    {{-- custom error message --}}
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                          {{Session::get('error')}}
                        </div>
                    @endif

                    {{-- custom error message --}}
                    @if(Session::has('error_en'))
                        <div class="alert alert-danger">
                          {{Session::get('error_en')}}
                        </div>
                    @endif

                    <button type="submit" class="inherit inherit bradius--small inherit" id="submit-button">
                      login
                    </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- =============== APP MAIN SCRIPTS ===============-->
    <script type="text/javascript" src="{{ asset('js/scripts.min.js') }}"></script>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <script type="text/javascript"></script>

    {{-- timezone scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.js"></script>

<script>
  var timezone = moment.tz.guess();
  $('#timezone').val(timezone);
</script>

  </body>
</html>