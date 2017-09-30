<!-- Vijay deva -->
@extends('layouts.layout_college')
@section('content')

<div class="container">
        <div class="row fj_mrg_1">
          <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="../college/dashboard" class="fj_fnt_6 fj_color_1"> <i class="glyphicon glyphicon-home"></i></a></li>
            <li class="">Send SMS</li>
          </ol>
      </div>

      <!-- <div class="alert alert-fj-success alert-normal-info">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  					4 students qualified to <b>HR round</b>.
	  </div>  -->
</div>
 <div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login fj_box_shadow">
          <div class="panel-heading fj_border_bottom_1 fj_pad_15">
            <div class="row">
              <div class="col-xs-6" align="center">
                <a href="#" class="active" id="login-form-link">Compose SMS</a>
              </div>
              <div class="col-xs-6" align="center">
                <a href="#" id="register-form-link">Bulk SMS</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="login-form" action="" method="post" role="form" style="display: block;">
                 <div class="tab-pane" id="compose">
      
                      <div class=" clearfix">
                          <div class="col-md-12 content-container">
                           <h4 class="content-title" align="center">Compose SMS</h4>
                          
                              <div class="form-group">
                              <h5>To</h5>
                                  <input id="tokenfield" type="text" class="form-control" placeholder="Enter email address and hit enter" />
                                  <h5 align="right">Note :<b class="fj_color_1"> Type mobile number and hit enter</b></h5>
                              </div>

                              <div class="form-group">
                              <h5>Message</h5>
                                  <textarea class="form-control" placeholder="Your Message"></textarea>
                              </div>

                              
                              <div class="btn-send">
                              <button class="btn btn-success"><span class="glyphicon glyphicon-send"></span> Send</button>
                              </div>
                          </div>
                      </div>
                        
                    </div>
                </form>
                <form id="register-form" action="" method="post" role="form" style="display: none;">
                   <div class="tab-pane" id="compose">
      
                      <div class=" clearfix">
                          <div class="col-md-12 content-container">
                           <h4 class="content-title" align="center">Bulk SMS</h4>
                          
                              <div class="form-group">
                              <h5>To</h5>
                                  <input type="file" name="email_file" class="form-control" placeholder="Enter email address and hit enter" />
                                  <h5 align="right">Note :<b class="fj_color_1"> Upload correct .xls file</b></h5>
                              </div>

                              <div class="form-group">
                              <h5>Message</h5>
                                  <textarea class="form-control" placeholder="Your Message"></textarea>
                              </div>

                              
                              <div class="btn-send">
                              <button class="btn btn-success"><span class="glyphicon glyphicon-send"></span> Send</button>
                              </div>
                          </div>
                      </div>
                        
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop