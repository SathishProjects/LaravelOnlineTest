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
    </style>

    <script>
        $(function() {

            $('.Student').click(function(e) {
                $('#admin-access,.Admin').removeClass('active');
                $(this).addClass('active');
                $("#student-access").addClass('active');
                e.preventDefault();

            });
            $('.Admin').click(function(e) {
                $('#student-access,.Student').removeClass('active');
                $(this).addClass('active');
                $("#admin-access").addClass('active');
                e.preventDefault();
            });

        });
    </script>

    <div class="homecontainer">

        <div class="login-body">
            <article class="container-login center-block">
                <section class="margin_top40">
                    

                    <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                        
                        <div class="tab-pane fade in active">
                            <center><h4></i> Are you sure to attend {{ $credentials['test_name'] }} ?</h4></center>
                            <form action="/index.php/auth/login" method="post" accept-charset="utf-8" autocomplete="off" role="form" class="form-horizontal">
                                <input type="hidden" name="id" value="{{ $credentials['id'] }}"/>
                                <input type="hidden" name="email" value="{{ $credentials['email'] }}"/>

                                <div class="form-group ">
                                    <label for="password" class="sr-only">Password</label>
                                    <center><b>Login as : </b> {{ $credentials['email'] }}</center>
                                </div>

                                <div class="form-group ">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control_login" name="password" id="password"
                                           placeholder="Password" value="" tabindex="2" required="required"/>
                                </div>

                               <!--  <div class="form-group ">
                                    <label >New Registered member ? </label>
                                </div>
                                 -->

                                @if (session()->has('error') && session()->has('errortype'))
                                    <div class="alert alert-danger">
                                        {!! session('error') !!}
                                        {!! session()->flush() !!}
                                    </div>
                                @endif

                                <div class="form-group ">
                                    
                                    <button type="submit" class="btn btn-lg btn-primary spl_button">Enter</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </section>
            </article>
        </div>



    </div>

@stop