<header id="header">
    <nav id="main-menu" class="navbar navbar-default navbar-fixed-top cn_nav_color" role="banner">
        <div class="container-fluid">
            <div class="col-sm-3 navbar-header">

                <a href="/index.php/college/batch/active"><img class="image_responsive logo_response" src="/images/logo.png" alt="logo"></a>
            </div>

            <div class="col-sm-6">
                <h4 class="text-danger text-center" style="margin-top:40px">( {{ Session::get('user_authenticated.reg_id') }} ) . {{ Session::get('user_authenticated.name') }}</h4>
            </div>
            
            <div class="col-xs-3">

                <a href="/index.php/auth/logout" class="pull-right" > <span class="fa fa-power-off"></span> LOGOUT </a>
            </div>
            
            
        </div><!--/.container-->
       
    </nav><!--/nav-->

</header><!--/header-->

