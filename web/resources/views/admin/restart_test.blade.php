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
										<h5>Read the below instructions carefully before starting the test .</h5>
										<ol>
											<li>Total duration of the exam is : {!! $testdetails->duration !!} minutes ( <?php echo round($testdetails->duration / 60,1); ?> hour(s) ).</li>
											<li>The question palette displayed on the right side of the screen will show current status of the question.</li>
											
											<div class="row">
										<div class="col-md-12">
											<button class="btn btn-success btn-circle"></button> You have answered the question
										</div>
										<div class="col-md-12">
											<button class="btn btn-danger btn-circle"></button> You have not answered the question yet
										</div>
										<div class="col-md-12">
											<button class="btn btn-circle btn-default" style="border: 3px solid blue;padding: 0px;"></button> Current active question
										</div>
										</div>
										
										</ol>
									
										</p>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12">
										<label>Navigating to a Question :  </label>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12">
										<p>
										<ol start="3">
											<li>To answer a Question , Do the following :
												<ol type="a">
													<li>Click on the question number in the Question palette to go to that question directly</li>
													<li>Click on <b> Save / Next </b> button to save your answer to the current question and goto the next question</li>
													<li><span class="note"> Note : Your Answer to the current question will not be saved , if you navigate to another question directly by clicking on its question number </span></li>
												</ol>
											</li>
										</ol>
									
										</p>
									</div>
								</div>

								
								<div class="row">
									<div class="col-xs-12">
										<center>
										<input type="checkbox" class="terms"/> I have read and understood the instructions .
										<br>
												<a href="/index.php/restart_test/{!! $id !!}/{!! $reappear_id !!}" onClick="return popup(this, 'notes')"  type="button" class="btn btn1 href1 terms_btn" disabled>Continue test..</a>
										</center>

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