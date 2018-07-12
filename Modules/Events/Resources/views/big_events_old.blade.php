@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="cover-inside-container margin--small-top-bottom bradius--no bshadow--0" style="background-image:  url( {{ asset('img/covers/dummy2.jpg ') }} )   ; background-position: center center; background-repeat: no-repeat; background-size:cover;">
      <div class="row">
        <div class="col-xs-12">
          <div class="text-xs-center">
            <div class="text-wraper">
              <h4 class="cover-inside-title">Events </h4><i class="fa fa-chevron-circle-right"></i>
              <h4 class="cover-inside-title sub-lvl-2">Big events </h4>
            </div>
          </div>
        </div>
        <div class="cover--actions"><span></span>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-xs-12">
    <h5>Through this screen backend user determine big events appears on mobile application. Backend user select maximum 5 big events and he can arrange their ranks.</h5>
  </div><br>
  <div class="col-xs-12">
    <div class="cardwrap inherit bradius--noborder bshadow--0 padding--small margin--small-top-bottom">
      <div class="two-divs-select">
        <div class="row">
          <div class="col-xs-12">
            <div class="master_field">
              <label class="master_label mandatory" for="sort_list">sort_list </label>
              <select class="master_input" id="sort_list">
                <option value="1">All Events </option>
                <option value="2">Suggested Events</option>
              </select>
            </div>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <select class="select_big_event" id="multiselect" name="from[]" size="8" multiple="multiple">
              @foreach($events as $event)
              <option value="{{$event->id}}">{{$event->name}}</option>

              @endforeach
            </select>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <button class="btn btn-block" id="multiselect_rightSelected" type="button"><i class="fa fa-chevron-right"></i></button>
            <button class="btn btn-block" id="multiselect_leftSelected" type="button"><i class="fa fa-chevron-left"></i></button>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <select class="select_big_event" id="multiselect_to" name="to[]" size="8" multiple="multiple"></select>
            <div class="row">
              <div class="col-sm-6">
                <button class="btn btn-block" id="multiselect_move_up" type="button"><i class="fa fa-arrow-up"></i></button>
              </div>
              <div class="col-sm-6">
                <button class="btn btn-block col-sm-6" id="multiselect_move_down" type="button"><i class="fa fa-arrow-down"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@section('js')
 <script>
   $('#sort_list').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    // if(valueSelected == 2){
     $('#multiselect option').remove();
     // $('#multiselect_to option').remove();
var _token = '{{csrf_token()}}';
    $.ajax({
      type: 'POST',
      url: '{{url('bigevents_select')}}'+ '/' + valueSelected,
      data: { _token: _token},
      success: function (data) {
      //  $('tr[data-event-id=' + event_id + ']').fadeOut();
           //$(".two-divs-select").append("<div>"+data+"</div>");
           // .each loops through the array
$.each(data, function(i){
   $("#multiselect").append(data[i]);
});
      }
    });
// }
    });
  </script>

<script type="text/javascript">
     /* jQuery(document).ready(function($) {
       $('#multiselect').multiselect();
     }); */



     $('#multiselect').multiselect({
      search: {
       left: '<input type="text" name="q" class="master_input" placeholder="Search..." />',
       right: '<input type="text" name="q" class="master_input" placeholder="Search..." />',
      },
      fireSearch: function(value) {
       return value.length > 3;
      }
     });
   </script>

   <script>
   //get all options from multiselect_to
  // $('#multiselect_rightSelected').click(function(e){
function saveSort(e) { 

var select1 = document.getElementById('multiselect_to');
var values = new Array();

// for(var i=0; i < select1.options.length; i++){
//     values.push(select1.options[i].value);
// }
$('#multiselect_to option').each(function(){
   if($.inArray(this.value, values) >-1){
      $(this).remove()
      alert('You have already selected this Event!');
   }else{
    if(values.length>=5){
      $(this).remove()
    alert('Sorry you have exceeded your 5 big events limit!');
    }else{
      values.push(this.value);
    }
    
   }
});
// if(values.length>5){
//   alert('Sorry you have exceeded your 5 big events limit!');

//   // remove last one in to
//    var selectFrom = document.getElementById("multiselect");
//   var select = document.getElementById("multiselect_to");
//   //selectFrom.options[select.options.length-6] = select.options[select.options.length-1];
//   select.options[select.options.length-1] = null;
// }else{
// e.preventDefault();
var _token = '{{csrf_token()}}';
    $.ajax({
      type: 'POST',
      url: '{{url('bigevents_post')}}',
      data: { _token: _token  , big_events: values },
      success: function (data) {
           //$(".two-divs-select").append("<div>"+data+"</div>");
      }
    });
  // });
// }
}
$('#multiselect_rightSelected').click(saveSort);
$('#multiselect_move_up').click(saveSort);
$('#multiselect_move_down').click(saveSort);
$('#multiselect_leftSelected').click(saveSort);
//$('#multiselect').ondblclick(saveSort);
document.getElementById('multiselect').ondblclick = function(){
    saveSort();
    // or alert(this.options[this.selectedIndex].value);
};

   </script>
@endsection @endsection
