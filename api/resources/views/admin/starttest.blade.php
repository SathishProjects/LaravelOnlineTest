@extends('layouts.test_page')
@section('content')
	<style>

		@media only screen and (min-width: 768px){
			#header .head-right {
				margin-top: 25px !important;
				margin-right: -117px !important;
			}}
	</style>


	<div class="container" xmlns="http://www.w3.org/1999/html">
		<div class="container">

			<div class="col-md-12">

				<div class="panel-group panel-group1" >
					<div class="panel panel-default ">
						<div  class="panel-collapse collapse in">
							<div class="panel-body">

								<div class="row">
									<div class="col-md-12">
										<center><label>Welcome,</label> {!! session('user_authenticated.name') !!}</center>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12">
										<label>General Instructions:  </label>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12">
										<p>
										<h5>Please read the below instructions carefully while appearing for the online test at www.first.jobs website.</h5>
										<ul style="list-style-type:circle">
											<li>Total number of questions 20. Total of 30 minutes duration will be given to attempt all 20 questions.</li>
											<li>The clock has been set at the server and countdown timer displayed at the top of the question numer pattern will update you on remaining time to complete the exam. When the clock reached to 0 the exam will automatically close and it will display the report page where you can find all the correct and wrong question along with total marks.</li>
											<li>The question number box at the right side of the screen represents one of the below status. Initially it is in black color when starting of the exam. Red color indicates not attempted or skipped questions; Black color indicates not visited questions. Green color indicates attempted questions.</li>
											<li>All twenty (20) questions are multiple choices. You can navigate to any question by clicking the question number at the right side. It will navigate to respective question. By clicking next option you can see upcoming question. If you want to see answer for any question instance click on view answer at the same way click solution for explanation.</li>
											<li>The weight age for each question is 1(one) mark. Penalty for wrong answer is 0.25. No negative marks for skipped questions or un attempted questions. To complete the test click on END TEST button. Do not refresh the page while writing the exam. For any assist please contact admin by dropping a mail which is available at contact us page. All the best. Keep visiting our website for new updates. Thanks.</li>
										</ul>

										</p>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12">
										<center><a href="/index.php/test_details/{!! $id !!}"  type="button" class="btn btn1 href1 " >Start test..</a></center>

										{{--onClick="return popup(this, 'notes')"--}}
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
@stop