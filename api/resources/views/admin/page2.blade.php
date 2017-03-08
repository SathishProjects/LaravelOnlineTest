@extends('layouts.test_page')
@section('content')
    <style>
        @media only screen and (min-width: 768px){
            #header .head-right {
                margin-top: 25px !important;
                margin-right: -117px !important;
            }}
        body{
            padding-top: 50px !important;
        }
    </style>

    {{--<script type="text/javascript">--}}

    {{--window.onload = showwindow;--}}

    {{--$(document).ready(function(){--}}
    {{--$(document).on("keydown", keypressaction);--}}
    {{--});--}}

    {{--</script>--}}

    {{--<script type="text/javascript">--}}
    {{--$(document).ready(function() {--}}
    {{--$(document).mousemove(function(e) {--}}
    {{--if(e.pageY <= 5)--}}
    {{--{--}}
    {{--alert("Can't perform any opration");--}}
    {{--}--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}

    {{--<script>--}}
        {{--$(window).bind('click', function(event) {--}}
            {{--if(event.target.href)--}}
                {{--$(window).unbind('beforeunload');--}}
        {{--});--}}
        {{--$(window).bind('beforeunload', function(event) {--}}
            {{--return "Leaving this page will logout from test";--}}
        {{--});--}}
    {{--</script>--}}


    <div class="container">

            <div class="col-md-12">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel-group">
                                <div class="panel ">

                                    <div class="panel-heading header-style">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <button type="button" class="btn btn1 btn-radius">Q.{!! $current_question_records[0]->qpq_order_id !!}</button>
                                            </div>
                                            <div class="col-xs-6">
                                                <span class="pull-right"><h5><b>26 out of 50 </b></h5></span><span class="pull-right"><h5>Answered : </h5></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-body panelmaxheight">
                                        <form role="form" action="/index.php/test/submit_question">

                                            <input type="hidden" value="{!! $current_question_records[0]->qp_id !!}" name="qp_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->section_id !!}" name="section_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->section_order_id !!}" name="section_order_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->qpq_order_id !!}" name="qpq_order_id"/>
                                            <input type="hidden" value="{!! $current_question_records[0]->qpq_id !!}" name="qpq_id"/>



                                            <b>
                                                {!! $current_question_records[0]->question_text !!}
                                            </b>

                                            @if($current_question_records[0]->question_image)
                                            <div class="row">

                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <img src="{!! $current_question_records[0]->question_image !!}">

                                                </div>
                                                <div class="col-md-3"></div>

                                            </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-12">
                                                    @foreach($current_option_records as $optkey => $optval)
                                                    <div class="option">
                                                        <input type="radio" name="currect_qpqa_id" value="{!! $optval->qpqa_id !!}">
                                                        @if($optval->answer_image)
                                                        <img src="{!! $optval->answer_image !!}"><br>
                                                        @endif
                                                        @if($optval->answer_text)
                                                             {!! $optval->answer_text !!}
                                                        @endif
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="panel-body bgc_gray">
                                                {{--<button type="button" class="btn btn2">Mark for Review</button>--}}
                                                <center><button type="submit" class="btn btn2 href2 pull-right">Save & Next</button></center>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">

                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default ">
                                    <div class="panel-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#section0" aria-expanded="false">
                                            <h4 class="panel-title">Verbal Reasoning <span class="badge">5</span></h4>
                                        </a>
                                    </div>
                                    <div id="section0" class="panel-collapse collapse in">

                                        <div class="panel-body">
                                            <button type="button" class="btn btn-success btn-circle">1</button>
                                            <button type="button" class="btn btn-danger btn-circle">2</button>
                                            <button type="button" class="btn btn-danger btn-circle">3</button>
                                            <button type="button" class="btn btn-danger btn-circle">4</button><br>
                                            <button type="button" class="btn btn-success btn-circle">5</button>
                                            <button type="button" class="btn btn-danger btn-circle">6</button>
                                            <button type="button" class="btn btn-danger btn-circle">7</button>
                                            <button type="button" class="btn btn-success btn-circle">8</button><br>
                                            <button type="button" class="btn btn-success btn-circle">9</button>
                                            <button type="button" class="btn btn-success btn-circle">10</button>
                                            <button type="button" class="btn btn-default btn-circle">11</button>
                                            <button type="button" class="btn btn-default btn-circle">12</button><br>
                                            <button type="button" class="btn btn-success btn-circle">13</button>
                                            <button type="button" class="btn btn-default btn-circle">14</button>
                                            <button type="button" class="btn btn-default btn-circle">15</button>
                                        </div>
                                        <div class="panel-body bgc_gray">
                                            <div class="row">
                                                <div class="col-xs-6 padding_right2px ">
                                                    <button type="button" class="btn btn-success btn-circle btn-small"></button> <span class="fontsize1">Answered</span>
                                                </div>
                                                <div class="col-xs-6 padding_left2px padding1">
                                                    <button type="button" class="btn btn-danger btn-circle btn-small"></button> <span class="fontsize1">Not Answered</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="panel panel-default ">
                                    <div class="panel-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#section1" aria-expanded="false">
                                            <h4 class="panel-title">Non Verbal Reasoning</h4>
                                        </a>
                                    </div>
                                    <div id="section1" class="panel-collapse collapse" style="height: 0px;">

                                        <div class="panel-body">
                                            <button type="button" class="btn btn-success btn-circle">16</button>
                                            <button type="button" class="btn btn-danger btn-circle">17</button>
                                            <button type="button" class="btn btn-danger btn-circle">18</button>
                                            <button type="button" class="btn btn-danger btn-circle">19</button><br>
                                            <button type="button" class="btn btn-success btn-circle">20</button>
                                            <button type="button" class="btn btn-danger btn-circle">21</button>
                                            <button type="button" class="btn btn-danger btn-circle">22</button>
                                            <button type="button" class="btn btn-success btn-circle">23</button><br>
                                            <button type="button" class="btn btn-success btn-circle">24</button>
                                            <button type="button" class="btn btn-success btn-circle">25</button>
                                            <button type="button" class="btn btn-danger btn-circle">26</button>
                                            <button type="button" class="btn btn-success btn-circle">27</button><br>
                                            <button type="button" class="btn btn-success btn-circle">28</button>
                                            <button type="button" class="btn btn-success btn-circle">29</button>
                                            <button type="button" class="btn btn-success btn-circle">30</button>
                                        </div>
                                        <div class="panel-body bgc_gray">
                                            <div class="row">
                                                <div class="col-xs-6 padding_right2px ">
                                                    <button type="button" class="btn btn-success btn-circle btn-small"></button> <span class="fontsize1">Answered</span>
                                                </div>
                                                <div class="col-xs-6 padding_left2px padding1">
                                                    <button type="button" class="btn btn-danger btn-circle btn-small"></button> <span class="fontsize1">Not Answered</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="panel panel-default ">
                                    <div class="panel-heading">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#section2" aria-expanded="false">
                                            <h4 class="panel-title">Logical Reasoning</h4>
                                        </a>
                                    </div>
                                    <div id="section2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

                                        <div class="panel-body">
                                            <button type="button" class="btn btn-success btn-circle">31</button>
                                            <button type="button" class="btn btn-danger btn-circle">32</button>
                                            <button type="button" class="btn btn-danger btn-circle">33</button>
                                            <button type="button" class="btn btn-danger btn-circle">34</button><br>
                                            <button type="button" class="btn btn-success btn-circle">35</button>
                                            <button type="button" class="btn btn-danger btn-circle">36</button>
                                            <button type="button" class="btn btn-danger btn-circle">37</button>
                                            <button type="button" class="btn btn-success btn-circle">38</button><br>
                                            <button type="button" class="btn btn-success btn-circle">39</button>
                                            <button type="button" class="btn btn-success btn-circle">40</button>
                                            <button type="button" class="btn btn-default btn-circle">41</button>
                                            <button type="button" class="btn btn-default btn-circle">42</button><br>
                                            <button type="button" class="btn btn-success btn-circle">43</button>
                                            <button type="button" class="btn btn-default btn-circle">44</button>
                                            <button type="button" class="btn btn-default btn-circle">45</button>
                                            <button type="button" class="btn btn-success btn-circle">46</button><br>
                                            <button type="button" class="btn btn-default btn-circle">47</button>
                                            <button type="button" class="btn btn-default btn-circle">48</button>
                                            <button type="button" class="btn btn-default btn-circle">49</button>
                                            <button type="button" class="btn btn-default btn-circle">50</button>
                                        </div>
                                        <div class="panel-body bgc_gray">
                                            <div class="row">
                                                <div class="col-xs-6 padding_right2px ">
                                                    <button type="button" class="btn btn-success btn-circle btn-small"></button> <span class="fontsize1">Answered</span>
                                                </div>
                                                <div class="col-xs-6 padding_left2px padding1">
                                                    <button type="button" class="btn btn-danger btn-circle btn-small"></button> <span class="fontsize1">Not Answered</span>
                                                </div>
                                            </div>
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
