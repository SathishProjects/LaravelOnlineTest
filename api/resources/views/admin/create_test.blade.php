@extends('layouts.page')
@section('content')
<div class="homecontainer container">
<div class="container">

<form role="form" action="/index.php/admin/set_test" id="createtest" name="createtest"  method="post">
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
												<input type="text" name="title" class="form-control" id="title" placeholder="Title">
											</div>
											<div class="form-group">
												<label for="title">Instructions:</label>
												<textarea class="form-control editable" name="terms_conditions" placeholder="Instructions" id="Instructions" rows="5" ></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="pwd">Test User: </label>
												<input type="text" name="test_user" class="form-control"  placeholder="User Name">
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="pwd">Test manager Password : </label>
												<input type="password" name="test_password" class="form-control" id="pwd" placeholder="Test Password">
											</div>
										</div>

									</div>

									<div class="row">

										<div class="col-md-6">
											<label class="checkbox-inline"><input type="checkbox" name="is_question_random" value="1">Randomize question order</label>
										</div>
										<div class="col-md-6">
											<label class="checkbox-inline"><input type="checkbox" name="is_option_random" value="1">Randomize options order</label>
										</div>

									</div>
									<center>

										<button class="btn btn1 nextBtn" type="submit" >Next</button>
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