@extends('layouts.layout_student')
@section('content')

<style>
    .cn_menu{
        margin-top: 15px;
    }

    .dropdown-menu.pull-left {
    left:0;
  }

  .no_padding_margin{
    padding: 0px !important;
    margin: 0px !important;
    border-radius: 0px !important;
    border: 0px !important;
}

.panel {
    border-radius: 0px;

}

h3{
    color: grey;
}
.btn-skills{
    margin: 0px 5px 0px 5px;
}
.mkgrey{
    color: grey;
    font-size: 11px;
}

.alert {
    padding: 15px;
    margin-bottom: 0px;
    border-radius: 0px;
}


.alert-notification {
    color: black;
    background-color: #eee;
    border-color: #e5e5e5;
}

.fa-chevron-down{
  font-size: 10px;
}

.open>.dropdown-menu {
    top: 20px;
}

</style>

<div class="container">
    <div class="col-md-8" style="padding:0px;">
<br>
    <div class="  pnl_border">
        <div class="col-lg-12 no_padding_margin"  style="padding-right:10px; ">
        
            <div class="panel panel-default" >
                <div class="panel-body textcenter">
                <a href="#" class="pull-right">Notification Settings</a>
                  <h3>Your Notifications</h3>

                  

                  <div class="row" style=" border-bottom: 1px dashed lightgrey;border-top: 1px dashed lightgrey;">
                      <div class="col-md-12"><br>
                        <div class="alert alert-notification">
    <div class="dropdown">
  <a href="#" class="close dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-chevron-down" ></i></a>
  <ul class="dropdown-menu pull-right">
    <li><a href="#">Mark as important</a></li>
    <li><a href="#">Mark as Read</a></li>
    <li><a href="#">Remove</a></li>
  </ul>
</div>

    <strong>Congrats !</strong> You are selected in first round of interview in XYZ company.
    <div class="mkgrey">April 10 at 11:45 PM</div>
  </div>
  <div class="alert alert-notification">
    <div class="dropdown">
  <a href="#" class="close dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-chevron-down" ></i></a>
  <ul class="dropdown-menu pull-right">
    <li><a href="#">Mark as important</a></li>
    <li><a href="#">Mark as Read</a></li>
    <li><a href="#">Remove</a></li>
  </ul>
</div>

    <strong>Congrats !</strong> You are selected in first round of interview in XYZ company.
    <div class="mkgrey">April 10 at 11:45 PM</div>
  </div>
  <div class="alert alert-notification">
    <div class="dropdown">
  <a href="#" class="close dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-chevron-down" ></i></a>
  <ul class="dropdown-menu pull-right">
    <li><a href="#">Mark as important</a></li>
    <li><a href="#">Mark as Read</a></li>
    <li><a href="#">Remove</a></li>
  </ul>
</div>

    <strong>Congrats !</strong> You are selected in first round of interview in XYZ company.
    <div class="mkgrey">April 10 at 11:45 PM</div>
  </div>
                      <br></div>

                  </div>

                </div><!--panel-body pnl_bottom-->
                

            </div><!--panel-->

            </div> 

        </div>

    

          
    

                 

        </div>

       <div class="col-md-4" style="padding:0px; "></div>

        </div>  

        

@stop