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
                    @if($details['responseType'] == 'success')
                    <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                        <div id="student-access" class="tab-pane fade active in">
                            <center><h2>Welcome</h2></center>
                            <div class="row">
                                <div class="col-md-12 bg-danger padding15px">
                                    <label>Generated URL :</label>
                                    <a href="http://localhost:8085/index.php/testlogin/{!! $details['url'] !!}" target="_blank">http://localhost:8085/index.php/testlogin/{!!$details['url'] !!}</a>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="help-block"> Visit the above link and proceed to test </span>
                                </div>
                            </div>
                        </div>
                    </div>
                        @else
                        <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                            <div id="student-access" class="tab-pane fade active in">
                                <center><h2>Oops ... </h2></center>
                                <div class="row">
                                    <div class="col-md-12 bg-danger padding15px">
                                        {!! $details['reponseMessage'] !!}
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    @endif
                </section>
            </article>
        </div>



    </div>

@stop