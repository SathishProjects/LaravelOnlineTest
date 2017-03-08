<header id="header">
    <nav id="main-menu" class="navbar navbar-default navbar-fixed-top cn_nav_color" role="banner">
        <div class="container">
            <div style="width: auto !important" class="col-md-10 navbar-header">

                @if(session()->has('user_authenticated.profile_url'))
                    <?php $url1 = session('user_authenticated.profile_url'); ?>
                @else
                    <?php $url1='/company/profile/company.png' ?>
                @endif

                <a class="navbar-brand" href="../"><img src="{{'http://cdntt.techruit.net/'.$url1}}" class="img-circle" alt="logo" width="90em" height="80em"></a>

                <h4 class="college-logo " style=" padding: 15px 0px 0px 115px;">
                    @if (session()->has('user_authenticated.name'))
                        <?php
                        $name =  session('user_authenticated.name');
                        $val  = substr($name,0,13);
                        ?>
                    @endif <?php echo $val,'...';?>

                </h4>
            </div>
            <div class="col-md-3 pull-right head-right">
                <ul class="list-inline pull-right">
                    <!-- home -->
                    <li >
                        <a href="/company/dashboard">
                            <i class="glyphicon glyphicon-home"></i>
                        </a>

                    </li>
                    <!-- /messages -->
                    <!-- Settings -->
                    <li class="dropdown">

                        <a href="../company/profile">
                            <i class="glyphicon glyphicon-cog"></i>
                        </a>

                    </li>
                    <!-- /Settings -->
                    <!-- Notification -->
                    <li class="dropdown">
                        <a  href="../company/notification">
                            <i class="glyphicon glyphicon-globe"></i>
                            <span class="badge up">@if (session()->has('unread'))
                                    {!! session('unread') !!}@endif</span>
                        </a>

                    </li>
                    <!-- /Notification -->




                    <!-- Logout -->
                    <li>

                        <a href="/auth/logout">{!! Form::button('Logout', array('class' => 'btn','id' => '')) !!}</a>

                    </li>
                    <!-- /Logout -->
                </ul>

            </div>


        </div><!--/.container-->

    </nav><!--/nav-->

</header><!--/header-->
