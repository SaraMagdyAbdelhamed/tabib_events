<header class="topnavbar-wrapper">
    <nav class="top-navbar navbar-expand-lg     bradius--noborder bshadow--1 ">
      <div class="container"><span></span>
        <button class="navbar-toggler  " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars  "></span></button>
       
        <div class="collapse navbar-collapse nav pull-right  " id="navbarSupportedContent">
          <ul class="navbar-nav">

          <li class="nav-item" style="font-size: 14px important; padding: 0px;">
            <form action="{{ route('changeLang') }}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="url" value="{{ Request::url() }}">
              <input type="hidden" name="locale" value="{{ \Helper::getUserLocale() }}">
                <button type="submit" class="nav-link English" style="background-color: inherit; border: 0px; color: white; ">{{ App::isLocale('ar') ? 'English' : 'العربية' }}</button>
            </form>

          </li>
          </ul>
          <ul class="actionsbar desktop-view hidden-xs">
          @if(\App\Helpers\Helper::hasRule(['Super Admin']))
            <li class="dropdowny"><a class="nav-link dropdowny-toggle  " href="#"><i class="fa fa-bell"></i><span class="badge badge-default badge_style">{{$counter}}</span></a>
              <!-- @if(App::isLocale("en"))
                <ul class="dropdowny-menu" role="menu">

                {{-- @foreach(\App\Helpers\Helper::ListNotifications() as $notification)
                  <li><a href="{{url('/mark_read')}}/{{$notification->id}}">
                    <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                    <p>{{$notification->msg}}</p><span class="notification_date"><i class="fa fa-clock-o"></i>{{date('d/m/Y', strtotime($notification->created_at))}}
                      {{date('H:i:s', strtotime($notification->created_at))}}</span></a></li>
                @endforeach --}}
                 </ul>
              @else
              <ul class="dropdowny-menu" role="menu">
                 @if( count(\Helper::ListNotifications()) > 0 )
                  @foreach(\App\Helpers\Helper::ListNotifications() as $notification)
                  <li><a href="{{url('/mark_read')}}/{{$notification->id}}">
                    <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                    <p>{{$notification->msg_ar}}</p><span class="notification_date"><i class="fa fa-clock-o"></i>{{date('d/m/Y', strtotime($notification->created_at))}}
                      {{date('H:i:s', strtotime($notification->created_at))}}</span></a></li>
                  @endforeach
                @endif 
                 </ul>
              @endif -->
              <ul class="dropdowny-menu" role="menu">
              @foreach($notes as $notification)
              @if(App::isLocale("en"))
              @if($notification->notification_type_id == 6)
                <li class="request" > 
                <a href="{{route('mark_read', [$notification->id, 'events.show'])}}"> 
                    <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                    <p class="text-left">{{$notification->msg}}</p>
                    <div class="pull-right">
                  <div class="btn_{{$notification->id}}">
                     <button class="btn_2 btn_accept btn_{{$notification->id}}" onclick="request_event({{$notification->user_id}},{{$notification->item_id}},1 ,{{$notification->id}})"><i class="fa fa-check" > Accept</i></button>
                      <button class="btn_2 btn_reject btn_{{$notification->id}}" onclick="request_event({{$notification->user_id}},{{$notification->item_id}},2 ,{{$notification->id}})" ><i class="fa fa-close" > Reject</i></button>
                    </div>
                    </div><span class="notification_date"><i class="fa fa-clock-o">
                    </i>{{date('d/m/Y', strtotime($notification->created_at))}}  {{date('H:i:s', strtotime($notification->created_at))}}</span></a>
                </li>
                @elseif($notification->notification_type_id == 7)
                <li><a href="{{route('mark_read', [$notification->id, 'users_mobile.show'])}}">
                    <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                    <p>{{$notification->msg}}</p><span class="notification_date"><i class="fa fa-clock-o"></i>{{date('d/m/Y', strtotime($notification->created_at))}}
                      {{date('H:i:s', strtotime($notification->created_at))}}</span></a></li>
                @endif
                @else
                @if($notification->notification_type_id == 6) 
                <li class="request"><a href="{{route('mark_read', [$notification->id, 'events.show'])}}">
                    <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                    <p class="text-left">{{$notification->msg_ar}}</p>
                    <div class="pull-right">
                    <div class="btn_{{$notification->id}}">
                      <button class="btn_2 btn_accept btn_{{$notification->id}}"><i class="fa fa-check" onclick="request_event({{$notification->user_id}},{{$notification->item_id}},1)"> Accept</i></button>
                      <button class="btn_2 btn_reject btn_{{$notification->id}}"><i class="fa fa-close" onclick="request_event({{$notification->user_id}},{{$notification->item_id}},2)"> Reject</i></button>
                    </div>
                    </div><span class="notification_date"><i class="fa fa-clock-o">
                    </i>{{date('d/m/Y', strtotime($notification->created_at))}} {{date('H:i:s', strtotime($notification->created_at))}}</span></a>
                </li>
                @elseif($notification->notification_type_id == 7)
                <li><a href="{{route('mark_read', [$notification->id, 'users_mobile.show'])}}">
                    <div class="icon-container"><i class="fa fa-volume-up"> </i></div>
                    <p>{{$notification->msg_ar}}</p><span class="notification_date"><i class="fa fa-clock-o"></i>{{date('d/m/Y', strtotime($notification->created_at))}}
                      {{date('H:i:s', strtotime($notification->created_at))}}</span></a></li>
                @endif
                @endif
               @endforeach
              </ul>
              
            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
  </header>