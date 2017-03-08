@extends('layouts.page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2 "></div>
        <div class="col-lg-6 col-md-8">
            <div class="account-wall" style="margin-top:15%">
                <div id="my-tab-content" class="tab-content">

                  <div class="tab-pane active" id="login">
                  

                    <div class="text-center">
                          
                          <p class="text-center">Select college and click download</p>
                          
                            
                         </div>

                    <div class="row">
                              <form class="form" action="/index.php/download_record" method="post">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8 col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-4 ">
                                  
                                <fieldset>
                                      <div class="form-group">
                                        <select class="form-control college_download multiselect" name="college_id">
										<option selected disabled value="">Select the college</option>
										@foreach($college_list as $cl_k => $cl_v)
										<option value="{{ $cl_k }}">{{ $cl_v }}</option>
										@endforeach
										</select>
                                    
                                      </div>
                                  
                                </fieldset>
                             
                                </div>
                                
                                <div class="col-sm-2"></div>

                                <div class="clearfix"></div>

                                <div class="row">
                                  <div class="col-xs-2"></div>
                                  <div class="col-xs-8">
									<div class="form-group">
                                    <input class="btn btn-warning pull-right" value="Download" type="submit">
									</div>
								  </div>
                                  <div class="col-xs-2"></div>
                                </div>    

                              </form>

                              @if($errors->any())
                                  <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                  </ul> 

                                  @endif

                              
                              </div>
                  

                  </div>



                </div>


            </div>
        </div>
        <div class="col-lg-6 col-md-2 "></div>
    </div>
</div>

@stop