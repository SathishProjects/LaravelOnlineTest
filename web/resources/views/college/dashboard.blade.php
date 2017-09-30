<!-- Vijay deva -->
@extends('layouts.layout_college')
@section('content')

<div class="row">
    <!-- uncomment code for absolute positioning tweek see top comment in css -->
    <!-- <div class="absolute-wrapper"> </div> -->
    <!-- Menu -->
    <div class="side-menu">
    
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="brand-wrapper">
            <!-- Hamburger -->
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand --> 
            <form style="padding: 7px;" role="search">
			    <span class="input-group">
			      <input type="text" style=" border-radius: 0; box-shadow: none;"  class="form-control" placeholder="Job Search">
			      <span class="input-group-btn">
			        <button class="btn btn-warning" style=" border-radius: 0; box-shadow: none;" type="button">Go!</button>
			      </span>
			    </span><!-- /input-group -->
            </form>
        </div>

<!--  -->
    </div>

    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav" style="z-index: 999;overflow-y: auto; overflow: auto; max-height: 550px; width: 250px;">

            
           
             <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-sort"></span> Sort by <span class="caret"></span>
                </a>

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="#">
                                <span class="radio">
                                <input type="radio" name="radio1" id="radio0" value="" checked="checked">
                                <label for="radio0">
                                    All Jobs
                                </label>
                            </span></a></li>
                            
                            <li><a href="#">
                                <span class="radio">
                                <input type="radio" name="radio1" id="radio1" value="">
                                <label for="radio1">
                                    On Campus
                                </label>
                            </span></a></li>
                            
                            <li><a href="#">  <span class="radio">
                                <input type="radio" name="radio1" id="radio2" value="">
                                <label for="radio2">
                                    Pooled Campus
                                </label>
                            </span></a></li>

                             <li><a href="#"> <span class="radio">
                                <input type="radio" name="radio1" id="radio5" value="">
                                <label for="radio5">
                                     Open drive
                                </label>
                            </span></a></li>

                        </ul>
                    </div>
                </div>
            </li>

            <!-- Dropdown-->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl2">
                    <span class="glyphicon glyphicon-filter"></span> filter by<span class="caret"></span>
                </a>

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl2" class="panel-collapse collapse in">
                   <div class="panel-body">
                        <ul class="nav navbar-nav" style="margin-bottom: 50px;overflow-y: auto; height: 400px;">

                             <li class="fj_pad_05">
                            <select style=" border-radius: 0; box-shadow: none;" class="form-control">
                                <option>Job Drive</option>
                                <option>All Jobs </option>
                                <option>On campus </option>
                                <option>Pooled campus </option>
                                <option>Open Drive </option>                                
                            </select>
                            </li>

                            <li class="fj_pad_05">
                            <select style=" border-radius: 0; box-shadow: none;" class="form-control">
                            	<option>Degree</option>
                            	<option>All Degree </option>
                                <option>BE </option>
                                <option>ME </option>
                            </select>
                            </li>
                            
                             <li class="fj_pad_05">
                            <select style=" border-radius: 0; box-shadow: none;" class="form-control">
                                <option>Course</option>
                                <option>All Course </option>
                                <option>CSE </option>
                                <option>ECE </option>
                                <option>EEE </option>
                            </select>
                            </li>

                             <li class="fj_pad_05">
                            <select style=" border-radius: 0; box-shadow: none;" class="form-control">
                                <option>Month</option>
                                <option>All</option>
                                <option>This Month </option>
                                <option>This & Next Month </option>
                                <option>Next Month</option>
                            </select>
                            </li>
                            
                            <li class="fj_pad_05">
                            <input type="text" style=" border-radius: 0; box-shadow: none;"  class="form-control" placeholder="Location">
                            </li>



                   			<li><center class="fj_pad_05"><input type="submit" class="btn btn-warning" value="Filter"> <input type="submit" class="btn btn-default" value="Reset"></center></li>

                        </ul>
                    </div>
                 </div>
            </li>

           
           

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
           
      
       
       

    <div class="row">

<!-- <div class="[ col-xs-12 col-sm-12 col-md-12 col-lg-12] fj_pad_0">

    <div class="fj_msg_1">
        
       
       <b>You have a test (Test Message)</b>
       <a class="btn btn-default">Take a test</a>
        </div>
    </div> -->
    
	  <div class="[ col-xs-12 col-sm-12 col-md-12 col-lg-12] fj_mrg_1 fj_pad_0">

	  <div class="row">

	  <div class="[ col-xs-12 col-sm-6 col-md-4 col-lg-4] fj_pad_0">
        <span class="fj_fnt_8">You have <b class="fj_color_1">287</b> matching jobs</span>
        </div>

          <div class="[ col-xs-6 col-sm-6 col-md-4 col-lg-4]">
	        <div align="center">
	        
            <!--message-->
	       </div>
         </div>

         <div class="[ col-xs-12 col-sm-6 col-md-4 col-lg-4] fj_pad_0">
	       <span class="pull-right">
               <form>
                <span class="text-muted"><b>1</b>–<b>50</b> of <b>277</b></span>
                  <span class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                   </span>
                </form>
            </span>
 			</div>

            </div>

           </div>


            <div class="[ col-xs-12 col-sm-12 col-md-12 col-lg-12 ] fj_pad_0" id="jobs">
            <!--jobs-->
            <div class="[ panel panel-default ] panel-google-plus">
                <div class="dropdown">
                
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="../college/jobview"><i class="glyphicon glyphicon-eye-open"></i> View details</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">70</span> Eligible Students</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">42</span> Applied Students</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-share-alt"></i> Share link</a></li>
                    </ul>
                </div>
               <!--  <div class="panel-google-plus-tags">
                    <ul>
                        <li><i class="glyphicon glyphicon-map-marker"></i> Chennai</li>
                       
                    </ul>
                </div> -->
                <div class="panel-heading">
                    <img class="[ img-circle pull-left ]" src="{{ asset('images/avatar_company.png') }}" alt="Mouse0270" />
                     <a href="../college/jobview" class="fj_fnt_4"><b>Android Drive <span class="fj_fnt_2 fj_color_2">- Techruit Technologies</span>
                 
                     </b></a>
                  <!--   <h5>- 2 days ago</h5> -->
                    
                </div>
                <div class="panel-body">
                  <div>
                  <b>Degree</b> - <span>BE</span>,
                  <b>Course</b> - <span>CSE, ECE</span>,
                  <b>Passed out</b> - <span>2016</span>,
                    <b>Designation</b> - <span>Software developer</span>,
                    <b>Skills</b> - <span>Android</span>,
                    <b>Salary</b> - <span>Not disclosed</span>.                   
                  </div>
                    
                </div><!-- Lastdate : 26-Apr-2016 -->
                <div class="panel-footer">
                  <span class="fj_fnt_0 fj_color_2"> Posted on : Just Now</span><br><br>
                  <span class="pull-left">Last date : 26-Apr-2016</span>
                  
                  <br>
                </div>
               
            </div>


             <div class="[ panel panel-default ] panel-google-plus">
                 <div class="dropdown">
                   
                  
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="../college/jobview"><i class="glyphicon glyphicon-eye-open"></i> View details</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">70</span> Eligible Students</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">42</span> Applied Students</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-share-alt"></i> Share link</a></li>
                    </ul>
                </div>
               

                <div class="panel-heading">
                    <img class="[ img-circle pull-left ]" src="{{ asset('images/avatar_company.png') }}" alt="Mouse0270" />
                     <a href="../college/jobview" class="fj_fnt_4"><b>Telecommunication Drive <span class="fj_fnt_2 fj_color_2"> - getyourfirstjobs</span>
                   
                    </b></a>
                    
                </div>
                <div class="panel-body">
                  <div>
                  <b>Degree</b> - <span>Any</span>,
                  <b>Course</b> - <span>ECE</span>,
                  <b>Passed out</b> - <span>2015</span>,
                  <b>Designation</b> - <span>Telecaller</span>,
                  <b>Skills</b> - <span>Good communication skills in English</span>,
                  <b>Salary</b> - <span>1.2L per Annum</span>.
                  </div>
                    
                </div>
                <div class="panel-footer">
                  <span class="fj_fnt_0 fj_color_2"> Posted on : Just Now</span><br><br>
                  <span class="pull-left">Last date : 26-Apr-2016</span>
                  
                  <br>
                </div>
               
            </div>


             <div class="[ panel panel-default ] panel-google-plus">
                <div class="dropdown">
                    
                    
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="../college/jobview"><i class="glyphicon glyphicon-eye-open"></i> View details</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">70</span> Eligible Students</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">42</span> Applied Students</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-share-alt"></i> Share link</a></li>
                    </ul>
                </div>
               

                <div class="panel-heading">
                    <img class="[ img-circle pull-left ]" src="{{ asset('images/avatar_company.png') }}" alt="Mouse0270" />
                    <a href="../college/jobview" class="fj_fnt_4"><b>Php Drive <span class="fj_fnt_2 fj_color_2"> - Caring Elders</span>
                   </b></a>
                    
                </div>
                <div class="panel-body">
                  <div>
                    <b>Degree</b> - <span>Any</span>,
                    <b>Course</b> - <span>Any</span>,
                    <b>Passed out</b> - <span>2015</span>,
                    <b>Designation</b> - <span>Web developer</span>,
                    <b>Skills</b> - <span>Php</span>,
                    <b>Salary</b> - <span>10L per Annum</span>.
                  </div>
                    
                </div>
                <div class="panel-footer">
                  <span class="fj_fnt_0 fj_color_2"> Posted on : Just Now</span><br><br>
                  <span class="pull-left">Last date : 26-Apr-2016</span>
                  <span class="pull-right"> <b class="fj_job_msg_text2"> 2 std. selected</b> </span><br>
                  
                  <br>
                </div>
               
            </div>


             <div class="[ panel panel-default ] panel-google-plus">
                <div class="dropdown">
                
               
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="../college/jobview"><i class="glyphicon glyphicon-eye-open"></i> View details</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">70</span> Eligible Students</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">42</span> Applied Students</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-share-alt"></i> Share link</a></li>
                    </ul>
                </div>
                

                <div class="panel-heading">
                    <img class="[ img-circle pull-left ]" src="{{ asset('images/avatar_company.png') }}" alt="Mouse0270" />
                    <a href="../college/jobview" class="fj_fnt_4"><b>Web Drive <span class="fj_fnt_2 fj_color_2"> - Aigilx health</span></b></a>
                    
                </div>
                <div class="panel-body">
                  <div>
                    <b>Degree</b> - <span>BE</span>,
                    <b>Course</b> - <span>Any</span>,
                    <b>Passed out</b> - <span>2015,2016</span>,
                    <b>Designation</b> - <span>Software Trainee</span>,
                    <b>Skills</b> - <span>HTML5, CSS3, Javascript</span>,
                    <b>Salary</b> - <span>2.8L per Annum</span>.
                  </div>
                    
                </div>
                <div class="panel-footer">
                  <span class="fj_fnt_0 fj_color_2"> Posted on : Just Now</span><br><br>
                  <span class="pull-left">Last date : 26-Apr-2016</span>
                  <span class="pull-right"> <b class="fj_job_msg_text"> 6 std. have aptitude round</b> </span><br>
                

                </div>
               
            </div>


             <div class="[ panel panel-default ] panel-google-plus">
                <div class="dropdown">
                
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="../college/jobview"><i class="glyphicon glyphicon-eye-open"></i> View details</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">70</span> Eligible Students</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">42</span> Applied Students</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-share-alt"></i> Share link</a></li>
                    </ul>
                </div>
               
              
                <div class="panel-heading">
                    <img class="[ img-circle pull-left ]" src="{{ asset('images/avatar_company.png') }}" alt="Mouse0270" />
                    <a href="../college/jobview" class="fj_fnt_4"><b>IOS Drive <span class="fj_fnt_2 fj_color_2"> - first.jobs</span></b></a>
                    
                </div>
                <div class="panel-body">
                  <div>
                    <b>Degree</b> - <span>ME</span>,
                    <b>Course</b> - <span>cse</span>,
                    <b>Passed out</b> - <span>Any</span>,
                    <b>Designation</b> - <span>Software developer</span>,
                    <b>Skills</b> - <span>IOS</span>,
                    <b>Salary</b> - <span>1L. per Annum</span>.
                  </div>
                    
                </div>
                <div class="panel-footer">
                  <span class="fj_fnt_0 fj_color_2"> Posted on : Just Now</span><br><br>
                  <span class="pull-left">Last date : 26-Apr-2016</span><br>
                   
                </div>
               
            </div>


             <div class="[ panel panel-default ] panel-google-plus">
               <div class="dropdown">
               
               
                    <span class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="[ glyphicon glyphicon-chevron-down ]"></span>
                    </span>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="../college/jobview"><i class="glyphicon glyphicon-eye-open"></i> View details</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">70</span> Eligible Students</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="badge">42</span> Applied Students</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-share-alt"></i> Share link</a></li>
                    </ul>
                </div>
                

                <div class="panel-heading">
                    <img class="[ img-circle pull-left ]" src="{{ asset('images/avatar_company.png') }}" alt="Mouse0270" />
                    <a href="../college/jobview" class="fj_fnt_4"><b>Online Drive <span class="fj_fnt_2 fj_color_2"> - test.first.jobs</span></b></a>
                </div>
                <div class="panel-body">
                  <div>
                    <b>Degree</b> - <span>Any</span>,
                    <b>Course</b> - <span>cse</span>,
                    <b>Passed out</b> - <span>Any</span>,
                    <b>Designation</b> - <span>Software developer</span>,
                    <b>Skills</b> - <span>Android</span>,
                    <b>Salary</b> - <span>Not disclosed</span>.
                  </div>
                    
                </div>
                <div class="panel-footer">
                  <span class="fj_fnt_0 fj_color_2"> Posted on : Just Now</span><br><br>
                  <span class="pull-left">Last date : 26-Apr-2016</span>
                     <span class="pull-right"> <b class="fj_job_msg_text1"> 6 std. not selected</b> </span><br>
                </div>
               
            </div>

            <!--jobs-->
        </div>
        
         <div class="[ col-xs-12 col-sm-12 col-md-12 col-lg-12 ]">
        
           <span class="pull-right">
               <form>
                <span class="text-muted"><b>1</b>–<b>50</b> of <b>277</b></span>
                  <span class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                   </span>
                </form>
            </span>
           </div>

    </div>


        </div>
    </div>
</div>

@stop