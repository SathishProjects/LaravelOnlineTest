@extends('layouts.test_page')
@section('content')

    <style>
        body {
            line-height: 1.42857;
            background: #333333;
            height: 350px;
            padding: 0;
            margin: 0;
        }
        .nav-tabs.nav-justified {
            border-bottom: 0 none;
            width: 100%;
        }
        .nav-tabs.nav-justified > li {
            display: table-cell;
            width: 1%;
            float: none;
        }
		.dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus {
    background-color: #e5e5e5!important;
    color: black !important;
}
    </style>

    <div class="homecontainer">

        <div class="login-body">
            <article class="container-login center-block">
			
			<div class="stepwizard" style="visibility:hidden">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Step 2</p>
        </div>
        @if(in_array(1,$details['other_degree']) || $details['selected_degree'] == 1)
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 3</p>
        </div>
        @endif

        @if(in_array(26,$details['other_degree']) || $details['selected_degree'] == 26)
		<div class="stepwizard-step">
            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 4</p>
        </div>
        @endif

         @if(in_array(20,$details['other_degree']) || $details['selected_degree'] == 20)
		<div class="stepwizard-step">
            <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 5</p>
        </div>
        @endif

         @if(in_array(21,$details['other_degree']) || $details['selected_degree'] == 21)
		<div class="stepwizard-step">
            <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 6</p>
        </div>
        @endif

		<div class="stepwizard-step">
            <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 7</p>
        </div>

        <div class="stepwizard-step">
            <a href="#step-8" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 8</p>
        </div>
		
    </div>
</div>
                <section>
                    

                    <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                       
<form action="/index.php/submit_signup" method="post" accept-charset="utf-8" autocomplete="off" role="form" class="submit_signup">
    <input type="hidden" value="{{ $details['test_id'] }}" name="test_id" />
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
				<center><h3>Candidate Signup</h3></center>
                <div class="row">
                                    <center><h4>Personal Details</h4></center>
                                    
									
                                        <div class="col-md-12">
                                            <div class="row"></div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
												    <label class="control-label">First name <span class="note">*</span></label>
                                                    {!! Form::text('first_name',null, array('class' => 'form-control','style' => 'text-transform:uppercase','placeholder' => 'First Name','required')) !!}

                                                </div> </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
												
												<div class="form-group">
												    
                                                    <label class="control-label">Last name / initial <span class="note">*</span></label>
                                                    {!! Form::text('last_name',null, array('class' => 'form-control','style' => 'text-transform:uppercase','required' => 'required','placeholder' => 'Last Name / Initial')) !!}



                                                </div> </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-lg-6 col-md-6 col-sm-6"> 
												    <div class="form-group">
                                                        <label class="control-label">Gender <span class="note">*</span></label>
                                                            <select class="form-control multiselect" id="gender" name="gender" required="required">
                                                                <option selected disabled value="">Select gender</option>
                                                                <option>Male</option>
                                                                <option>Female</option>
                                                            </select>
                                                    </div> 
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6"> 
                                                 <div class="form-group">
												 
                                                 <label class="control-label">Email address <span class="note">*</span></label>
                                                 {!! Form::text('email', $details['email'] , array('class' => 'form-control','required')) !!}


                                                </div> </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
												
												<div class="form-group">
												
                                                        <label class="control-label">Date of Birth <span class="note">*</span></label>
														<input type="text" class="form-control Date_of_Birth" placeholder="Date of Birth" id="Date_of_Birth" name="date_of_birth" required="required" />
														<span class="note">( Format: yyyy-mm-dd )</span>	
                                                </div> </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
												
												<div class="form-group">
												    <label class="control-label">Mobile number <span class="note">*</span></label>
                                                    <input type="text" name="mobile" class ='form-control' placeholder = 'mobile' required="required"/>


                                                </div> </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span class="note mandatory" hidden>* Provide all required fields to proceed next step</span>
                                                </div>
                                            </div>


                                        </div>
										
                                    
                                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right spl_button" type="button" >Next <i class="fa fa-hand-o-right"></i></button>
            </div>
        </div>
    
	</div>
   
	<div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
				<center><h3>Candidate Signup</h3></center>
                <div class="row">
                                    <center><h4>SSLC Details</h4></center>
                                    
                                        <div class="col-md-12">
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">School / Institution Name<span class="note">*</span></label>
												 {!! Form::text('SSLC_institution',null, array('class' => 'form-control','required' => 'required','placeholder' => 'School / Institution Name')) !!}

                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">

                                                <div class="form-group">
                                                        <label class="control-label">Board <span class="note">*</span></label>
                                                            <select class="form-control multiselect" name="SSLC_course" required="required">
                                                                <option selected disabled value="">Select Board</option>
                                                                <optgroup value="" class="optgry" label="-----All India-----"></optgroup><option value="1">CBSE</option><option value="2">CISCE(ICSE/ISE)</option><option value="3">National Open School</option><optgroup value="" class="optgry" label="-----State Boards-----"></optgroup><option value="4">Andhra Pradesh</option><option value="5">Assam</option><option value="6">Bihar</option><option value="7">Goa</option><option value="8">Gujarat</option><option value="9">Haryana</option><option value="10">Himachal Pradesh</option><option value="11">J &amp; K</option><option value="12">Karnataka</option><option value="13">Kerala</option><option value="14">Maharashtra</option><option value="15">Madhya Pradesh</option><option value="16">Manipur</option><option value="17">Meghalaya</option><option value="18">Mizoram</option><option value="19">Nagaland</option><option value="20">Orissa</option><option value="21">Punjab</option><option value="22">Rajasthan</option><option value="23">Tamil Nadu</option><option value="24">Tripura</option><option value="25">Uttar Pradesh</option><option value="26">West Bengal</option>
                                                            </select>
															<span class="note" style=" font-size: 12px;">( Matric. & State board students choose the State where studied )</span>	
                                                    </div> 
												
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 ">

                                                <div class="form-group">
                                                        <label class="control-label">Medium <span class="note">*</span></label>
                                                            <select class="form-control multiselect" name="SSLC_medium" required="required">
                                                                <option selected disabled value="">Select Medium</option>
                                                                @foreach($languge_details as $lkey => $lval)
                                                                    <option value="{{$lkey}}">{{ $lval }}</option>
                                                                @endforeach
                                                            </select>
                                                    </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                                  
                                                                    <div class="col-sm-6"> <div class="form-group">
                                                                        <label class="control-label">Marks ( in % )<span class="note">*</span></label>
                                                                        
                                                                        <input type="text" name="SSLC_percentage" class="form-control" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)" required = 'required' placeholder = 'Marks ( in % )'/>

                                                                    </div>
																	</div>
																	
                                                                    <div class="col-sm-6"> <div class="form-group">
                                                                       
                                                                            <label class="control-label">Year of passing<span class="note">*</span></label>
                                                                              <?php $now = date("Y"); $date1 = $now-15;$date2 = $now; ?>    <?php $years = range($date2,$date1) ?>

                                        <select class="form-control multiselect SSLC_year_of_completion" name="SSLC_year_of_completion" required="required">
                                                                <option selected disabled value="">Select Year of passing</option>
                                                                @foreach($years as $year)
                                                     <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                                            </select>
                                                                    </div></div>
                                                                </div>
                                            
                                        </div>
										
                                    
                                </div>
                                <div class="row">
                                                <div class="col-md-12">
                                                    <span class="note mandatory" hidden>* Provide all required fields to proceed next step</span>
                                                </div>
                                            </div>
                <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary prevBtn btn-lg pull-right spl_button spl_button1" type="button" ><i class="fa fa-hand-o-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right spl_button sslc" type="button" >Next <i class="fa fa-hand-o-right"></i></button>
                                </div>
                                </div>
            
            </div>
            
        </div>
    
	</div>
	
     @if(in_array(1,$details['other_degree']) || $details['selected_degree'] == 1)
	<div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
				<center><h3>Candidate Signup</h3></center>
                <div class="row">
                                    <center><h4>HSC Details</h4></center>
                                    
                                        <div class="col-md-12">
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">School / Institution Name <span class="note">*</span></label>
												 {!! Form::text('HSC_institution',null, array('class' => 'form-control','required' => 'required','placeholder' => 'School / Institution Name')) !!}

                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
                                                <label class="control-label">Board<span class="note">*</span></label>
												 <select name="HSC_course" class="form-control multiselect" required>
														<option value="" selected disabled>Select Board</option><optgroup value="" class="optgry" label="-----All India-----"></optgroup><option value="1">CBSE</option><option value="2">CISCE(ICSE/ISE)</option><option value="3">National Open School</option><optgroup value="" class="optgry" label="-----State Boards-----"></optgroup><option value="4">Andhra Pradesh</option><option value="5">Assam</option><option value="6">Bihar</option><option value="7">Goa</option><option value="8">Gujarat</option><option value="9">Haryana</option><option value="10">Himachal Pradesh</option><option value="11">J &amp; K</option><option value="12">Karnataka</option><option value="13">Kerala</option><option value="14">Maharashtra</option><option value="15">Madhya Pradesh</option><option value="16">Manipur</option><option value="17">Meghalaya</option><option value="18">Mizoram</option><option value="19">Nagaland</option><option value="20">Orissa</option><option value="21">Punjab</option><option value="22">Rajasthan</option><option value="23">Tamil Nadu</option><option value="24">Tripura</option><option value="25">Uttar Pradesh</option><option value="26">West Bengal</option><option value="99999">Other</option>                                    
												 </select>
												 <span class="note" style=" font-size: 12px;">( Matric. & State board students choose the State where studied )</span>	
                                                </div> 
												
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
												 <label class="control-label">Medium <span class="note">*</span></label>
                                                 <select class="form-control multiselect" name="HSC_medium" required>
                                                 <option selected disabled value="">Select Medium</option>
                                                     @foreach($languge_details as $lkey => $lval)
                                                     <option value="{{$lkey}}">{{ $lval }}</option>
                                                     @endforeach
                                                 </select>

                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                                  
                                                                    <div class="col-sm-6"> <div class="form-group">
                                                                    <label class="control-label">Marks ( in % ) <span class="note">*</span></label>
                                                                        
																		<input type="text" name="HSC_percentage" class="form-control" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)" required = 'required' placeholder = 'Marks ( in % )'/>

                                                                    </div>
																	</div>
																	
                                                                    <div class="col-sm-6"> <div class="form-group">
                                                                    <label class="control-label">Year of passing<span class="note">*</span></label>
                                                                      <?php $now = date("Y"); $date1 = $now-15;$date2 = $now; ?>    


                                        <?php $years = range($date2,$date1) ?>

                                        <select class="multiselect form-control HSC_year_of_completion" name="HSC_year_of_completion" required>
                                                    <option selected disabled value="">Select Year of passing</option>
                                                @foreach($years as $year)
                                                     <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                        </select>
                                                                    </div></div>
                                                                </div>
                                            
                                        </div>
										
                                    
                                </div>
        <div class="row">
            <div class="col-md-12">
                <span class="note mandatory" hidden>* Provide all required fields to proceed next step</span>
            </div>
        </div>
                <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary prevBtn btn-lg pull-right spl_button spl_button1" type="button" ><i class="fa fa-hand-o-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right spl_button hsc" type="button" >Next <i class="fa fa-hand-o-right"></i></button>
                                </div>
                                </div>
            </div>
        </div>

        
    
	</div>
    @endif
	
    @if(in_array(26,$details['other_degree']) || $details['selected_degree'] == 26)
	<div class="row setup-content" id="step-4">
        <div class="col-xs-12">
            <div class="col-md-12">
				<center><h3>Candidate Signup</h3></center>
                <div class="row">
                                    <center><h4>Diploma Details</h4></center>
                                    
                                        <div class="col-md-12">
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">College / Institution Name<span class="note"> *</span></label>
                                                @if($details['selected_degree'] == 26)
												 {!! Form::text('diploma1_institution',$selected_degree_details->college_name, array('class' => 'form-control','readonly' => 'readonly','required')) !!}

                                                 <input type="hidden" name="institution_id" class="institution_id" value="{{$selected_degree_details->college_id}}" />
                                                 @else
                                                 {!! Form::text('diploma1_institution',null, array('class' => 'form-control','required' => 'required','placeholder' => 'College / Institution Name')) !!}
                                                 @endif
                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
                                                <label class="control-label">Branch / Specialisation <span class="note"> *</span></label>
                                                 @if($details['selected_degree'] == 26)
												 <select name="diploma1_course_id" class="form-control multiselect" required>
														<option value="{{$selected_degree_details->branch_id}}">{{$selected_degree_details->branch_name}}</option>
												 </select>
                                                 @else
                                                 <select name="diploma1_course_id" class="form-control multiselect" required>
                                                        <option selected disabled value="">Select Specialisation</option>
                                                        @foreach($degree->diploma_branch as $dipkey => $dipval)
                                                        <option value="{{ $dipkey }}">{{$dipval}}</option>
                                                        @endforeach                                  
                                                 </select>
                                                 @endif
                                                </div> 
												
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
                                                <label class="control-label">Medium <span class="note"> *</span></label>
                                                 <select class="form-control multiselect" name="diploma1_medium" required>
                                                 <option selected disabled value="">Select Medium</option>
                                                     @foreach($languge_details as $lkey => $lval)
                                                     <option value="{{$lkey}}">{{ $lval }}</option>
                                                     @endforeach
                                                 </select>

                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                                  
                                                                    <div class="col-sm-6"> <div class="form-group">
                                                                    <label class="control-label">Marks ( in % ) <span class="note"> *</span></label>
                                                                        
                                                                        <input type="text" name="diploma1_percentage" class="form-control" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)" required = 'required' placeholder = 'Marks ( in % )'/>
																		<span class="note" style=" font-size: 12px;"> ( For Grading system provide marks out of 100 ) </span>	
                                                                    </div>
																	</div>
																	
                                                                    <div class="col-sm-6"> <div class="form-group">
                                                                      <label class="control-label">Year of passing <span class="note"> *</span></label>

                                         @if($details['selected_degree'] == 26)  
                                                <select class="multiselect form-control diploma1_year_of_completion" name="diploma1_year_of_completion">
                                                    <option selected value="{{$details['year']}}">{{$details['year']}}</option>
                                                </select>
                                                @else
                                                
                                                <?php $now = date("Y"); $date1 = $now-15;$date2 = $now; ?><?php $years = range($date2,$date1) ?>

                                                <select class="multiselect form-control diploma1_year_of_completion" name="diploma1_year_of_completion" required>
                                                    <option selected disabled value="">Select Year of passing</option>
                                                    @foreach($years as $year)
                                                         <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                                                    </div></div>
                                                                </div>
                                            
                                        </div>
										
                                    
                                </div>
                                        <div class="row">
            <div class="col-md-12">
                @if($details['selected_degree'] == 26) 
                <span class="note">* Make sure you are eligible with above default criteria.</span><br>
            @endif    
                <span class="note mandatory" hidden>* Provide all required fields to proceed next step</span>
            </div>
        </div>
                <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary prevBtn btn-lg pull-right spl_button spl_button1" type="button" ><i class="fa fa-hand-o-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right spl_button diploma" type="button" >Next <i class="fa fa-hand-o-right"></i></button>
                                </div>
                                </div>
            </div>
        </div>
	</div>
    @endif
	
    @if(in_array(20,$details['other_degree']) || $details['selected_degree'] == 20)
	<div class="row setup-content" id="step-5">
        <div class="col-xs-12">
            <div class="col-md-12">
				<center><h3>Candidate Signup</h3></center>
                <div class="row">
                                    <center><h4>UG Details</h4></center>
                                    
                                        <div class="col-md-12">
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">College / Institution Name <span class="note"> *</span></label>
                                                @if($details['selected_degree'] == 20)
											
												 <select class="form-control multiselect get_institution_id" name="UG1_institution" required>
													 <option selected disabled value="">Select your college</option> 
													 @foreach($selected_degree_details->college_list as $sdkey => $sdval)
                                                     <option value="{{ $sdval->name }}" institution_id="{{ $sdval->id }}" university_id="{{ $sdval->university_id }}">{{ $sdval->name }}</option>
                                                     @endforeach
													 
														 <option value="99999"> Other(s)</option> 
													
                                                 </select>
												<span class="get_new_institution"></span>
                                                 <input type="hidden" name="institution_id" class="set_institution_id"/>
												 <input type="hidden" name="UG1_university" class="set_UG1_university"/>
                                                 @else
                                                    {!! Form::text('UG1_institution',null, array('class' => 'form-control','required' => 'required','placeholder' => 'College / Institution Name')) !!}
                                                 @endif
                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												
												@if($details['selected_degree'] != 20)  
													<div class="form-group">
												  <label class="control-label">University of Accreditation <span class="note"> *</span></label>			
													<select class="form-control multiselect" name="UG1_university" required>
														<option selected disabled value="">Select University of accreditation</option>
															@foreach($university_details as $ukey => $uval)
																<option value="{{$ukey}}">{{ $uval }}</option>
															@endforeach
													</select>
													</div> 
                                                 @endif

                                                
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
                                                <label class="control-label">Degree <span class="note"> *</span></label>
                                                @if($details['selected_degree'] == 20)    
												 <select class="form-control multiselect" required>
													
													@foreach($selected_degree_details->degree_list as $dlkey => $dlval)
														<option value="{{ $dlkey }}">{{ $dlval }}</option>
                                                     @endforeach                              
												 </select>
                                                 @else
                                                    <select class="form-control multiselect ug_degree_id" required>
                                                        <option value="" selected disabled>Select Degree</option>
                                                        @foreach($degree->ug as $ugkey => $ugval)
                                                        <option value="{{ $ugkey }}">{{$ugval}}</option>
                                                        @endforeach                                   
                                                    </select>
                                                 @endif
                                                </div> 
												
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
                                                <label class="control-label">Branch <span class="note"> *</span></label>
                                                @if($details['selected_degree'] == 20)    
												 <select name="UG1_course_id" class="form-control multiselect" required>
														
														@foreach($selected_degree_details->branch_list as $brkey => $brval)
														<option value="{{ $brval->id }}" degree_subtype_id="{{ $brval->degree_subtype_id }}">{{ $brval->name }}</option>
														@endforeach                         
												 </select>
                                                 @else
                                                 <select name="UG1_course_id" class="form-control multiselect ug_branch_id" disabled required>
                                                        <option value="" selected disabled>Select Branch</option>                                
                                                 </select>
                                                 @endif
                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                                  
                                                                    <div class="col-sm-6"> <div class="form-group">
                                                                        <label class="control-label">Medium <span class="note"> *</span></label>
                                                                         <select class="form-control multiselect" name="UG1_medium" required>
                                                                         <option selected disabled value="">Select Medium</option>
                                                     @foreach($languge_details as $lkey => $lval)
                                                     <option value="{{$lkey}}">{{ $lval }}</option>
                                                     @endforeach
                                                 </select>

                                                                    </div>
																	</div>
																	<div class="col-sm-6"> <div class="form-group">
                                                                    <label class="control-label">Marks ( in % ) <span class="note"> *</span></label>
                                                                        
                                                                        <input type="text" name="UG1_percentage" class="form-control" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)" required = 'required' placeholder = 'Marks ( in % )'/>
																		<span class="note" style=" font-size: 12px;"> ( For Grading system provide marks out of 100 ) </span>	

                                                                    </div>
																	</div>
                                                                </div>
											<div class="row">
											<div class="col-sm-12"> <div class="form-group">
                                                <label class="control-label">Year of passing <span class="note"> *</span></label>                                                                       
                                                @if($details['selected_degree'] == 20)  
                                                <select class="multiselect form-control UG1_year_of_completion" name="UG1_year_of_completion" required>
													<option value="" selected disabled>Select year of passing</option>
                                                     @foreach($details['year'] as $year)
                                                         <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                
                                                <?php $now = date("Y"); $date1 = $now-15;$date2 = $now; ?><?php $years = range($date2,$date1) ?>

                                                <select class="multiselect form-control UG1_year_of_completion" name="UG1_year_of_completion" required>
                                                    <option selected disabled value="">Select Year of passing</option>
                                                    @foreach($years as $year)
                                                         <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                                                    </div></div>
											</div>
                                            
                                        </div>
										
                                    
                                </div>
                                        <div class="row">
            <div class="col-md-12">
            @if($details['selected_degree'] == 20) 
                <span class="note">* Make sure you are eligible with above default criteria.</span><br>
            @endif    
                <span class="note mandatory" hidden>* Provide all required fields to proceed next step</span>
            </div>
        </div>
                <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary prevBtn btn-lg pull-right spl_button spl_button1" type="button" ><i class="fa fa-hand-o-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right spl_button ug" type="button" >Next <i class="fa fa-hand-o-right"></i></button>
                                </div>
                                </div>
            </div>
        </div>   
	</div>
    @endif
	
    @if(in_array(21,$details['other_degree']) || $details['selected_degree'] == 21)
	<div class="row setup-content" id="step-6">
        <div class="col-xs-12">
            <div class="col-md-12">
				<center><h3>Candidate Signup</h3></center>
                <div class="row">
                                    <center><h4>PG Details</h4></center>
                                    
                                        <div class="col-md-12">
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">College / Institution Name <span class="note"> *</span></label>
                                                @if($details['selected_degree'] == 21)
												 
												 <?php $allow_other_college = count($selected_degree_details->college_list) ?>
												 
												 <select class="form-control multiselect get_institution_id" name="PG1_institution" required>
												  <option selected disabled value="">Select your college</option> 
													 @foreach($selected_degree_details->college_list as $sdkey => $sdval)
                                                     <option value="{{ $sdval->name }}" institution_id="{{ $sdval->id }}" university_id="{{ $sdval->university_id }}">{{ $sdval->name }}</option>
                                                     @endforeach
													  @if($allow_other_college > 1)
														 <option value="99999"> Other(s)</option> 
													 @endif	
                                                 </select>
											 
												<span class="get_new_institution"></span>
												 
                                                 <input type="hidden" name="institution_id" class="set_institution_id"/>
												 <input type="hidden" name="PG1_university" class="set_PG1_university"/>
                                                 @else
                                                    {!! Form::text('PG1_institution',null, array('class' => 'form-control','required' => 'required','placeholder' => 'College / Institution Name')) !!}
                                                 @endif
                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												
												@if($details['selected_degree'] != 21)  
													<div class="form-group">
												  <label class="control-label">University of Accreditation <span class="note"> *</span></label>			
													<select class="form-control multiselect" name="PG1_university" required>
														<option selected disabled value="">Select University of accreditation</option>
															@foreach($university_details as $ukey => $uval)
																<option value="{{$ukey}}">{{ $uval }}</option>
															@endforeach
													</select>
													</div> 
                                                 @endif

                                                
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
                                                <label class="control-label">Degree <span class="note"> *</span></label>
                                                @if($details['selected_degree'] == 21)    
												 <select class="form-control multiselect" required>
													
													@foreach($selected_degree_details->degree_list as $dlkey => $dlval)
														<option value="{{ $dlkey }}">{{ $dlval }}</option>
                                                     @endforeach                              
												 </select>
                                                 @else
                                                    <select class="form-control multiselect pg_degree_id" required>
                                                        <option value="" selected disabled>Select Degree</option>
                                                        @foreach($degree->pg as $pgkey => $pgval)
                                                        <option value="{{ $pgkey }}">{{$pgval}}</option>
                                                        @endforeach                                   
                                                    </select>
                                                 @endif
                                                </div> 
												
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-6 ">
												
												<div class="form-group">
                                                <label class="control-label">Branch <span class="note"> *</span></label>
                                                @if($details['selected_degree'] == 21)    
												 <select name="PG1_course_id" class="form-control multiselect" required>
														
														@foreach($selected_degree_details->branch_list as $brkey => $brval)
														<option value="{{ $brval->id }}" degree_subtype_id="{{ $brval->degree_subtype_id }}">{{ $brval->name }}</option>
														@endforeach                         
												 </select>
                                                 @else
                                                 <select name="PG1_course_id" class="form-control multiselect pg_branch_id" disabled required>
                                                        <option value="" selected disabled>Select Branch</option>                                
                                                 </select>
                                                 @endif
                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                                  
                                                                    <div class="col-sm-6"> <div class="form-group">
                                                                        <label class="control-label">Medium <span class="note"> *</span></label>
                                                                         <select class="form-control multiselect" name="PG1_medium" required>
                                                                         <option selected disabled value="">Select Medium</option>
                                                     @foreach($languge_details as $lkey => $lval)
                                                     <option value="{{$lkey}}">{{ $lval }}</option>
                                                     @endforeach
                                                 </select>

                                                                    </div>
																	</div>
																	<div class="col-sm-6"> <div class="form-group">
                                                                    <label class="control-label">Marks ( in % ) <span class="note"> *</span></label>
                                                                        
                                                                        <input type="text" name="PG1_percentage" class="form-control" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)" required = 'required' placeholder = 'Marks ( in % )'/>
																		<span class="note" style=" font-size: 12px;"> ( For Grading system provide marks out of 100 ) </span>	

                                                                    </div>
																	</div>
                                                                </div>
											<div class="row">
											<div class="col-sm-12"> <div class="form-group">
                                                <label class="control-label">Year of passing <span class="note"> *</span></label>                                                                       
                                                @if($details['selected_degree'] == 21)  
                                                <select class="multiselect form-control PG1_year_of_completion" name="PG1_year_of_completion" required>
													<option value="" selected disabled>Select year of passing</option>
                                                     @foreach($details['year'] as $year)
                                                         <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                
                                                <?php $now = date("Y"); $date1 = $now-15;$date2 = $now; ?><?php $years = range($date2,$date1) ?>

                                                <select class="multiselect form-control PG1_year_of_completion" name="PG1_year_of_completion" required>
                                                    <option selected disabled value="">Select Year of passing</option>
                                                    @foreach($years as $year)
                                                         <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                                                    </div></div>
											</div>
                                            
                                        </div>
										
                                    
                                </div>
                                        <div class="row">
            <div class="col-md-12">
            @if($details['selected_degree'] == 21) 
                <span class="note">* Make sure you are eligible with above default criteria.</span><br>
            @endif    
                <span class="note mandatory" hidden>* Provide all required fields to proceed next step</span>
            </div>
        </div>
                <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary prevBtn btn-lg pull-right spl_button spl_button1" type="button" ><i class="fa fa-hand-o-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right spl_button pg" type="button" >Next <i class="fa fa-hand-o-right"></i></button>
                                </div>
                                </div>
            </div>
        </div>   
	</div>
    
	@endif
	
	<div class="row setup-content" id="step-7">
        <div class="col-xs-12">
            <div class="col-md-12">
				<center><h3>Candidate Signup</h3></center>
                <div class="row">
                                    <center><h4>Career Interests</h4></center>
                                    
                                        <div class="col-md-12">
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">Career Interest <span class="note"> * </span></label>
												 
                                   <select class="form-control multiselect" id="career_interest" name="career_interest[]"  multiple="multiple" required>
                                   <option value="IT,Software Services">IT,Software Services</option>
                                   <option value="ITES/BPO">ITES/BPO</option>
                                   <option value="Core Engg">Core Engg</option>
                                   <option value="Banking/Finance">Banking/Finance</option>
                                   <option value="Telecom">Telecom</option>
                                   <option value="Automobiles">Automobiles</option>
                                   <option value="Marketing">Marketing</option>
                                   <option value="Others">Others</option>
                                   </select>
									<span class="note">( Can select multiple career interest )</span>
                                                </div> 
												
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">Mode of Work<span class="note"> *</span></label>
												 <select class="form-control multiselect" id="work_mode" name="work_mode" required>
                                   <option selected disabled value="">Select Mode of Work</option>
                                   <option value="1">Full Time</option>
                                   <option value="2">Part Time</option>
								   <option value="3">Internship</option>
                                   </select>
                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">Availablity <span class="note"> *</span></label>
												 <select class="form-control multiselect" id="work_month" name="work_month" required>
                                           <option selected disabled value="">Select your availability </option>
                                           <option value="1">Available immediately</option>
                                           <option value="2">After passing out</option>
                                           </select>
										   <span class="note">( Select when will you availabile to join )</span>

                                                </div> 
												
												</div>
												
                                                
											</div>
											
											<div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
												
												<div class="form-group">
                                                <label class="control-label">Preferred Job location <span class="note"> *</span></label>
												 <select class="form-control multiselect" id="preferred_location" name="preferred_location" required>
													<option selected disabled value="">Select Preferred location</option>
																						
												<option value="8">Ahmadabad</option>
							
																					
												<option value="12">Anywhere in india</option>
							
																					
												<option value="2">Banglore</option>
							
																					
												<option value="1">Chennai</option>
							
																					
												<option value="13">Coimbatore</option>
							
																					
												<option value="16">Erode</option>
							
																					
												<option value="3">Hyderabad</option>
							
																					
												<option value="11">Jaipur</option>
							
																					
												<option value="7">Kolkatta</option>
							
																					
												<option value="15">Kuppam</option>
							
																					
												<option value="17">Madurai</option>
							
																					
												<option value="5">Mumbai</option>
							
																					
												<option value="6">New Delhi</option>
							
																					
												<option value="9">Pune</option>
							
																					
												<option value="10">Surat</option>
							
																					
												<option value="18">Trichy</option>
							
																					
												<option value="4">Trivandrum</option>
							
																					
												<option value="19">Virudhunagar</option>
							
																					
												<option value="14">Vishakapatnam</option>
							
												 
												</select>

                                                </div> 
												
												</div>
												
                                                
											</div>
											
											
											
											
                                        </div>
										
                                    
                                </div>

                                        <div class="row">
            <div class="col-md-12">
                <span class="note mandatory" hidden>* Provide all required fields to proceed next step</span>
            </div>
        </div>
                

                <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary prevBtn btn-lg pull-right spl_button spl_button1" type="button" ><i class="fa fa-hand-o-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right spl_button" type="button">Next <i class="fa fa-hand-o-right"></i></button>
                                </div>
                                </div>

            </div>
        </div>
    
	</div>

    <div class="row setup-content" id="step-8">
        <div class="col-xs-12">
            
            <div class="col-md-12">
                <center><h3>Candidate Signup</h3></center>
            
            </div>
            <br><br><br><br><br>
            <div class="row">
                <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="form-group">
                                
                    <input type="checkbox" checked id="TermsOfService" class="TermsOfService" style="margin-left: 0px !important">
                        <span id="terms-of-service-label">
                            <b>&nbsp;&nbsp;&nbsp;I agree to the first.jobs <a style="color: #FF8C00;" target="_blank" id="TosLink" href="http://www.first.jobs/index.php/auth/terms&condition">Terms of Service</a> and <br>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #FF8C00;" target="_blank" id="PrivacyLink" href="http://www.first.jobs/index.php/privacy&policy">Privacy Policy</a></b>
                        </span>
  
                    </div>
                </div>
                </div>
            </div>
                

                <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary prevBtn btn-lg pull-right spl_button spl_button1" type="button" ><i class="fa fa-hand-o-left"></i> Back</button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right spl_button submit_btn" type="submit" disabled><i class="fa fa-sign-in"></i> Submit</button>
                                </div>
                </div>

            </div>
    </div>
    
    </div>
	
	</form><br>
                    </div>
                </section>
            </article>
        
		</div>



    </div>

@stop