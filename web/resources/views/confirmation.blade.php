@extends('layouts.test_page')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2 "></div>
        <div class="col-lg-6 col-md-8">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">

                  <div class="tab-pane active" id="login">
                  
                    <center>

                  

                  <h3 class="text-danger">{{$batch_details->college_name}}</h3>

                  <h5 class="text-danger"> {{$batch_details->degree_subtype_name}} - {{$batch_details->course_name}} ( {{$batch_details->batch_year}} - {{$batch_details->batch_year_to}} ) </h5>

                  </center> 
                                    
                  
                   {!! Form::open(['url' => 'student/register', 'class' => 'student_qualification', 'id' => 'student_qualification', 'name' => 'student_qualification' ]) !!}

                  <input type="hidden" value="{{$batch_details->college_id}}" name="college_id">
                  <input type="hidden" value="{{$batch_details->college_name}}" name="college_name">

                  <input type="hidden" value="{{$batch_details->batch_degree}}" name="batch_degree">
                  <input type="hidden" value="{{$batch_details->degree_subtype_name}}" name="degree_subtype_name">

                  <input type="hidden" value="{{$batch_details->batch_branch}}" name="batch_branch">
                  <input type="hidden" value="{{$batch_details->course_name}}" name="course_name">


                  <input type="hidden" value="{{$batch_details->batch_year_to}}" name="batch_year_to">
                  <input type="hidden" value="{{$batch_details->batch_type}}" name="batch_type">                  

                  <div class="form-group ">
                                    
                  <div class="row">
                                        <div class="col-xs-2"></div>
                                        <div class="col-xs-10">
                                            <div class="checkbox"><label><input type="checkbox" name="qualification[]" class="qualification" value="1" checked onclick="return false;">SSLC</label></div>
                                        </div>
                    </div>
                                    <div class="row">
                                        <div class="col-xs-2"></div>
                                        <div class="col-xs-10">
                                            <div class="checkbox"><label><input type="checkbox" name="qualification[]" class="qualification" value="2">HSC</label></div>
                                        </div>
                    </div>

                                        
                                    <div class="row">
                                        <div class="col-xs-2"></div>
                                        <div class="col-xs-10">
                                            <div class="checkbox"><label><input type="checkbox" name="qualification[]" class="qualification" value="26">Diploma</label></div>
                                        </div>
                    </div>
                  
                                                        
                                    <div class="row">
                                        <div class="col-xs-2"></div>
                                        <div class="col-xs-10">
                                        @if($batch_details->batch_type != 26)
                                          <div class="checkbox"><label><input type="checkbox" name="qualification[]" class="qualification" value="20"  checked onclick="return false;">UG</label>
                                            </div>
                                        @else
                                            <div class="checkbox"><label><input type="checkbox" name="qualification[]" class="qualification" value="20">UG</label>
                                            </div>
                                        @endif    
                                        </div>
                    </div>

                                    
                                      
                                    <div class="row">
                                        <div class="col-xs-2"></div>
                                        <div class="col-xs-10">
                                        @if($batch_details->batch_type == 21)
                                        <div class="checkbox"><label><input type="checkbox" name="qualification[]" class="qualification" value="21"  checked onclick="return false;">PG</label></div>
                                        @else
                                            <div class="checkbox"><label><input type="checkbox" name="qualification[]" class="qualification" value="21">PG</label></div>
                                        @endif    
                                        </div>
                    </div>

                                    <div class="row">
                                      <div class="col-xs-10 col-xs-offset-2">
                                        <span class="note text-center">Check the courses you completed & currently pursuing </span>
                                      </div>
                                    </div>

                                    <div class="row">
                                  <div class="col-xs-4"></div>
                                  <div class="col-xs-4"></div>
                                  <div class="col-xs-4">
                                    <div class="form-group">
                                    <button type="button" class="btn btn-danger signup_btn" onclick="return false;">Next</button>
                                  </div>
                                  </div>
                                </div>

                                
                                                      

                                    
                        </div>

                         {!! Form::close() !!}

                        

                  </div>



                </div>


            </div>
        </div>
        <div class="col-lg-6 col-xs-2 "></div>
    </div>
</div>

@stop