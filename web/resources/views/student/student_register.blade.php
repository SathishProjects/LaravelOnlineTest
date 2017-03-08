@extends('layouts.layout_login')
@section('content')

<style type="text/css">
.account-wall {
    margin-top: 50px;
    padding: 15px;
    background-color: #ffffff;
    box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16);
}

</style>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2 "></div>
        <div class="col-lg-6 col-md-8">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">

                  <div class="tab-pane active" id="login">
                  
                    <center>

                  <a href="/"><img style="" class="image_responsive logo_response" src="/images/logo.png" alt="logo"/></a>
                 
                  </center> 

                  <div class="stepwizard" style="display: none;">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-danger btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Step 2</p>
        </div>

        

        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 3</p>
        </div>

        @if(in_array(2,$qualification) == 1)

         <div class="stepwizard-step">
            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>Step 4</p>
        </div>


        @endif

         @if(in_array(26,$qualification) == 1)

        <div class="stepwizard-step">
            <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>Step 5</p>
        </div>

        @endif

         @if(in_array(20,$qualification) == 1)
         @if($batch_details['batch_type'] != 26)

        <div class="stepwizard-step">
            <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>Step 6</p>
        </div>

        @endif
        @endif

        @if(in_array(21,$qualification) == 1)
        @if($batch_details['batch_type'] == 21)

        <div class="stepwizard-step">
            <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>Step 7</p>
        </div>

        @endif
        @endif

        <div class="stepwizard-step">
            <a href="#step-8" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>Step 8</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-9" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>Step 9</p>
        </div>
    </div>
</div> 


<div>
     {!! Form::open(['url' => 'student/submit_signup', 'class' => 'stud_signup', 'id' => 'stud_signup', 'name' => 'stud_signup' ]) !!}

     <input type="hidden" name="college_id" value="{{$college_id}}">
    
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3 class="text-center "> Personal Details </h3>
                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">First Name <span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Name" name="first_name" required />
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Last name<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Initial" name="last_name" required />
                      </div>
                  </div>

                  
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Gender <span class="note"> *</span></label>
                        <select class="form-control multiselect" name="gender" required>
                          <option selected disabled value="">Gender</option>
                          <option value="M">Male</option>
                          <option value="F">Female</option>
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Email<span class="note"> *</span></label>
                        <input class="form-control"  type="email" value="" placeholder="Email"  name="email" required />
                      </div>
                  </div>

                 
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                     <div class="form-group has-feedback">
                        <label class="control-label">Date of birth <span class="note"> *</span></label>
                        <input class="form-control datepicker1"  type="text"  value="" placeholder="Date of birth"  name="date_of_birth" required />
                        <span class="note">Foramt : dd-mm-yyyy</span>
                     </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                    <div class="form-group has-feedback">  
                        <label class="control-label">Mobile<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Mobile" name="mobile" required />
                    </div> 
                  </div>

                </div>
                <br>
                <div class="row">
                  <div class="col-lg-12"> 
                  <div class="form-group">
                  <button class="btn btn-danger nextBtn   btn-block" type="button" >Next</button>
                  </div></div></div>
            </div>
          </div></div>

    <div class="row setup-content" id="step-2">
          <div class="col-xs-12">
            <div class="col-md-12">
                <h3 class="text-center "> Location Details </h3>
                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Address 1 <span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Door no, Street name" name="address1" required />
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Address 2<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Village / Town / Area" name="address2" required />
                      </div>
                  </div>

                  
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Pincode <span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Pin code" name="pincode" required />
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      
                      <div class="form-group has-feedback">
                        <label class="control-label">State <span class="note"> *</span></label>
                        <select class="form-control multiselect state" name="state" required>
                           <option selected disabled value="">- Choose State -</option>
                                @foreach($state_records as $s_key => $s_val)
                                  <option value="{{ $s_key }}"> {{ $s_val }} </option>
                                @endforeach
                        </select>
                      </div>

                  </div>

                 
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                     

                                <div class="form-group has-feedback">
                        <label class="control-label">District <span class="note"> *</span></label>
                        <select class="form-control multiselect district" name="district" required disabled>
                           <option selected disabled value="">- Choose District -</option>
                        </select>
                      </div>
                     
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                  

                              <div class="form-group has-feedback">
                        <label class="control-label">City <span class="note"> *</span></label>
                        <select class="form-control multiselect city" name="city" required disabled>
                           <option selected disabled value="">- Choose City -</option>
                        </select>
                      </div>
                     
                  </div>

                </div>
                <br>
                <div class="row">
                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger prevBtn  btn-block" type="button" >Back</button>
                    </div>
                  </div>

                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger nextBtn  btn-block" type="button" >Next</button>
                    </div>
                  </div>
                </div>
            </div>
          </div></div>

    <div class="row setup-content" id="step-3">
          <div class="col-xs-12">
            <div class="col-md-12">
                <h3 class="text-center "> SSLC Details </h3>
                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">School / Institution <span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="School / Institution name" name="sslc_school" required />
                      </div>
                  </div>


                  
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Board <span class="note"> *</span></label>
                        <select class="form-control multiselect sslc_board" name="sslc_board" id="sslc_board" required>
                                <option selected disabled value="">- Choose Board -</option>
                                
                                <optgroup label="-- ALL INDIA --">
                                @foreach($board_records as $b_key => $b_val)
                                  @if($b_key <= 3)
                                  <option value="{{ $b_key }}"> {{ $b_val }} </option>
                                  @endif
                                @endforeach
                                </optgroup>

                                <optgroup label="-- STATE BOARDS --">
                                @foreach($board_records as $b_key => $b_val)
                                  @if($b_key > 3)
                                  <option value="{{ $b_key }}"> {{ $b_val }} </option>
                                  @endif
                                @endforeach
                                </optgroup>  
                                
                              </select>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Medium<span class="note"> *</span></label>
                        <select class="form-control multiselect sslc_medium" name="sslc_medium" id="sslc_medium" required>
                                <option selected disabled value="">- Choose Medium -</option>
                                @foreach($medium_records as $m_key => $m_val)
                                  <option value="{{ $m_key }}"> {{ $m_val }} </option>
                                @endforeach
                                
                              </select>
                      </div>
                  </div>

                 
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                     <div class="form-group has-feedback">
                        <label class="control-label">Marks ( in % )<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Marks" name="sslc_marks" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)"  required/>
                     </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      
                       <div class="form-group has-feedback">
                        <label class="control-label">Year of passing<span class="note"> *</span></label>
                        
                        <?php $now = date("Y"); $date1 = $now-15;$date2 = $now; ?>    <?php $years = range($date2,$date1) ?>

                        <select class="form-control multiselect sslc_year" name="sslc_year" required>
                          <option selected disabled value="">- Choose Year -</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                       </div>   

                     
                  </div>

                </div>
                <br>
                <div class="row">
                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger prevBtn  btn-block" type="button" >Back</button>
                    </div>
                  </div>

                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger nextBtn  btn-block" type="button" >Next</button>
                    </div>
                  </div>
                </div>
            </div>
          </div></div>

     @if(in_array(2,$qualification) == 1)      

    <div class="row setup-content" id="step-4">
          <div class="col-xs-12">
            <div class="col-md-12">
                <h3 class="text-center "> HSC Details </h3>
                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">School / Institution <span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="School / Institution name" name="hsc_school" required/>
                      </div>
                  </div>


                  
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      
                      <div class="form-group has-feedback">
                        <label class="control-label">Board<span class="note"> *</span></label>
                        
                        <select class="form-control multiselect hsc_board" name="hsc_board" required>
                          <option selected disabled value="">- Choose Board -</option>
                             <optgroup label="-- ALL INDIA --">
                                @foreach($board_records as $b_key => $b_val)
                                  @if($b_key <= 3)
                                  <option value="{{ $b_key }}"> {{ $b_val }} </option>
                                  @endif
                                @endforeach
                                </optgroup>

                                <optgroup label="-- STATE BOARDS --">
                                @foreach($board_records as $b_key => $b_val)
                                  @if($b_key > 3)
                                  <option value="{{ $b_key }}"> {{ $b_val }} </option>
                                  @endif
                                @endforeach
                                </optgroup>  
                        </select>
                     </div>

                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Medium<span class="note"> *</span></label>
                        
                        <select class="form-control multiselect hsc_medium" name="hsc_medium" required>
                          <option selected disabled value="">- Choose Medium -</option>
                             @foreach($medium_records as $m_key => $m_val)
                                  <option value="{{ $m_key }}"> {{ $m_val }} </option>
                                @endforeach
                        </select>
                     </div>

                  </div>
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                     <div class="form-group has-feedback">
                        <label class="control-label">Marks ( in % )<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Marks" name="hsc_marks" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)"  required/>
                     </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Year of passing<span class="note"> *</span></label>
                        
                        <select class="form-control multiselect hsc_year" name="hsc_year" required>
                          <option selected disabled value="">- Choose Year -</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                     </div>
                  </div>

                </div>

                <br>
                <div class="row">
                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger prevBtn  btn-block" type="button" >Back</button>
                    </div>
                  </div>

                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger nextBtn  btn-block hsc" type="button" >Next</button>
                    </div>
                  </div>
                </div>
            </div>
          </div></div>

     @endif     

     @if(in_array(26,$qualification) == 1)

    <div class="row setup-content" id="step-5">
          <div class="col-xs-12">
            <div class="col-md-12">
                <h3 class="text-center "> Diploma Details </h3>
                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">College / Institution <span class="note"> *</span></label>
                        <select class="form-control multiselect diploma_college" name="diploma_college" required>
                          <option selected disabled value="">- Select College / Institution -</option>

                            <option value="{{$college_id}}">{{$college_name}}</option>
                          
                          <option value="0">- Other (s) -</option>
                        </select>
                        <span class="note">Select - Other(s) - option if you can't find your college</span>
                      </div>
                  </div>


                  
                </div>

                <span class="new_diploma_college"></span>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Degree <span class="note"> *</span></label>
                        <select class="form-control multiselect" disabled>
                          <option selected disabled value="">Polytechnic</option>
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Branch<span class="note"> *</span></label>
                        <select class="form-control multiselect diploma_branch" class="diploma_branch" name="diploma_branch" required>
                          <option selected disabled value="">- Choose Branch -</option>
                          @foreach($degree_records->diploma as $db_key => $db_val)
                            <option value="{{ $db_key }}">{{ $db_val }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>

                 
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Medium<span class="note"> *</span></label>
                        <select class="form-control multiselect diploma_medium" name="diploma_medium" required>
                          <option selected disabled value="">- Choose Medium -</option>
                             @foreach($medium_records as $m_key => $m_val)
                                  <option value="{{ $m_key }}"> {{ $m_val }} </option>
                                @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Marks ( in % )<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" name="diploma_marks" placeholder="Marks" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)" required/>
                     </div>
                  </div>

                </div>

                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 

                  <br>
                     <div class="form-group has-feedback">
                        <label class="control-label">Year of Joining<span class="note"> *</span></label>
                        <select class="form-control multiselect diploma_year" name="diploma_year" required/>
                          <option selected disabled value="">- Choose Year -</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>

                        </div>
                     
                  </div>

                </div>

                <br>
                <div class="row">
                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger prevBtn  btn-block" type="button" >Back</button>
                    </div>
                  </div>

                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger nextBtn  btn-block diploma" type="button" >Next</button>
                    </div>
                  </div>
                </div>
            </div>
          </div></div>                  

     @endif          

     @if(in_array(20,$qualification) == 1)
     @if($batch_details['batch_type'] != 26)
      <div class="row setup-content" id="step-6">
          <div class="col-xs-12">
            <div class="col-md-12">
                <h3 class="text-center "> UG Details </h3>
                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">College / Institution <span class="note"> *</span></label>
                        <select class="form-control multiselect ug_college" name="ug_college" required>
                          
                          @if($batch_details['batch_type'] == 20)
                          <option value="{{$college_id}}" selected >{{$college_name}}</option>
                          @else
                          <option selected disabled value="">- Select College / Institution -</option>
                          <option value="{{$college_id}}" selected >{{$college_name}}</option>
                          <option value="0">- Other (s) -</option>
                          @endif
                        </select>
                        <span class="note">Select - Other(s) - option if you can't find your college</span>
                      </div>
                  </div>


                  
                </div>

                <span class="new_ug_college"></span>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Degree <span class="note"> *</span></label>
                        
                        <select class="form-control multiselect ug_degree" name="ug_degree" required>
                          @if($batch_details['batch_type'] == 20)
                            <option value="{{ $batch_details['batch_degree'] }}">{{ $batch_details['degree_subtype_name'] }}</option>
                          @else
                          <option selected disabled value="">- Choose Degree -</option>
                          @foreach($degree_records->ug as $ug_key => $ug_val)
                            <option value="{{ $ug_key }}">{{ $ug_val }}</option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Branch<span class="note"> *</span></label>
                        @if($batch_details['batch_type'] == 20)

                        <select class="form-control multiselect ug_branch" name="ug_branch" required>
                          <option value="{{ $batch_details['batch_branch'] }}">{{ $batch_details['course_name'] }}</option>
                        </select>
                            
                          @else
                        <select class="form-control multiselect ug_branch" name="ug_branch" disabled required>
                          <option selected disabled value="">- Choose Branch -</option>
                         
                        </select>
                        @endif
                      </div>
                  </div>

                 
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Medium<span class="note"> *</span></label>
                        
                        <select class="form-control multiselect ug_medium " name="ug_medium" required>
                              <option selected disabled value="">- Choose Medium -</option>
                              @foreach($medium_records as $m_key => $m_val)
                                  <option value="{{ $m_key }}"> {{ $m_val }} </option>
                                @endforeach
                        
                        </select>
                      </div>          
                             
                     
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                       <div class="form-group has-feedback">
                        <label class="control-label">Marks ( in % )<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Marks" name="ug_marks" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)"  required />
                      </div>
                  </div>

                </div>

                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                     <br>

                    <div class="form-group has-feedback">
                        <label class="control-label">Year of passing<span class="note"> *</span></label>
                         <select class="form-control multiselect ug_year" name="ug_year" required>
                           @if($batch_details['batch_type'] == 20)
                            <option value="{{ $batch_details['batch_year_to'] }}">{{ $batch_details['batch_year_to'] }}</option>
                           @else 
                          <option selected disabled value="">- Choose Year -</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div> 
                  </div>

                </div>

                <br>
                <div class="row">
                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger prevBtn  btn-block" type="button" >Back</button>
                    </div>
                  </div>

                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger nextBtn  btn-block ug" type="button" >Next</button>
                    </div>
                  </div>
                </div>
            </div>
          </div></div>                  
     @endif     
     @endif     

     @if(in_array(21,$qualification) == 1)
     @if($batch_details['batch_type'] == 21) 
    <div class="row setup-content" id="step-7">
          <div class="col-xs-12">
            <div class="col-md-12">
                <h3 class="text-center "> PG Details </h3>
                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">College / Institution <span class="note"> *</span></label>
                        <select class="form-control multiselect pg_college" name="pg_college" required>

                        @if($batch_details['batch_type'] == 21)
                          <option value="{{$college_id}}" selected="">{{$college_name}}</option>
                        @else
                          <option selected disabled value="">- Select College / Institution -</option>
                          <option value="{{$college_id}}" selected="">{{$college_name}}</option>
                          <option value="0">- Other (s) -</option>
                        @endif  
                        </select>
                        <span class="note">Select - Other(s) - option if you can't find your college</span>
                      </div>
                  </div>


                  
                </div>

                <span class="new_pg_college"></span>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Degree <span class="note"> *</span></label>
                        
                        <select class="form-control multiselect pg_degree" name="pg_degree" required>
                        @if($batch_details['batch_type'] == 21)
                          <option value="{{ $batch_details['batch_degree'] }}">{{ $batch_details['degree_subtype_name'] }}</option>
                        @else
                          <option selected disabled value="">- Choose Degree -</option>
                         @foreach($degree_records->pg as $pg_key => $pg_val)
                            <option value="{{ $pg_key }}">{{ $pg_val }}</option>
                          @endforeach
                        @endif
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Branch<span class="note"> *</span></label>
                       @if($batch_details['batch_type'] == 21)
                       <select class="form-control multiselect pg_branch" name="pg_branch" required>

                          <option selected value="{{ $batch_details['batch_branch']  }}">{{$batch_details['course_name'] }}</option>
                         
                        </select>
                       @else
                        <select class="form-control multiselect pg_branch" name="pg_branch" disabled required>

                          <option selected disabled value="">- Choose Branch -</option>
                         
                        </select>
                        @endif
                      </div>
                  </div>

                 
                </div>

                <div class="row">

                                                
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Medium<span class="note"> *</span></label>
                        
                        <select class="form-control multiselect pg_medium" name="pg_medium" required>
                          <option selected disabled value="">- Choose Medium -</option>
                         @foreach($medium_records as $m_key => $m_val)
                                  <option value="{{ $m_key }}"> {{ $m_val }} </option>
                                @endforeach
                        
                        </select>
                      </div>          
                             
                     
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                       <div class="form-group has-feedback">
                        <label class="control-label">Marks ( in % )<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Marks" name="pg_marks" step="0.1" pattern="(^(\+|\-)(0|([1-9][0-9]*))(\.[0-9]{1,2})?$)|(^(0{0,1}|([1-9][0-9]*))(\.[0-9]{1,2})?$)"  required />
                      </div>
                  </div>

                </div>

                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                     <br>

                    <div class="form-group has-feedback">
                        <label class="control-label">Year of Joining<span class="note"> *</span></label>
                         <select class="form-control multiselect pg_year" name="pg_year" required>
                            @if($batch_details['batch_type'] == 21)
                          <option selected value="{{ $batch_details['batch_year_to'] }}">{{ $batch_details['batch_year_to'] }}</option>
                          @else
                          <option selected disabled value="">- Choose Year -</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div> 
                  </div>

                </div>

                <br>
                <div class="row">
                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger prevBtn  btn-block" type="button" >Back</button>
                    </div>
                  </div>

                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger nextBtn  btn-block pg" type="button" >Next</button>
                    </div>
                  </div>
                </div>
            </div>
          </div></div>                  
    @endif 
    @endif          

    <div class="row setup-content" id="step-8">
          <div class="col-xs-12">
            <div class="col-md-12">
                <h3 class="text-center "> Career Interests </h3>
                
                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      
                        <div class="form-group">
                                                <label class="control-label">Career Interest <span class="note"> * </span></label>
                         
                                   <select class="form-control multiselect" id="career_interest" name="career_interest[]"  multiple="multiple" required>
                                   <option value="1">IT,Software Services</option>
                                   <option value="2">ITES/BPO</option>
                                   <option value="3">Core Engg</option>
                                   <option value="4">Banking/Finance</option>
                                   <option value="5">Telecom</option>
                                   <option value="6">Automobiles</option>
                                   <option value="7">Marketing</option>
                                   <option value="8">Others</option>
                                   </select>
                  <span class="note">( Can select multiple career interest )</span>
                                                </div> 
                  </div>


                  
                </div>

                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label"> Mode of Work  <span class="note"> *</span></label>
                        <select class="form-control multiselect work_mode" id="work_mode" name="work_mode" required>
                                   <option selected disabled value="">- Choose Mode of Work -</option>
                                   <option value="1">Full Time</option>
                                   <option value="2">Part Time</option>
                   <option value="3">Internship</option>
                                   </select>
                      </div>
                  </div>


                  
                </div>

                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label"> Availablity  <span class="note"> *</span></label>
                        <select class="form-control multiselect availability" id="availability" name="availability" required>
                                           <option selected disabled value="">- Choose Your Availability -</option>
                                           <option value="1">Available immediately</option>
                                           <option value="2">After passing out</option>
                                           </select>
                      </div>
                  </div>


                  
                </div>

                <div class="row">

                                                
                  <div class="col-lg-12 col-md-12 col-sm-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label"> Preferred Job location  <span class="note"> *</span></label>
                        <select class="form-control multiselect" id="preferred_location" name="preferred_location" required>
                          <option selected disabled value="">- Choose Preferred location - </option>
                                            
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

                <br>
                <div class="row">
                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger prevBtn  btn-block" type="button" >Back</button>
                    </div>
                  </div>

                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger nextBtn  btn-block" type="button" >Next</button>
                    </div>
                  </div>
                </div>
            </div>
          </div></div>

    <div class="row setup-content" id="step-9">
          <div class="col-xs-12">
            <div class="col-md-12">

            <br><br><br>

                <span class="text-center"><input type="checkbox" checked="" /></input> &nbsp;&nbsp; I agree to the college's <a href="javascript:void" target="_blank">Terms of Service</a> and <a href="javascript:void" target="_blank">Privacy Policy</a> </span>
                
                
                <br><br><br>
                <div class="row">
                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger prevBtn  btn-block" type="button" >Back</button>
                    </div>
                  </div>

                  <div class="col-xs-6"> 
                    <div class="form-group">
                      <button class="btn btn-danger nextBtn  btn-block" type="submit" >Sign up</button>
                    </div>
                  </div>
                </div>
            </div>
          </div></div>            

   

</form>
</div>
                      
                        

                  </div>



                </div>


            </div>
        </div>
        <div class="col-lg-6 col-xs-2 "></div>
    </div>
</div>

@stop