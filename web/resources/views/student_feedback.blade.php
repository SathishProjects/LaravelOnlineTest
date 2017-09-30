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
        textarea.form-control {
            height: 150px;
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
                <section class="">

                      <div class="row">
                          <div class="col-xs-3"></div>
                          <div class="col-xs-6">
                                <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                            <div id="student-access" class="tab-pane fade active in">
                               
                                    <center> @if(isset($user_details['message']))  <h4>{!! $user_details['message'] !!}</h4> @endif</center>
                                @if(!isset($user_details['input']))
                                    <div class="row">
                                    <div class="col-md-12 bg-danger padding15px">
                                        <b>How shall we improve more ?</b><br><br>
                                        <form method="post" action="/index.php/student/feedback" accept-charset="utf-8" autocomplete="off" role="form">
                                            <input type="hidden" name="test_id" value="{!! $user_details['test_id'] !!}"/>

                                            <input type="hidden" name="batch_id" value="{!! $user_details['batch_id'] !!}"/>
                                            
                                            <input type="hidden" name="user_id" value="{!! $user_details['user_id'] !!}"/>
                                            <input type="hidden" name="student_id" value="{!! $user_details['student_id'] !!}"/>

                                            <input type="hidden" name="email" value="{!! $user_details['email'] !!}"/>
                                            <input type="hidden" name="name" value="{!! $user_details['name'] !!}"/>

                                        <textarea class="form-control" name="message" placeholder="Your valuable feedback ..." required></textarea><br>
                                        <button type="submit" class="btn-danger pull-right">Submit</button>

                                        </form>

                            
                                    </div>
                                    @else
                                    <center><a type="button" href="javascript:void(0)" class="btn btn2 href2 close_window">Close</a></center>
                                 @endif        
                                </div>
                                <br>
                            </div>
                            
                        </div>
                          </div>
                          <div class="col-xs-3"></div>
                      </div>

                </section>
            </article>
        </div>



    </div>

@stop