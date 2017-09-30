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
                    <ul id="top-bar" class="nav nav-tabs nav-justified">
                        <li class="Student active"><a href="#student-access">Student</a></li>
                        <li class="Admin"><a href="#admin-access">Admin</a></li>
                    </ul>

                    <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                        <div id="student-access" class="tab-pane fade active in">
                            <h2><i class="glyphicon glyphicon-log-in"></i> Student Login</h2>
                            <form action="/index.php/auth/login" method="post" accept-charset="utf-8" autocomplete="off" role="form" class="form-horizontal">
                                <div class="form-group ">
                                    <label for="login" class="sr-only">Email</label>
                                    <input type="text" class="form-control form-control_login" name="email" id="login_value"
                                           placeholder="Email" tabindex="1" value=""/>
                                </div>
                                <div class="form-group ">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control_login" name="password" id="password"
                                           placeholder="Password" value="" tabindex="2" />
                                </div>
                                <div class="register">
                                    <label class="control-label">
                                        Not a Member ? <a href="http://www.first.jobs/auth/candidate_signup" target="_blank">Register here</a>
                                    </label>
                                </div>
                                <br/>
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {!! session('error') !!}
                                        {!! session()->flush() !!}
                                    </div>
                                @endif
                                <div class="form-group ">
                                    <input type="hidden" name="return_url" value="{!! Request::url() !!}">
                                    <input type="hidden" name="id" value="{!! $id !!}">
                                    <button type="submit" name="test_login_student" value="1" id="submit" tabindex="5" class="btn btn-lg btn-primary">Enter</button>
                                </div>
                            </form>
                        </div>
                        <div id="admin-access" class="tab-pane fade  in">
                            <h2><i class="glyphicon glyphicon-log-in"></i> Admin Login</h2>
                            <form method="post" accept-charset="utf-8" autocomplete="off" role="form" class="form-horizontal">
                                <div class="form-group ">
                                    <label for="login" class="sr-only">Email</label>
                                    <input type="text" class="form-control form-control_login" name="test_user" id="login_value"
                                           placeholder="User Name" tabindex="1" value="" />
                                </div>
                                <div class="form-group ">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control_login" name="password" id="password"
                                           placeholder="Password" value="" tabindex="2" />
                                </div>

                                <br/>
                                <div class="form-group ">
                                    <button type="submit" name="log-me-in" id="submit" tabindex="5" class="btn btn-lg btn-primary">Enter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </article>
        </div>



    </div>

@stop