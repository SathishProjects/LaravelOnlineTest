@extends('layouts.page')
@section('content')
<div class="homecontainer container">
<div class="container">

<form role="form" action="/index.php/{!! $details->test_id !!}/admin/updatetest" id="edittest" name="edittest"  method="post">
	<div class="col-xs-12">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="panel-group panel-group1" id="accordion">
						<div class="panel panel-default">

							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="title">Test Title:</label>
												<input type="hidden" name="test_id" value="{!! $details->test_id !!}">
												<input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{!! $details->title !!}">
											</div>
											<div class="form-group">
												<label for="title">Instructions:</label>
												<textarea class="form-control editable" name="terms_conditions" placeholder="Instructions" id="Instructions" rows="5" >{!! $details->terms_conditions !!}</textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="pwd">Test User : </label>
												<input type="text" name="test_user" class="form-control"  placeholder="User Name" value="{!! $details->test_user !!}">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="pwd">Test manager Password : </label>
												<input type="password" name="test_password" class="form-control" id="pwd" placeholder="Password" value="{!! $details->test_password !!}">
											</div>
										</div>

									</div>

									<div class="row">

										<div class="col-md-6">
											<label class="checkbox-inline">
												@if($details->is_question_random)
												<input type="checkbox" name="is_question_random" value="1" checked>
												@else
													<input type="checkbox" name="is_question_random" value="1">
												@endif

												Randomize question order</label>
										</div>
										<div class="col-md-6">
											<label class="checkbox-inline">
												@if($details->is_option_random)
													<input type="checkbox" name="is_option_random" value="1" checked>
												@else
													<input type="checkbox" name="is_option_random" value="1">
												@endif

												Randomize options order</label>
										</div>

									</div>
									<center>
										<input type="hidden" name="action_page" value="2">
										<button class="btn btn1 nextBtn" type="submit">Next</button>
										<button class="btn btn2 nextBtn" type="reset" >Reset</button>
									</center>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-md-2"></div>
			</div>



		</div>
	</div>
</form>

</div>
</div>
</div>
</div>
</div>

@stop