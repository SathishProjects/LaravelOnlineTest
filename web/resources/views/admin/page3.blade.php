@extends('layouts.page')
@section('content')
    <style>
        @media only screen and (min-width: 768px){
            #header .head-right {
                margin-top: 25px !important;
                margin-right: -117px !important;
            }}
    </style>
    <div class="container">

        <div class="col-md-12">

            <div class="panel-group panel-group1" >
                <div class="panel panel-default ">
                    <div  class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="panel-group">
                                        <div class="panel panel-default ">

                                            <div class="panel-heading header-style">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <button type="button" class="btn btn1 btn-radius">Verbal Reasoning</button>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <span class="pull-right"><h6><b>26 out of 50 </b></h6></span><span class="pull-right"><h6>Answered : </h6></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel-body qn-panel">
                                                <p><b>Two different finance companies declare fixed annual rate of interest on the amounts invested with them by investors. The rate of interest offered by these companies may differ from year to year depending on the variation in the economy of the country and the banks rate of interest. The annual rate of interest offered by the two Companies P and Q over the years are shown by the line graph provided below.
                                                    <br><center>Annual Rate of Interest Offered by Two Finance Companies Over the Years.</center></b></p>
                                                <img src="/images/test2.png" class="img-responsive"><br>
                                                <p>
                                                    <b>In 2000, a part of Rs. 30 lakhs was invested in Company P and the rest was invested in Company Q for one year. The total interest received was Rs. 2.43 lakhs. What was the amount invested in Company P?</b></p>
                                                <form role="form">
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio">Rs. 9 lakhs</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio">Rs. 11 lakhs</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio">Rs. 12 lakhs</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="optradio">Rs. 18 lakhs</label>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="panel-body bgc_gray">
                                                {{--<button type="button" class="btn btn2">Mark for Review</button>--}}
                                                <center><a href="/index.php/page4" type="button" class="btn btn1 href1 pull-right">Save & Next</a></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">

                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default ">
                                            <div class="panel-heading">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#section0" aria-expanded="false">
                                                    <h4 class="panel-title">Verbal Reasoning</h4>
                                                </a>
                                            </div>
                                            <div id="section0" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

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
                                            <div id="section1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

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
            </div>
        </div>
    </div>
@stop
