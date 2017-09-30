@extends('layouts.layout_student')
@section('content')


<div class="container">
    <div class="col-md-8" style="padding:0px;">

<div class="  pnl_border">
        <div class="col-lg-12" style="padding-top:20px;padding-right:10px; ">
        
            <div class="panel panel-default">
                <div class="panel-body textcenter" style="padding: 0px 15px 0px 15px;">

                    <div class="row cn_menu">
                       

                        <div class="col-lg-5">
                            <div class="text-center">
                                <form method="POST" action="http://www.first.jobs/candidate/image_upload" accept-charset="UTF-8" name="image_upload" id="image_upload" enctype="multipart/form-data"><input name="_token" type="hidden" value="jTXIgJYwQljWqjlbNQ9ej6TIO0zzPNzPIKQrsI8N">

                                                                                                    
                                <input class="hidden" type="file" id="profile-image-upload" name="profile-image-upload">
                                <div id="profile-image"><a style="color:black" data-toggle="modal" data-target="#img_up">

                                        <img id="img1" src="http://cdntt.techruit.net//college/profile/avatar.png" style="display: block;margin: auto;margin-left:-30px;width: 200px; height: 200px;" class="img-responsive " width="128px" height="128px">
                                        


                                    </a>  </div>
                                </form>
                                
                            </div>
                        </div>

                        <div class="col-lg-7">
                            
                            <h4>abinaya  c </h4><br>
                            
                            <span class="mkgrey"> Email   &nbsp;&nbsp;</span>cabinaya600@gmail.com<br><br>
                            <span class="mkgrey"> Mobile   &nbsp;&nbsp;</span>9624212245<br><br>

                            <div class="row">
                                <div class="col-xs-6 no_padding_margin">
                                    <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">View profile as
  <span class="caret"></span></button>
  <ul class="dropdown-menu pull-left">
    <li><a href="#">College</a></li>
    <li><a href="#">Company</a></li>
    <li><a href="#">Public</a></li>
  </ul>
</div>
                                </div>
                                <div class="col-xs-6 no_padding_margin">
                                    <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Resume
  <span class="caret"></span></button>
  <ul class="dropdown-menu pull-left">
    <li><a href="#">Download</a></li>
    <li><a href="#">Upload New</a></li>
  </ul>
</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row hidden">
                        
                        <div class="input-group search col-md-12">
                            <input class="form-control" accept=".pdf,.doc,.docx" id="resume_file" required="required" name="resume_file" type="file">
                            <span class="input-group-btn">
                             <input class="btn btn-warning" disabled="disabled" id="upload_btn" type="submit" value="Upload">

                          </span>
                        </div>
                        
                    </div>
                    <div class="row" style=" border-top: 1px dashed lightgrey;border-bottom: 1px dashed lightgrey;padding: 5px 0px 5px 0px">
                        <div class="col-md-12">
                                <strong>Profile URL : </strong> <span>first.jobs/st/3</span>
                        </div>
                        
                    </div>
                     <br>

                </div><!--panel-body pnl_bottom-->
            </div><!--panel-->

        </div>

        
    </div>

    <div class="  pnl_border">
        <div class="col-lg-12"  style="padding-right:10px; ">
        
            <div class="panel panel-default" >
                <div class="panel-body textcenter">

                  <h3>Personnel Details</h3>

                  

                  <div class="row" style=" border-bottom: 1px dashed lightgrey;border-top: 1px dashed lightgrey;">
                      <div class="col-md-12">
                      <br>
                        <span class="mkgrey"> Name   &nbsp;&nbsp;</span>cabinaya<br><br>
                        <span class="mkgrey"> Gender   &nbsp;&nbsp;</span>Female<br><br>
                        <span class="mkgrey"> Date of birth   &nbsp;&nbsp;</span>05-05-1994<br><br>    
                        <span class="mkgrey"> Email   &nbsp;&nbsp;</span>abc@gmail.com <br><br>    
                        <span class="mkgrey"> Mobile   &nbsp;&nbsp;</span>9629992643 <br><br>   

                        </div>

                  </div>

                </div><!--panel-body pnl_bottom-->
                

            </div><!--panel-->

            </div> 

        </div>

    <div class="  pnl_border">
        <div class="col-lg-12"  style="padding-right:10px; ">
        
            <div class="panel panel-default" >
                <div class="panel-body textcenter">

                  <h3>Address Details</h3>

                  

                  <div class="row" style=" border-bottom: 1px dashed lightgrey;border-top: 1px dashed lightgrey;">
                      <div class="col-md-12">
                      <br>

                        <span class="mkgrey"> Address   &nbsp;&nbsp;</span>5A, Reddy street , Virugambakkam <br><br>    
                        <span class="mkgrey"> State   &nbsp;&nbsp;</span>Tamilnadu <br><br>    
                        <span class="mkgrey"> District   &nbsp;&nbsp;</span>Chennai <br><br>    
                        <span class="mkgrey"> City   &nbsp;&nbsp;</span>Chennai <br><br>    
                        <span class="mkgrey"> Pincode   &nbsp;&nbsp;</span>631301 <br><br>    

                        </div>

                  </div>

                </div><!--panel-body pnl_bottom-->
                

            </div><!--panel-->

            </div> 

        </div>      

    <div class="  pnl_border">
        <div class="col-lg-12" style="padding-right:10px; ">
        
            <div class="panel panel-default" >
                <div class="panel-body textcenter">

                  <h3>Education</h3>

                  <div class="row" style=" border-bottom: 1px dashed lightgrey;border-top: 1px dashed lightgrey;">
                      <div class="col-md-12">
                      <br>
                      <h4>Anna University College , Arni</h4>
                      <span style="color: grey;">Bachelor of Engineering (B.E.), Computer Science</span><br>
                      <span style="color: grey;">2011 - 2015</span><br><br>

                      <span>78 </span> % - with Distinction <br><br>

                        </div>

                  </div>

                  <div class="row">
                      <div class="col-md-12">
                      <br>
                      <h4>Anna University College , Arni</h4>
                      <span style="color: grey;">Bachelor of Engineering (B.E.), Computer Science</span><br>
                      <span style="color: grey;">2011 - 2015</span><br><br>

                      <span>78 </span> % - with Distinction <br><br>

                        </div>

                  </div>

                </div><!--panel-body pnl_bottom-->
                
                <a href="#"><div class="row text-center" style="background-color: #eee;padding: 10px">
                        Add Education
                </div></a>

            </div><!--panel-->

        </div> 
    </div>

    <div class="  pnl_border">
        <div class="col-lg-12"  style="padding-right:10px; ">
        
            <div class="panel panel-default" >
                <div class="panel-body textcenter">

                  <h3>Project(s)</h3>

                  

                  <div class="row" style=" border-top: 1px dashed lightgrey;">
                      <div class="col-md-12">
                      <br>
                      <h4>Title of the project</h4>
                      <span style="color: grey;">Project done during under gradudate</span><br><br>

                      <span> Project description </span><br><br>

                        </div>

                  </div>

                </div><!--panel-body pnl_bottom-->
                
                <a href="#"><div class="row text-center" style="background-color: #eee;padding: 10px">
                        Add Project
                </div></a>

            </div><!--panel-->

            </div> 

        </div>        
    <div class="  pnl_border">
        <div class="col-lg-12"  style="padding-right:10px; ">
        
            <div class="panel panel-default" >
                <div class="panel-body textcenter">

                  <h3>Other Info</h3>

                  <div class="row" style=" padding-bottom:10px ;border-bottom: 1px dashed lightgrey;">
                      <div class="col-md-12"><br>

                        <h4 style=" padding-bottom:5px ;">Languages known</h4>
                        
                        <div class="row"


                        >
                            <button class="btn btn-skills">Tamil</button><button class="btn btn-skills">English</button>
                        </div>

                      </div>

                  </div>

                  <div class="row">
                      <div class="col-md-12"><br>

                        <h4 style=" padding-bottom:5px ;">Career interest</h4>
                        
                        <div class="row" style=" padding-bottom:10px ;border-bottom: 1px dashed lightgrey;">
                            <button class="btn btn-skills">Ajax</button><button class="btn btn-skills">PHP</button><button class="btn btn-skills">Jquery</button>
                        </div>

                      </div>

                  </div>

                  <div class="row">
                      <div class="col-md-12"><br>

                        <h4 style=" padding-bottom:5px ;">Technical Skills</h4>
                        
                        <div class="row"


                        >
                            <button class="btn btn-skills">Ajax</button><button class="btn btn-skills">PHP</button><button class="btn btn-skills">Jquery</button>
                        </div>

                      </div>

                  </div>

                  

                 

                </div><!--panel-body pnl_bottom-->
                

            </div><!--panel-->

            </div> 

        </div>  

        <div class="  pnl_border">
        <div class="col-lg-12"  style="padding-right:10px; ">
        
            <div class="panel panel-default" >
                <div class="panel-body textcenter">

                  <h3>Work Preference</h3>

                  

                  <div class="row">
                      <div class="col-md-12"><br>

                        <h4 style=" padding-bottom:5px ;">Preferred location</h4>
                        
                        <div class="row" style=" padding-bottom:10px ;border-bottom: 1px dashed lightgrey;">
                            - Chennai
                        </div>

                      </div>

                  </div>

                  <div class="row">
                      <div class="col-md-12"><br>

                        <h4 style=" padding-bottom:5px ;">Joining time</h4>
                        
                        <div class="row" style=" padding-bottom:10px ;border-bottom: 1px dashed lightgrey;">
                            - After Passing out
                        </div>

                      </div>

                  </div>

                  <div class="row">
                      <div class="col-md-12"><br>

                        <h4 style=" padding-bottom:5px ;">Mode of work</h4>
                        
                        <div class="row" style=" padding-bottom:10px ;border-bottom: 1px dashed lightgrey;">
                            - Full Time
                        </div>

                      </div>

                  </div>

                  

                 

                </div><!--panel-body pnl_bottom-->
                

            </div><!--panel-->

            </div> 

        </div>          

        </div>

       <div class="col-md-4" style="padding:0px; ">
            
             <div class="col-lg-12 hidden-md hidden-sm hidden-xs " style="padding:20px 0px 0px 0px; ">
            <div class="panel panel-default">
                <div class="panel-body textcenter">
                <br>
                <div class="row" style=" border-bottom: 1px dashed lightgrey;border-top: 1px dashed lightgrey;">
                <br>
                    <div class="col-md-6">
                        <span> Profile Strength </span>
                    </div>
                    <div class="col-md-6">
                        <div class="progress">
  <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar"
  aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
    60% Complete (warning)
  </div>
</div>
                    </div>
                </div><br>
 

                </div><!--panel-body pnl_bottom-->
            </div><!--panel-->
        </div>
        </div>

        </div>  

        

@stop