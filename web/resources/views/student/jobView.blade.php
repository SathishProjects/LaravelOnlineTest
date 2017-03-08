<!-- Vijay deva -->
@extends('layouts.layout_student')
@section('content')
<style type="text/css">
	.list-group-item
	{
		padding: 5px 15px;
	}
	.btn-circle
	{
		border-radius: 100px !important;
	}
</style>
<div class="container">
        <div class="row fj_mrg_1">
          <ol class="breadcrumb breadcrumb-arrow">
          <li><a href="../student/dashboard" class="fj_fnt_6 "> <i class="glyphicon glyphicon-arrow-left"></i> back</a></li>
            <li class="">Job view</li>
          </ol>
      </div>

       <div class="alert alert-fj-success alert-normal-info">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  					You have qualified to HR round.
	  </div> 
</div>

<div class="container">
<div class="stepwizard fj_mrg_1">
    <div class="stepwizard-row setup-panel">
       <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-ok"></i></a>
            <p>Android drive</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-ok"></i></a>
            <p>Aptitude Test</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-ok"></i></a>
            <p>Technical Test</p>
        </div>
         <div class="stepwizard-step">
            <a href="#step-4" type="button" class="btn btn-warning btn-circle"><i class="fa fa-info" aria-hidden="true"></i></a>
            <p>HR round</p>
        </div>
    </div>
</div>
</div><!--container-->
<form role="form">
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                
                <div class="container fj_pad_0" id="main">
					<div class="row">
					   <div class="col-md-12">
					   		<div>
					        <span class="fj_fnt_8"> Android Drive</span>
					        <h4 class="pull-right fj_color_1">You have Applied this Job</h4>
					        </div>
					   </div>
					   <hr>
					    <div class="col-md-7 col-sm-6">
					      	
					                <div class="panel panel-default">
							          <div class="panel-heading"> <h4>Qualification</h4></div>
							   			<div class="panel-body">
							              <div class="">
							                <a class="list-group-item fj_border_1"><b>Degree</b> : BE</a>
							                <a class="list-group-item fj_border_1"><b>Courses</b> : Computer science, Electronics and Communication</a>
							                <a class="list-group-item fj_border_1"><b>Marks</b> : Above 65%</a>
							                <a class="list-group-item fj_border_1"><b>Passed out</b> : 2016</a>
							              </div>

							            </div>
							   		</div>

							   		 <div class="panel panel-default">
							          <div class="panel-heading"> <h4>Last date to apply</h4></div>
							   			<div class="panel-body">
							              <div class="">
							              <a class="list-group-item fj_border_1"><b>Date</b> : 26 April 2016</a>
							              </div>

							            </div>
							   		</div>

							   		<div class="panel panel-default">
					                <div class="panel-heading"><h4>Skills</h4></div>
						   			<div class="panel-body">
						   			<div class="">
							              <a class="list-group-item fj_border_1">Php, Java, C, C++</a>
							              </div>
						   			</div>
					                </div>


							   		<div class="panel panel-default">
					                <div class="panel-heading"><h4>Designation</h4></div>
						   			<div class="panel-body">
						   			<div class="">
							              <a class="list-group-item fj_border_1">Software Developer</a>
							              </div>
						   			</div>
					                </div>
					                
						          
							   		<div class="panel panel-default">
					                <div class="panel-heading"><h4>Salary</h4></div>
						   			<div class="panel-body">
						   			<div class="">
							              <a class="list-group-item fj_border_1">2L per Annum</a>
							              </div>
						   			</div>
					                </div>
					  	</div><!--col-md-8-->
					   <div class="col-md-5 col-sm-6">

					              

					        <div class="panel panel-default">
					                <div class="panel-heading"><h4>Contact Info</h4></div>
						   			<div class="panel-body">
						              <ul class="list-group" style="margin-bottom: 0">
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-user"></i> Joseph Vijay Chandra Sekar</li> 
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-phone"></i> 9965656850</li>
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-envelope"></i> vijay0903@mo.com</li>
						              </ul>
						            </div>
					            </div>

					   		<div class="panel panel-default">
					                <div class="panel-heading"><h4>Job Location</h4></div>
						   			<div class="panel-body">
						   			<div class="">
							              <a class="list-group-item fj_border_1">5A, Reddy Street,</a>
							               <a class="list-group-item fj_border_1">Virugambakkam,</a>
							               <a class="list-group-item fj_border_1">Chennai,</a>
							                <a href="https://www.google.co.in/maps/place/Reddy+St,+Virugambakkam,+Chennai,+Tamil+Nadu/@13.0486487,80.194189,206m/data=!3m1!1e3!4m2!3m1!1s0x3a5266ce892a266d:0x2f1d8413bedf9aee" target="_blank" class="list-group-item fj_border_1"><i class="glyphicon glyphicon-map-marker"></i> View Map</a>
							              </div>						              
						            </div>
					            </div>
					    </div>


					     <div class="col-md-12 col-sm-12">
								
						   			<div align="center">
						            <h4 class="fj_color_1">You have Applied this Job</h4>
						            </div>
					           
					    </div>
					  	
					  </div><!--/row-->
					   
					</div><!--/main-->
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <div class="container fj_pad_0" id="main">
					<div class="row">
					   <div class="col-md-12">
					   		<div>
					        <span class="fj_fnt_8"> Aptitude Test</span>
					       <h4 class="pull-right fj_color_1">You have Applied a Aptitude Test</h4>
					        </div>
					   </div>
					   <hr>
					    <div class="col-md-7 col-sm-6">
					      	
					                <div class="panel panel-default">
							          <div class="panel-heading"> <h4>Date & Time</h4></div>
							   			<div class="panel-body">
							              <div class="">
							              <a class="list-group-item fj_border_1"><b>Date</b> : 12 April 2016</a>
							              <a class="list-group-item fj_border_1"><b>Time</b> : 10 Am</a>
							              </div>

							            </div>
							   		</div>

							   		 <div class="well"> 
						              <form class="form">
						              <h4>Interview Instruction</h4>
						              
						                <p>
						                Lorem ipsum dolor sit amet, eos maiorum lobortis vulputate ex, ad atqui oportere his. Sea clita nullam te. Dicam nonumy eam ad. Eu tempor maluisset his, pro ex errem recusabo. Vel in error semper instructior.

Sed prima postulant ne. Vel ad omnes consul. Odio possit duo ad. An ancillae signiferumque eum, ex elit scripta usu.

Et mei vidit timeam liberavisse. Dicam cetero et sed, vide melius deserunt cum ea, mea illud salutandi cu. Ius agam velit no. Eos sint saperet appetere ea, quem odio probo vim ei. Ut nec tibique indoctum. Aeque cetero fabellas te nec. Duis saperet intellegam et nec, nam feugiat propriae perfecto in.
						                </p>
						             
						              </form>
					               </div>
					         
					  	</div><!--col-md-8-->
					   <div class="col-md-5 col-sm-6">

					              

					        <div class="panel panel-default">
					                <div class="panel-heading"><h4>Contact Info</h4></div>
						   			<div class="panel-body">
						              <ul class="list-group" style="margin-bottom: 0">
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-user"></i> Joseph Vijay Chandra Sekar</li>
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-phone"></i> 9965656850</li>
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-envelope"></i> vijay0903@mo.com</li>
						              </ul>
						            </div>
					            </div>

					   		<div class="panel panel-default">
					                <div class="panel-heading"><h4>Job Location</h4></div>
						   			<div class="panel-body">
						   			<div class="">
							              <a class="list-group-item fj_border_1">5A, Reddy Street,</a>
							               <a class="list-group-item fj_border_1">Virugambakkam,</a>
							               <a class="list-group-item fj_border_1">Chennai,</a>
							                <a href="https://www.google.co.in/maps/place/Reddy+St,+Virugambakkam,+Chennai,+Tamil+Nadu/@13.0486487,80.194189,206m/data=!3m1!1e3!4m2!3m1!1s0x3a5266ce892a266d:0x2f1d8413bedf9aee" target="_blank" class="list-group-item fj_border_1"><i class="glyphicon glyphicon-map-marker"></i> View Map</a>
							              </div>
						            </div>
					            </div>
					    </div>


					     <div class="col-md-12 col-sm-12">
								
						   			<!-- <div align="center">
						             <h4 class="fj_color_1">You have Applied this Job</h4>
						            </div> -->
					           
					    </div>
					  	
					  </div><!--/row-->
					   
					</div><!--/main-->
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <div class="container fj_pad_0" id="main">
					<div class="row">
					   <div class="col-md-12">
					   		<div>
					        <span class="fj_fnt_8"> Technical Test</span>
					        <h4 class="pull-right fj_color_1">You have Applied a Technical Test</h4>
					        </div>
					   </div>
					   <hr>
					    <div class="col-md-7 col-sm-6">
					      	
					                <div class="panel panel-default">
							          <div class="panel-heading"> <h4>Date & Time</h4></div>
							   			<div class="panel-body">
							              <div class="">
							              <a class="list-group-item fj_border_1"><b>Date</b> : 20 April 2016</a>
							              <a class="list-group-item fj_border_1"><b>Time</b> : 10.30 Am</a>
							              </div>

							            </div>
							   		</div>

							   		 <div class="well"> 
						              <form class="form">
						              <h4>Interview Instruction</h4>
						              
						                <p>
						                Lorem ipsum dolor sit amet, eos maiorum lobortis vulputate ex, ad atqui oportere his. Sea clita nullam te. Dicam nonumy eam ad. Eu tempor maluisset his, pro ex errem recusabo. Vel in error semper instructior.

Sed prima postulant ne. Vel ad omnes consul. Odio possit duo ad. An ancillae signiferumque eum, ex elit scripta usu.

Et mei vidit timeam liberavisse. Dicam cetero et sed, vide melius deserunt cum ea, mea illud salutandi cu. Ius agam velit no. Eos sint saperet appetere ea, quem odio probo vim ei. Ut nec tibique indoctum. Aeque cetero fabellas te nec. Duis saperet intellegam et nec, nam feugiat propriae perfecto in.
						                </p>
						             
						              </form>
					               </div>
					         
					  	</div><!--col-md-8-->
					   <div class="col-md-5 col-sm-6">

					              

					        <div class="panel panel-default">
					                <div class="panel-heading"><h4>Contact Info</h4></div>
						   			<div class="panel-body">
						              <ul class="list-group" style="margin-bottom: 0">
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-user"></i> Joseph Vijay Chandra Sekar</li>
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-phone"></i> 9965656850</li>
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-envelope"></i> vijay0903@mo.com</li>
						              </ul>
						            </div>
					            </div>

					   		<div class="panel panel-default">
					                <div class="panel-heading"><h4>Job Location</h4></div>
						   			<div class="panel-body">
						   			<div class="">
							              <a class="list-group-item fj_border_1">5A, Reddy Street,</a>
							               <a class="list-group-item fj_border_1">Virugambakkam,</a>
							               <a class="list-group-item fj_border_1">Chennai,</a>
							                <a href="https://www.google.co.in/maps/place/Reddy+St,+Virugambakkam,+Chennai,+Tamil+Nadu/@13.0486487,80.194189,206m/data=!3m1!1e3!4m2!3m1!1s0x3a5266ce892a266d:0x2f1d8413bedf9aee" target="_blank" class="list-group-item fj_border_1"><i class="glyphicon glyphicon-map-marker"></i> View Map</a>
							              </div>
						            </div>
					            </div>
					    </div>


					     <div class="col-md-12 col-sm-12">
								
						   			<!-- <div align="center">
						             <h4 class="fj_color_1">You have Applied this Job</h4>
						            </div> -->
					           
					    </div>
					  	
					  </div><!--/row-->
					   
					</div><!--/main-->
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-4">
        <div class="col-xs-12">
            <div class="col-md-12">
                <div class="container fj_pad_0" id="main">
					<div class="row">
					   <div class="col-md-12">
					   		<div>
					        <span class="fj_fnt_8"> HR Round</span>
					        <a href="#" class="pull-right btn btn-warning">Apply</a>
					        </div>
					   </div>
					   <hr>
					    <div class="col-md-7 col-sm-6">
					      	
					                <div class="panel panel-default">
							          <div class="panel-heading"> <h4>Date & Time</h4></div>
							   			<div class="panel-body">
							              <div class="">
							              <a class="list-group-item fj_border_1"><b>Date</b> : 29 April 2016</a>
							              <a class="list-group-item fj_border_1"><b>Time</b> : 3 pm</a>
							              </div>

							            </div>
							   		</div>

							   		 <div class="well"> 
						              <form class="form">
						              <h4>Interview Instruction</h4>
						              
						                <p>
						                Lorem ipsum dolor sit amet, eos maiorum lobortis vulputate ex, ad atqui oportere his. Sea clita nullam te. Dicam nonumy eam ad. Eu tempor maluisset his, pro ex errem recusabo. Vel in error semper instructior.

Sed prima postulant ne. Vel ad omnes consul. Odio possit duo ad. An ancillae signiferumque eum, ex elit scripta usu.

Et mei vidit timeam liberavisse. Dicam cetero et sed, vide melius deserunt cum ea, mea illud salutandi cu. Ius agam velit no. Eos sint saperet appetere ea, quem odio probo vim ei. Ut nec tibique indoctum. Aeque cetero fabellas te nec. Duis saperet intellegam et nec, nam feugiat propriae perfecto in.
						                </p>
						             
						              </form>
					               </div>
					         
					  	</div><!--col-md-8-->
					   <div class="col-md-5 col-sm-6">

					              

					        <div class="panel panel-default">
					                <div class="panel-heading"><h4>Contact Info</h4></div>
						   			<div class="panel-body">
						              <ul class="list-group" style="margin-bottom: 0">
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-user"></i> Joseph Vijay Chandra Sekar</li>
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-phone"></i> 9965656850</li>
						              <li class="list-group-item fj_border_1"><i class="glyphicon glyphicon-envelope"></i> vijay0903@mo.com</li>
						              </ul>
						            </div>
					            </div>

					   		<div class="panel panel-default">
					                <div class="panel-heading"><h4>Job Location</h4></div>
						   			<div class="panel-body">
						   			<div class="">
							              <a class="list-group-item fj_border_1">5A, Reddy Street,</a>
							               <a class="list-group-item fj_border_1">Virugambakkam,</a>
							               <a class="list-group-item fj_border_1">Chennai,</a>
							                <a href="https://www.google.co.in/maps/place/Reddy+St,+Virugambakkam,+Chennai,+Tamil+Nadu/@13.0486487,80.194189,206m/data=!3m1!1e3!4m2!3m1!1s0x3a5266ce892a266d:0x2f1d8413bedf9aee" target="_blank" class="list-group-item fj_border_1"><i class="glyphicon glyphicon-map-marker"></i> View Map</a>
							              </div>
						            </div>
					            </div>
					    </div>


					     <div class="col-md-12 col-sm-12">
								
						   			<div align="center">
						             <a href="#" class="btn btn-warning">Apply</a>
					        </div>
					           
					    </div>
					  	
					  </div><!--/row-->
					   
					</div><!--/main-->
            </div>
        </div>
    </div>
</form>
@stop