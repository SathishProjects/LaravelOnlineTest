@extends('layouts.page')
@section('content')
    <style>
        @media only screen and (min-width: 768px){
            #header .head-right {
                margin-top: 25px !important;
                margin-right: -117px !important;
            }}
    </style>
    <div class="homecontainer container" xmlns="http://www.w3.org/1999/html">
        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="panel-group panel-group1 zeropaddingtop" >
                        <div class="panel">
                            <div  class="panel-collapse collapse in">
                                <div class="panel-body">



                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <center>
                                                        <h4>Answer Key for {!! $testdetails->title !!}</h4>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div><br>

                                                <?php
                                                $alphabet = range('A', 'Z');
                                                ?>

                                                <div class="row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-6">
                                                        <div class = "panel panel-default">
                                                            <div class = "panel-body">

                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th>Section</th>
                                                                <th>Question</th>
                                                                <th>Answer / Key</th>
                                                                <th>Answer image</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($subject as $key => $value)

                                                                <?php $question=1; ?>

                                                                @foreach($Section_records as $skey => $sval)
                                                                    @if( $sval->section_subject ==$value)
                                                                        @for($x=1;$x<=$sval->number_of_questions_section;$x++)
                                                                            <tr>
                                                                                <td>{!! $alphabet[$key] !!}</td>
                                                                                <td><?php echo $question;$question=$question+1;?></td>
                                                                                @foreach($Option_records as $okey=>$oval)
                                                                                    @if( ($oval->section_id == $sval->section_id) && ($oval->qpq_order_id == $x) )
                                                                                        <td>{!! $oval->answer_text !!}</td>
                                                                                        @if($oval->answer_image != null)
                                                                                            <td><img src="{!! $oval->answer_image !!}"></td>
                                                                                        @else
                                                                                            <td>-</td>
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                        @endfor
                                                                    @endif
                                                                @endforeach

                                                            @endforeach

                                                            </tbody>
                                                        </table>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3"></div>
                                                </div>




                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@stop