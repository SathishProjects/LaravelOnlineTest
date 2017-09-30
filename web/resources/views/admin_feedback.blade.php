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
                <section class="margin_top40">

                        <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                            <div id="student-access" class="tab-pane fade active in">
                                <center><h4>
                                @if(isset($user_details['message']))  {!! $user_details['message']; !!} 
								 {!! session()->flush() !!}
                                       @else
                                   Thank you ... Logged out Successfully  
                                @endif
                                 
                                

                                </h4></center>
                                  @if(!isset($user_details['message']))
                                    <div class="row">
                                    <div class="col-md-12 bg-danger padding15px">
                                        <b>How shall we improve more ?</b><br><br>
                                        <form method="post" action="/index.php/testadmin/feedback" accept-charset="utf-8" autocomplete="off" role="form">
                                            <input type="hidden" name="test_id" value="{!! $user_details['test_id'] !!}"/>
                                            <input type="hidden" name="test_login_id" value="{!! $user_details['test_login_id'] !!}"/>
                                        <textarea class="form-control" name="message" placeholder="Your valuable feedback ..." required></textarea>
                                        <button type="submit" class="btn-danger">Submit</button>

                                        </form>

                            
                                    </div>
                                </div>
                                 @endif
                                <br>
                            </div>
                            
                        </div>

                </section>
            </article>
        </div>



    </div>

@stop