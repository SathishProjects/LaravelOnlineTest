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
                  


                    <ul class="nav pull-right">                     
                         <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('images/profile.png') }}" width ="25px"></a>
                          <ul class="dropdown-menu">
                          
                          <li><a href="#">Sign Out <span class="glyphicon glyphicon-log-out"></span></a></li>
                        </ul>
                      </li>
                    </ul>
                 </div>
            </div>
        </div>
      </div>
 
      </div>
    </nav>
