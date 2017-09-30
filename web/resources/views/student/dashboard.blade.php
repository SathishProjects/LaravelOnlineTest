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
                <section class="">
                    
                        <div class="row">
                            <div class="col-xs-3"></div>
                            <div class="col-xs-6">
                                <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
                            <div id="student-access" class="tab-pane fade active in">
                                <center><h2> Welcome , {{ $user['name'] }}</h2>  ( {{ $user['email'] }} ) </center>
                                
                                <?php $count = 0; ?>

                                        @if($data->test_details != null)
                                         @foreach($data->test_details[0] as $t_key => $t_val )
                                            @if($t_val->test_id)
                                                <?php $count++; ?>
                                            @endif
                                         @endforeach
                                        @endif 

                                @if($count)         
                                <center>
                                    <div class="row">
                                    <div class="col-md-12">
                                        <h4>Click on below test link to start test</h4>
                                    </div>
                                </div></center>

                                <div class="row">
                                    <div class="col-md-12">

                                       
                                    <ol>
                                        @foreach($data->test_details[0] as $t_key => $t_val )
                                        @if($t_val->is_login == '0')
                                        <li> <a href="/index.php/testhome/{{ $t_val->test_id }}" title="click to take test"> {{ $t_val->title }} </a> ( <span class="glyphicon glyphicon-info-sign text-info"></span> Under Progress ) </li>
                                        @elseif($t_val->is_login == null)
                                        <li> <a href="/index.php/testhome/{{ $t_val->test_id }}" title="click to take test"> {{ $t_val->title }} </a> ( <span class="glyphicon glyphicon-remove text-danger"></span> Not Attended ) </li>
                                        @else
                                        <li> <b>{{ $t_val->title }}</b>  @if($t_val->test_status == 2)( Marks - {{ $t_val->score }} )@endif <span class="glyphicon glyphicon-ok text-success"></span> </li>
                                        @endif
                                        <br>
                                        @endforeach
                                    </ol>                                                
                                       

                                    </div>
                                </div>
                                

                                @else
                                    <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Sorry ! You have no active test</h4>
                                    </div>
                                </div>
                                @endif
                                

                                

                                <center><br><a class="btn btn2" type="button" href="/index.php/auth/logout"> Logout </a></center>
                                

                                
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