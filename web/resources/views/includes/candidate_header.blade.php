<style>
  .dropdown-menu.pull-left {
    left:0;
  }
</style>

<nav class="navbar navbar-default navbar-default1 navbar-fixed-top">
      <div class="">
        
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-5 col-sm-4 hidden-xs col-md-5">
                  
                  <img src="{{ asset('images/logo.png') }}" style="max-width: 180px;">

                </div><!--col-lg-6-->
                <div class="hidden-lg hidden-sm col-xs-4 hidden-md">
                  
                  <img src="{{ asset('images/min_logo.png') }}" style="max-width: 50px;">

                </div><!--col-lg-6-->
                 <div class="col-lg-7 col-sm-8 col-xs-8 col-md-7">
                 <div class="row">
                 <div class="col-lg-11 col-md-11 col-xs-9 col-sm-10"> 

                   
                     <ul class="nav pull-right">                     
                         <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell" style="font-size: 19px;color: #CCCCCC;"></i><span class="badge" style="background-color: red">1</span></a>
                          <ul class="dropdown-menu pull-right">

                          <li><a href="#">Notification 1 Notification 1 Notification 1 Notification 1 </a></li>
                          <li class="divider"></li>

                          <li><a href="profile">Notification 2 </a></li>
                          <li class="divider"></li>

                          <li><a href="#">Notification 3 </a></li>

                          <li class="text-center"><a href="/index.php/student/notification">See All</a></li>

                        </ul><!--dropdown-menu-->
                      </li><!--dropdown-->

                    </ul><!--nav-->

                 </div><!--col-lg-10-->
                   <div class="col-lg-1 col-md-1 col-xs-3 col-sm-2">
                    <ul class="nav pull-right">                     
                         <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('images/profile.png') }}" width ="25px"></a>
                          <ul class="dropdown-menu">
                          <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                          <li class="divider"></li>
                          <li><a href="profile">Profile <span class="glyphicon glyphicon-user"></span></a></li>
                          <li class="divider"></li>
                          <li><a href="#">Sign Out <span class="glyphicon glyphicon-log-out"></span></a></li>
                        </ul><!--dropdown-menu-->
                      </li><!--dropdown-->
                    </ul><!--nav-->

                   </div> <!--col-lg-2-->
                   </div>
                 </div><!--col-lg-6-->
            </div><!--row-->
        </div><!--col-lg-12-->
      </div><!--container-->
      </div>
    </nav>
