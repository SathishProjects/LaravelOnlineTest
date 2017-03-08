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

    <div class="homecontainer">

        <div class="login-body">
            <article class="container-login center-block">
                <section class="margin_top40">

                    <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">

                        <div id="admin-access" class="tab-pane fade  in active">
                                <center><h2><i class="glyphicon glyphicon-log-in"></i> Test Login</h2></center><br>
                            <form method="post" autocomplete="off" role="form" class="form-horizontal" action="/index.php/starttest">
                                <div class="form-group ">
                                    <label for="login" class="sr-only">Email</label>
                                    <input type="text" class="form-control form-control_login" name="test_user" id="login_value"
                                           placeholder="User Name" tabindex="1" value="" />
                                    <input type="hidden" name="test_id" value="{!! $test_id !!}"/>
                                </div>
                                <div class="form-group ">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control_login" name="test_password" id="password"
                                           placeholder="Password" value="" tabindex="2" />
                                </div>

                                <br/>
                                <div class="form-group ">
                                    <button type="submit" id="submit" tabindex="5" class="btn btn-lg btn-primary">Enter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </article>
        </div>



    </div>

@stop