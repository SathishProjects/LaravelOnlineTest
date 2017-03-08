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
                  <!-- 
                    <center>

                  <a href="/"><img style="max-width: 280px;background-color: #98000e;" class="image_responsive logo_response" src="/images/logo.png" alt="logo"/></a>
                 
                  </center> --> 

                  <div class="stepwizard" style="display: none;">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-danger btn-circle">1</a>
            <p>Step 1</p>
        </div>
    </div>
</div> 


<div>
     {!! Form::open(['url' => 'college/submit_signup', 'class' => 'college_signup', 'id' => 'college_signup', 'name' => 'college_signup' ]) !!}
    
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h2 class="text-center text-danger"> College Signup </h2><br>
                
                <div class="row">
                <div class="col-xs-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">College Name <span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="" name="college_name" required />
                      </div>
                </div>
                </div>

                <div class="row">
                <div class="col-xs-12"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">University <span class="note"> *</span></label>
                        <select class="form-control multiselect" name="university">
                        <option selected="" disabled="" value="">- select -</option>
                          @foreach($university_records as $u_key => $u_val)
                          <option value="{{ $u_key }}"> {{ $u_val }} </option>
                          @endforeach
                        </select>
                      </div>
                </div>
                </div>

                <div class="row">
                        
                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Email<span class="note"> *</span></label>
                        <input class="form-control"  type="email" value="" placeholder="College official Email"  name="email" required />
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Phone<span class="note"> *</span></label>
                        <input class="form-control"  type="number" value="" placeholder="Offical / Contact person no."  name="phone" required />
                      </div>
                  </div>

                </div>

                <div class="row">
                        
                  

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">State<span class="note"> *</span></label>
                        <select class="form-control state multiselect" name="state">
                         <option selected="" disabled="" value="">- select -</option>
                          @foreach($state_records as $s_key => $s_val)
                          <option value="{{ $s_key }}"> {{ $s_val }} </option>
                          @endforeach
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">District<span class="note"> *</span></label>
                        <select class="form-control district multiselect" name="district">
                          <option selected="" disabled="" value="">- select -</option>
                        </select>
                      </div>
                  </div>
                  
                </div>

                <div class="row">

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">City<span class="note"> *</span></label>
                        <select class="form-control city multiselect" name="city">
                          <option selected="" disabled="" value="">- select -</option>
                        </select>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Address <span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Provide complete address"  name="address" required />
                      </div>
                  </div>
                  
                </div>

                <div class="row">

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Landmark<span class="note"> *</span></label>
                        <input class="form-control"  type="text" value="" placeholder="Provide complete address"  name="landmark" required />
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6"> 
                      <div class="form-group has-feedback">
                        <label class="control-label">Pin Code <span class="note"> *</span></label>
                        <input class="form-control"  type="number" value="" placeholder=""  name="pincode" required />
                      </div>
                  </div>
                  
                </div>

                
                <br>
                <div class="row">
                  <div class="col-lg-12"> 
                  <div class="form-group">
                  <button class="btn btn-danger btn-block" type="submit" >REGISTER</button>
                  </div></div></div>
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