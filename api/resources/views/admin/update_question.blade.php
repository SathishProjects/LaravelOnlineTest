@extends('layouts.page')
@section('content')
    <div class="homecontainer container">
        <div class="container">

            <div class="col-md-8">

                <div class="panel-group panel-group1" >
                    <div class="panel panel-default">
                        <div class="panel-heading panelcolor1 panel2">
                            <div class="row">

                                <div class="col-sm-4">
                                    <label>QPID : </label> {!! $qp_details->qp_id !!}
                                </div>
                                <div class="col-sm-4">
                                    <label>Title : </label> {!! $qp_details->title !!}
                                </div>
                                <div class="col-sm-4">
							<span class="pull-right">
						<a href="/index.php/{!!$qp_details->qp_id !!}/admin/edit_questionpaper" class="href1"> <span class="glyphicon glyphicon-edit"></span> Edit Question Paper</a>
						</span>
                                </div>
                            </div>
                        </div>
                        <div  class="panel-collapse collapse in">
                            <div class="panel-body">

                                <div class="form-group margin-bottom0px row">

                                    <div class="col-xs-12">

                                        <div class="col-xs-12 zeropadding">

                                            <div class="question">
                                                <ul class="breadcrumb zeropadding zeromargin">
                                                    <li><a href="javascript:void(0)">QuestionPaper {!! $qp_details->qp_id !!}</a></li>
                                                    <li><a href="javascript:void(0)"> Section {!! $question_details['section_id'] !!} </a></li>
                                                    <li class="active">Question {!! $question_details['question_id'] !!}</li>

                                                </ul>


                                                {!! Form::open([
                                                        "name"              => "add_question",
                                                        "id"                => "add_question",
                                                        "url"            => "/admin/update_question",
                                                        "method"            => "POST",
                                                        'files' => true

                                                                ])
                                                !!}

                                                @if($current_question)
                                                    <input type="hidden" value=" {!!$current_question->qpq_id !!}" name="qpq_id">
                                                @endif

                                                <input type="hidden" value=" {!! $qp_details->qp_id !!}" name="qp_id">
                                                <input type="hidden" value=" {!! $question_details['question_id'] !!}" name="qpq_order_id">


                                                @foreach($section_details as $key => $value)

                                                    @if($question_details['section_id'] == $value->section_value)
                                                        <input type="hidden" value=" {!! $value->section_id !!}" name="section_id">
                                                        <input type="hidden" value=" {!! $value->section_value !!}" name="section_order_id">
                                                        <input type="hidden" value=" {!! $value->section_subject_id !!}" name="subject_id">
                                                        <input type="hidden" value=" {!! $value->section_chapter_id !!}" name="chapter_id">
                                                    @endif
                                                @endforeach
                                                <div class="row">
                                                    <div class="col-xs-12">
												<span class="pull-right">
												<label for="qns">Question Type : </label>
												<input type="checkbox" name="question_type" class="question_type" value="1" checked="checked"/> Text
                                                @if($current_question->question_type == 2)
												<input type="checkbox" name="question_type" class="question_type" value="2" checked="checked"/> Image
                                                @else
                                                <input type="checkbox" name="question_type" class="question_type" value="2" /> Image
                                                @endif
												</span>
                                                    </div>
                                                </div>

                                                <div class="question_text">
                                                    <textarea class="form-control editable" placeholder="Question text" name="question_text">{!! $current_question->question_text !!}</textarea>
                                                </div>
                                                @if($current_question->question_type == 2)
                                                    <div class="question_image">

													<span class="file-input btn btn2 btn-block btn-primary btn-file">
                											Click here to upload question image <input type="file" name="question_image" multiple>
            										</span>
                                                        <br><label class="question_image_view" >Question Image :</label>
                                                        <center>
                                                            <div class="question_image_view" >
                                                                <img src="{!! $current_question->question_image !!}" name="question_image_file" class="question_image_file" width="300px" height="200px">
                                                            </div>
														<span class="question_image_view" >
															<a href="javascript:void(0)" class="href1 remove_question_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a>
														</span>
                                                        </center>

                                                    </div>
                                                @else
                                                    <div class="question_image" hidden>

													<span class="file-input btn btn2 btn-block btn-primary btn-file">
                											Click here to upload question image <input type="file" name="question_image" multiple>
            										</span>
                                                        <br><label class="question_image_view" hidden>Question Image :</label>
                                                        <center>
                                                            <div class="question_image_view" hidden>
                                                                <img src="" name="question_image_file" class="question_image_file" width="300px" height="200px">
                                                            </div>
														<span class="question_image_view" hidden>
															<a href="javascript:void(0)" class="href1 remove_question_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a>
														</span>
                                                        </center>

                                                    </div>
                                                @endif



                                                <br>

                                                <div class="form-group row">

                                                    <div class="col-sm-4">
                                                        <select class="form-control multiselect answer_type" name="answer_type" disabled>
                                                            <option value="" disabled>Select Answer Type </option>
                                                            @if($current_question->answer_type == 1)
                                                                <option value="1" selected>Multiple choice</option>
                                                                <option value="2">Choose the best</option>
                                                                <option value="3">True or false</option>
                                                                <option value="4">Fill up the blanks</option>
                                                            @elseif($current_question->answer_type == 2)
                                                                <option value="1" >Multiple choice</option>
                                                                <option value="2" selected>Choose the best</option>
                                                                <option value="3">True or false</option>
                                                                <option value="4">Fill up the blanks</option>
                                                            @elseif($current_question->answer_type == 3)
                                                                <option value="1" selected>Multiple choice</option>
                                                                <option value="2">Choose the best</option>
                                                                <option value="3" selected>True or false</option>
                                                                <option value="4">Fill up the blanks</option>
                                                            @elseif($current_question->answer_type == 4)
                                                                <option value="1" selected>Multiple choice</option>
                                                                <option value="2">Choose the best</option>
                                                                <option value="3">True or false</option>
                                                                <option value="4" selected>Fill up the blanks</option>
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-4 col-xs-6 ">
                                                        <div class="form-group">
                                                            <label class="col-xs-6">Marks : </label>
                                                            <div class="col-xs-6">
                                                                <input type="number" name="marks" class="form-control" value="{!! $current_question->marks !!}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 col-xs-6">

                                                    </div>
                                                </div>

                                                @if($current_question->answer_type == 1)
                                                    <div class="form-group row answer_type1"  >

                                                        <div class="col-xs-12">

                                                            <div class="col-xs-12">
                                                                <div id="multiple-choice-options" class="multiple-choice-options">
																<span class="spn_answer_option_type1 pull-right">
																	<label for="qns">Option Type : </label>
																		<input type="checkbox" name="answer_option_type" class="answer_option_type1" value="1" checked="checked" disabled> Text

                                                                    @if($current_question->answer_option_type == 2)
                                                                        &nbsp;<input type="checkbox" name="answer_option_type" class="answer_option_type1" checked value="2" disabled> Image
                                                                    @else
                                                                        &nbsp;<input type="checkbox" name="answer_option_type" class="answer_option_type1" value="2"> Image
                                                                    @endif



																</span>
                                                                    <span class="help-block">Enter the answer choices, and mark which answers are correct</span>
                                                                    @foreach($current_question_answer as $key => $value)
                                                                    <div class="answer-option  new-answer-option{{$key}}">
                                                                        <div class="col-xs-12 option_margin_bottom">
                                                                            @if($value->answer_image)
                                                                            <center>
                                                                                <div class="option_image_view">
                                                                                    <img src="{!! $value->answer_image !!}" name="option_image_file" class="option_image_file" width="150px" height="150px">
                                                                                </div>
                                                                                <span class="remove_option_image"><a href="javascript:void(0)" class="href1 remove_option_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a></span>
                                                                            </center>
                                                                            @else
                                                                                <center>
                                                                                    <div class="option_image_view" hidden>
                                                                                        <img src="{!! $value->answer_image !!}" name="option_image_file" class="option_image_file" width="150px" height="150px">
                                                                                    </div>
                                                                                    <span class="remove_option_image" hidden><a href="javascript:void(0)" class="href1 remove_option_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a></span>
                                                                                </center>
                                                                            @endif
                                                                            <div class="input-group">

																			<span class="input-group-btn">

                                                                                @if($value->is_correct==1)
                                                                                    <input name="option_is_correct[]" class="option_is_correct"  value={{$key}} type="checkbox" checked="checked">
                                                                                @else
                                                                                    <input name="option_is_correct[]" class="option_is_correct"  value={{$key}} type="checkbox">
                                                                                @endif
                															</span>
                                                                                @if($current_question->answer_option_type != 2)
																				<span class="input-group-btn file_btn">
                                                                                        <span class="btn btn2 btn-file btn_option1 btn_file_margin" disabled>
																				Add option image <input type="file" name="update_option_image[]" class="option_image1 option_image_url" src="{!! $value->answer_image !!}">
																				</span>
																				</span>
                                                                                @endif
                                                                                <input type="hidden" name="qpqa_id[]" value="{!! $value->qpqa_id !!}">
                                                                                <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text">{!! $value->answer_text !!}</textarea>
																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                <center>
                                                                    <a href="javascript:void(0)" class="append_update_option_for1">Add</a> or
                                                                    <a href="javascript:void(0)" class="remove_option_for1">Remove</a> answer choice
                                                                </center>

                                                            </div>
                                                            <div class="col-xs-6"></div>

                                                        </div>

                                                    </div>
                                                @else
                                                <div class="form-group row answer_type1" hidden >

                                                    <div class="col-xs-12">

                                                        <div class="col-xs-12">
                                                            <div id="multiple-choice-options" class="multiple-choice-options">
																<span class="spn_answer_option_type1 pull-right">
																	<label for="qns">Option Type : </label>
																		<input type="checkbox" name="answer_option_type" class="answer_option_type1" value="1" checked="checked"> Text

                                                                    @if($current_question->answer_option_type == 2)
                                                                        <input type="checkbox" name="answer_option_type" class="answer_option_type1" value="2" checked="checked"> Image
                                                                    @else
                                                                        <input type="checkbox" name="answer_option_type" class="answer_option_type1" value="2"> Image
                                                                    @endif
																</span>
                                                                <span class="help-block">Enter the answer choices, and mark which answers are correct</span>
                                                                <div class="answer-option  new-answer-option0">
                                                                    <div class="col-xs-12 option_margin_bottom">
                                                                        <div class="input-group">

																			<span class="input-group-btn">
                    															<input name="option_is_correct[]" class="option_is_correct"  value="0" type="checkbox">
                															</span>
																				<span class="input-group-btn">
																				<span class="btn btn2 btn-file btn_option1 btn_file_margin" disabled>
																				Browse option image <input type="file" name="option_image[]" class="option_image1">
																				</span>
																				</span>
                                                                            <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea>
																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="answer-option  new-answer-option1">
                                                                    <div class="col-xs-12 option_margin_bottom">
                                                                        <div class="input-group">
																			<span class="input-group-btn">
                    															<input name="option_is_correct[]" class="option_is_correct"  value="1" type="checkbox">
                															</span>
																			<span class="input-group-btn">
                    														<span class="btn btn2 btn-file btn_option1 btn_file_margin" disabled>
                        														Browse option image <input type="file"  name="option_image[]" class="option_image1">
                   																 </span>
                															</span>
                                                                            <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1"  placeholder="Option text"></textarea>

																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="answer-option  new-answer-option2">

                                                                    <div class="col-xs-12 option_margin_bottom">
                                                                        <div class="input-group">
																			<span class="input-group-btn">
                    															<input name="option_is_correct[]" class="option_is_correct"  value="2" type="checkbox">
                															</span>
																			<span class="input-group-btn">
                    														<span class="btn btn2 btn-file btn_option1 btn_file_margin" disabled>
                        														Browse option image <input type="file"  name="option_image[]" class="option_image1">
                   																 </span>
                															</span>
                                                                            <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1"  placeholder="Option text"></textarea>

																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <center>
                                                                <a href="javascript:void(0)" class="append_option_for1">Add</a> or
                                                                <a href="javascript:void(0)" class="remove_option_for1">Remove</a> answer choice
                                                            </center>

                                                        </div>
                                                        <div class="col-xs-6"></div>

                                                    </div>

                                                </div>
                                                @endif

                                                @if($current_question->answer_type == 2)
                                                    <div class="form-group row answer_type2" >

                                                        <div class="col-xs-12">

                                                            <div class="col-xs-12">

                                                                <div id="choose-the-best" class="choose-the-best">
																<span class="spn_answer_option_type2 pull-right">
																	<label for="qns">Option Type : </label>
																		<input type="checkbox" name="answer_option_type" class="answer_option_type2" value="1" checked="checked"> Text
                                                                    @if($current_question->answer_option_type == 2)
                                                                        <input type="checkbox" name="answer_option_type" class="answer_option_type2" value="2" checked="checked"> Image
                                                                    @else
                                                                        <input type="checkbox" name="answer_option_type" class="answer_option_type2" value="2"> Image
                                                                    @endif
																</span>
                                                                    <span class="help-block">Enter the answer choices, and mark which answer is correct</span>

                                                                    @foreach($current_question_answer as $key => $value)
                                                                    <div class="answer-option new-answer-choice{{$key}}">
                                                                        <div class="col-xs-12 option_margin_bottom">

                                                                            @if($value->answer_image)
                                                                                <center>
                                                                                    <div class="option_image_view">
                                                                                        <img src="{!! $value->answer_image !!}" name="option_image_file" class="option_image_file" width="150px" height="150px">
                                                                                    </div>
                                                                                    <span class="remove_option_image"><a href="javascript:void(0)" class="href1 remove_option_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a></span>
                                                                                </center>
                                                                            @else
                                                                                <center>
                                                                                    <div class="option_image_view" hidden>
                                                                                        <img src="{!! $value->answer_image !!}" name="option_image_file" class="option_image_file" width="150px" height="150px">
                                                                                    </div>
                                                                                    <span class="remove_option_image" hidden><a href="javascript:void(0)" class="href1 remove_option_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a></span>
                                                                                </center>
                                                                            @endif

                                                                            <div class="input-group">

																			<span class="input-group-btn" >
                    															@if($value->is_correct==1)
                                                                                    <input name="option_is_correct[]" class="option_is_correct" required value={{$key}} type="radio" checked="checked">
                                                                                @else
                                                                                    <input name="option_is_correct[]" class="option_is_correct" required value={{$key}} type="radio">
                                                                                @endif
                															</span>
                                                                                @if($current_question->answer_option_type != 2)
                                                                                    <span class="input-group-btn file_btn">
                                                                                        <span class="btn btn2 btn-file btn_option2 btn_file_margin" disabled>
																				Add option image <input type="file" name="update_option_image[]" class="option_image2 option_image_url" src="{!! $value->answer_image !!}">
																				</span>
																				</span>
                                                                                @endif
                                                                                <input type="hidden" name="qpqa_id[]" value="{!! $value->qpqa_id !!}">
                                                                                <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text">{!! $value->answer_text !!}</textarea>
																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    @endforeach

                                                                </div>
                                                                <center>
                                                                    <a href="javascript:void(0)" class="append_option_for2">Add</a> or
                                                                    <a href="javascript:void(0)" class="remove_option_for2">Remove</a> answer choice
                                                                </center>
                                                            </div>
                                                            <div class="col-xs-6"></div>

                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="form-group row answer_type2" hidden >

                                                        <div class="col-xs-12">

                                                            <div class="col-xs-12">

                                                                <div id="choose-the-best" class="choose-the-best">
																<span class="spn_answer_option_type2 pull-right">
																	<label for="qns">Option Type : </label>
																		<input type="checkbox" name="answer_option_type" class="answer_option_type2" value="1" checked="checked"> Text
                                                                    @if($current_question->answer_option_type == 2)
                                                                        <input type="checkbox" name="answer_option_type" class="answer_option_type2" value="2" checked="checked"> Image
                                                                    @else
                                                                        <input type="checkbox" name="answer_option_type" class="answer_option_type2" value="2"> Image
                                                                    @endif
																</span>
                                                                    <span class="help-block">Enter the answer choices, and mark which answer is correct</span>
                                                                    <div class="answer-option new-answer-choice0">
                                                                        <div class="col-xs-12 option_margin_bottom">
                                                                            <div class="input-group">

																			<span class="input-group-btn" >
                    															<input name="option_is_correct[]" class="option_is_correct" required value="0" type="radio">
                															</span>
																			<span class="input-group-btn">
                    														<span class="btn btn2 btn-file btn_option2 btn_file_margin" disabled>
                        														Browse option image <input type="file"  name="option_image[]" class="option_image2">
                   																 </span>
                															</span>
                                                                                <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea>
																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="answer-option new-answer-choice1">
                                                                        <div class="col-xs-12 option_margin_bottom">
                                                                            <div class="input-group">

																			<span class="input-group-btn">
                    															<input name="option_is_correct[]" class="option_is_correct" required value="1" type="radio">
                															</span>
																			<span class="input-group-btn" >
                    														<span class="btn btn2 btn-file btn_option2 btn_file_margin" disabled>
                        														Browse option image <input type="file"  name="option_image[]" class="option_image2">
                   																 </span>
                															</span>
                                                                                <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea>
																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="answer-option new-answer-choice2">
                                                                        <div class="col-xs-12 option_margin_bottom">
                                                                            <div class="input-group">

																			<span class="input-group-btn">
                    															<input name="option_is_correct[]" class="option_is_correct" required value="2" type="radio">
                															</span>
																			<span class="input-group-btn" >
                    														<span class="btn btn2 btn-file btn_option2 btn_file_margin" disabled>
                        														Browse option image <input type="file"  name="option_image[]" class="option_image2">
                   																 </span>
                															</span>
                                                                                <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1" placeholder="Option text"></textarea>
																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <center>
                                                                    <a href="javascript:void(0)" class="append_option_for2">Add</a> or
                                                                    <a href="javascript:void(0)" class="remove_option_for2">Remove</a> answer choice
                                                                </center>
                                                            </div>
                                                            <div class="col-xs-6"></div>

                                                        </div>

                                                    </div>
                                                @endif

                                                @if($current_question->answer_type == 3)
                                                    <div class="form-group row answer_type3"  >

                                                        <div class="col-xs-12">

                                                            <div class="col-xs-12">
                                                                <span class="help-block">Mark the correct answer</span>
                                                                @if($current_question_answer[0]->answer_text == 1)
                                                                    <input type="radio" name="option_text[]" required class="true_false option_is_correct" value="1" checked> True<br>
                                                                    <input type="radio" name="option_text[]" required class="true_false option_is_correct" value="0"> False
                                                                @elseif($current_question_answer[0]->answer_text == 0)
                                                                    <input type="radio" name="option_text[]" required class="true_false option_is_correct" value="1"> True<br>
                                                                    <input type="radio" name="option_text[]" required class="true_false option_is_correct" value="0" checked> False
                                                                @endif
                                                                <input type="hidden" name="qpqa_id[]" value="{!! $current_question_answer[0]->qpqa_id !!}">
                                                                <input type="hidden" value="0" name="option_is_correct[]" class="option_is_correct" required class="option_is_correct3"/>
                                                            </div>
                                                            <div class="col-xs-6"></div>

                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="form-group row answer_type3" hidden >

                                                        <div class="col-xs-12">

                                                            <div class="col-xs-12">
                                                                <span class="help-block">Mark the correct answer</span>
                                                                <input type="radio" name="option_text[]" required class="true_false option_is_correct" value="1"> True<br>
                                                                <input type="radio" name="option_text[]" required class="true_false option_is_correct" value="0"> False
                                                                <input type="hidden" value="0" name="option_is_correct[]" class="option_is_correct" required class="option_is_correct3"/>
                                                            </div>
                                                            <div class="col-xs-6"></div>

                                                        </div>

                                                    </div>
                                                @endif

                                                @if($current_question->answer_type == 4)
                                                    <div class="form-group row answer_type4">

                                                        <div class="col-xs-12">

                                                            <div class="col-xs-12">

                                                                <div id="fill_in_the_blanks" class="fill_in_the_blanks">
                                                                    <span class="help-block">Enter the correct answers</span>
                                                                    @foreach($current_question_answer as $key => $value )
                                                                    <div class="answer-option">

                                                                        <div class="col-xs-12 option_margin_bottom">

                                                                            <div class="input-group">

																			<span class="input-group-btn">
                    															<input name="option_is_correct[]" class="option_is_correct" required value="0" type="checkbox" checked disabled>
                															</span>
                                                                                <input type="hidden" name="qpqa_id[]" value="{!! $value->qpqa_id !!}">
                                                                                <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1">{!! $value->answer_text !!}</textarea>
																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                <input name="option_is_correct[]" class="option_is_correct" required value="0" type="hidden">
                                                                <center>
                                                                    <a href="javascript:void(0)" class="append_option_for4">Add</a> or
                                                                    <a href="javascript:void(0)" class="remove_option_for4">Remove</a> answer choice
                                                                </center>
                                                            </div>
                                                            <div class="col-xs-6"></div>

                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="form-group row answer_type4" hidden>

                                                        <div class="col-xs-12">

                                                            <div class="col-xs-12">

                                                                <div id="fill_in_the_blanks" class="fill_in_the_blanks">
                                                                    <span class="help-block">Enter the correct answers</span>
                                                                    <div class="answer-option">

                                                                        <div class="col-xs-12 option_margin_bottom">

                                                                            <div class="input-group">

																			<span class="input-group-btn">
                    															<input name="option_is_correct[]" class="option_is_correct" required value="0" type="checkbox" checked disabled>
                															</span>

                                                                                <textarea name="option_text[]" required cols="40" rows="10" class="form-control answer-option1"></textarea>
																			<span class="input-group-btn">
                    															<span class="btn btn-danger remove_this_option">
                        															<span class="glyphicon glyphicon-remove"></span>
                    															</span>
                															</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input name="option_is_correct[]" class="option_is_correct" required value="0" type="hidden">
                                                                <center>
                                                                    <a href="javascript:void(0)" class="append_option_for4">Add</a> or
                                                                    <a href="javascript:void(0)" class="remove_option_for4">Remove</a> answer choice
                                                                </center>
                                                            </div>
                                                            <div class="col-xs-6"></div>

                                                        </div>

                                                    </div>
                                                @endif

                                                <center>
                                                    <button type="submit" class="btn btn2 submit_btn">Save</button>
                                                    <button type="submit" name="action_page" value="1" class="btn btn1 submit_btn">Save & proceed</button>
                                                    <button class="btn" type="reset">Cancel</button>
                                                </center>
                                                </form>
                                            </div>

                                        </div>


                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="panel-group panel-group1" >
                    <div class="panel panel-default">
                        <div class="panel-heading panelcolor1">
                            <h4 class="panel-title">
                                Question Paper Details
                            </h4>
                        </div>
                        <div  class="panel-collapse collapse in">
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-xs-12 ">
                                        <!--http://stackoverflow.com/questions/18325779/bootstrap-3-collapse-show-state-with-chevron-icon-->
                                        <div class="panel-group" id="accordion">

                                            @foreach($section_details as $key => $value)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panelcolor2">
                                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#{!! "section".$key !!}">
                                                            <h4 class="panel-title">Section {!! $value -> section_value !!} details</h4>
                                                        </a>
                                                    </div>
                                                    @if($question_details['section_id'] == $value->section_value)
                                                        <div id="{!! "section".$key !!}" class="panel-collapse collapse in">
                                                            @else
                                                                <div id="{!! "section".$key !!}" class="panel-collapse collapse">
                                                                    @endif
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <a href="/index.php/{!!$value->qp_id !!}/admin/edit_section/{!!$value->section_id !!}" class="href1"><i class="fa fa-pencil-square-o"></i> Edit </a>
                                                                            </div>
                                                                            <div class="col-xs-6">
                                                                                <a data-toggle="modal" data-target="#{!! 'view'.$value->section_id !!}"  class="href1 delete_section_href" id="{!!$value->section_id !!}"><i class="fa fa-eye"></i> Show all details </a>
                                                                            </div>
                                                                        </div>
                                                                        <hr>

                                                                        @for($x = 1; $x <= $value -> number_of_questions_section; $x++)
                                                                            @if(($question_details['section_id'] == $value->section_value)&&($question_details['question_id'] == $x))
                                                                                <a href="/index.php/{{$value -> qp_id}}/admin/set_questions/{{$value->section_value}}/{{$x}}" class='btn btn-circle btn-primary'>{{$x}}</a>
                                                                            @elseif(in_array($x,$value ->finished_questions))
                                                                                <a href="/index.php/{{$value -> qp_id}}/admin/set_questions/{{$value->section_value}}/{{$x}}" class='btn btn-circle btn-success'>{{$x}}</a>
                                                                            @else
                                                                                <a href="/index.php/{{$value -> qp_id}}/admin/set_questions/{{$value->section_value}}/{{$x}}" class='btn btn-circle btn-danger'>{{$x}}</a>
                                                                            @endif
                                                                        @endfor

                                                                        <div class="modal fade" id="{!! 'view'.$value->section_id !!}" role="dialog">
                                                                            <div class="modal-dialog">

                                                                                <!-- Modal content-->
                                                                                <div class="modal-content">

                                                                                    <div class="modal-body">

                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-6">Section Type :</label>
                <span class="col-xs-6">
                    @if ($value -> section_type == 1)
                        Options / Fill blanks
                    @else
                        Comprehension / Based on paragraph
                    @endif
                </span>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-6">Subject :</label>
                                                                                            <span class="col-md-6">{!! $value -> section_subject !!}</span>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-6">Chapter :</label>
                                                                                            <span class="col-md-6">{!! $value -> section_chapter !!}</span>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-6">No.of.Questions :</label>
                                                                                            <span class="col-md-6">{!! $value -> number_of_questions_section !!}</span>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-6">Marks/Question :</label>
                                                                                            <span class="col-md-6">{!! $value -> marks_per_question !!}</span>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-md-6">Total Marks:</label>
                                                                                            <span class="col-md-6">{!! $value -> section_total !!}</span>
                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        @endforeach

                                                </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button class="btn btn-circle btn-success"></button> - <label>Finished </label>
                                        </div>
                                        <div class="col-xs-6">
                                            <button class="btn btn-circle btn-danger"></button> - <label>Pending </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button class="btn btn-circle btn-primary"></button> - <label>Editing</label>
                                        </div>
                                        <div class="col-xs-6">

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-12">
                                            <span class="help-block">( Rounded button in each section states the currents status of question number ) </span>
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