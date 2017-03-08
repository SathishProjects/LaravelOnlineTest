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
        .dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus {
    background-color: #e5e5e5 !important;
    color: black !important;
}

.btn {
    border-color: #999999 !important;
    border-radius: 0px !important;
}
.margin_top40{
	margin-top: 20%;
}
    </style>

    <div class="homecontainer">

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login-body">
            <article class="container-login center-block">
                <section class="">

                    <div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">

                        <div id="admin-access" class="tab-pane fade  in active">
                                <center><h2> Assign New Test</h2></center><br>
                            <form method="post" autocomplete="off" role="form" class="form-horizontal" action="/index.php/starttest">
                                

                                <div class="form-group ">
                                    <label>Title</label>
                                    
                                    <input type="hidden" name="batch_id" value="{{ $batch_details->batch_id }}" />
                                    <input type="hidden" name="batch_degree" value="{{ $batch_details->batch_degree }}"/>
                                    <input type="hidden" name="batch_branch" value="{{ $batch_details->batch_branch }}"/>
                                    <input type="hidden" name="batch_year" value="{{ $batch_details->batch_year }}"/>
                                    <input type="hidden" name="batch_year_to" value="{{ $batch_details->batch_year_to }}"/>

                                    <input type="text" class="form-control form-control_login" name="title" id="title"
                                           placeholder="Chapter / Test title" value="" tabindex="2" />
                                </div>

                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Question Paper Id </label>
                                                    <div class="input-group">
                                                        <input type="text" name="qp_id" class="form-control qpaper_id" placeholder="Question Paper Id">
                                                        <span class="input-group-btn">
                                                        <button type="button" name="check_btn" class="btn btn2 check_btn" id="check_btn">Get Details</button>
                                                        </span>
                                                    </div>
                                                <div class="progress progress1" hidden>
                                                    <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
                                                         aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Loading Please wait ...</div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>

                                    <div class="row error_details_container" hidden>
                                        <div class="col-md-12">
                                            <span class="fontsize2">Requested Question Paper not active (or) Not found ...</span>
                                        </div>
                                    </div>
                                    <div class="question_details_container" hidden>

                                    <span class="help-block">( <span class="qn_title"></span> created on - <span class="qn_created"></span>  )</span>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-xs-7" for="number_of_questions">No.of.Qns <span class="note">*</span>  </label>
                                                <div class="col-xs-5">
                                                    <input type="number" min="1" name="number_of_questions" class="form-control number_of_questions" id="number_of_questions" placeholder="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-xs-7" for="total_marks">Total marks <span class="note">*</span>  </label>
                                                <div class="col-xs-5">
                                                    <input type="number" min="1" name="total_marks" class="form-control total_marks" id="total_marks" placeholder="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-xs-7" for="duration">Duration (Mins) </label>
                                                <div class="col-xs-5">
                                                    <input type="number" min="1" name="duration" class="form-control duration" step="1" id="duration" placeholder="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-xs-7" for="duration"> Negative marks </label>
                                                <div class="col-xs-5">
                                                    <input type="radio" name="is_negative" class="is_negative" value="0"> No
                                                    <input type="radio" name="is_negative" class="is_negative" value="1"> Yes
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    

                                    <div class="row note_div">
                                        <div class="col-xs-12">
                                        <span class="note"> Note:  fields with * are readonly not editable</span>
                                        </div>
                                    </div>
                                    <br>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-6"><input type="checkbox" name="is_question_random" class="is_question_random" value="1"> Randomize Questions</div>
                                        <div class="col-md-6"><input type="checkbox" name="is_option_random" class="is_option_random" value="1"> Randomize Options</div>

                                    </div>

                                <br/>
                                
                                @if (session()->has('error') && !session()->has('errortype'))
                                    <div class="alert alert-danger">
                                        {!! session('error') !!}
                                        {!! session()->flush() !!}
                                    </div>
                                @endif

                                <div class="form-group ">
                                    <button type="submit" id="submit" tabindex="5" class="btn btn-lg btn-primary spl_button">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </article>
        </div>

            </div>
        </div>


    </div>

@stop