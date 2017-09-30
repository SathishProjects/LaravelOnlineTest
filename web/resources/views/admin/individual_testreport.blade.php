@extends('layouts.page')
@section('content')
    <style>
        a{
            color:black;
        }

    </style>
    <div class="homecontainer container">
        <div class="row">
            <ul class="breadcrumb margintop1">
                <li><a href="/index.php/admin/test/active">Home</a></li>
                <li><a href="#" onclick="window.history.go(-1); return false;">Back</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8"  style="overflow-x: auto">

            <p>
                <div class="row">
                <div class="col-md-6"><span class="pull-right">Name : </span></div>
                <div class="col-md-6">{!! $test_log[0]->name !!}</div>
                </div>
                <div class="row">
                <div class="col-md-6"><span class="pull-right">Login time : </span></div>
                <div class="col-md-6">
                    <?php
                    $date1 = date_create($test_log[0]->login_time);
                    echo date_format($date1, 'jS M y - g:i:s A');
                    ?>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6"><span class="pull-right">Logout time : </span></div>
                <div class="col-md-6">
                    @if($test_log[0]->logout_time != null)
                    <?php
                    $date2 = date_create($test_log[0]->logout_time);
                    echo date_format($date2, 'jS M y - g:i:s A');
                    ?>
                    @else
                    -
                    @endif
                </div>
                </div>
                <div class="row">
                <div class="col-md-6"><span class="pull-right">Duration : </span></div>
                <div class="col-md-6">
                    @if($test_log[0]->logout_time)
                        <?php
                        $t1 = $test_log[0]->login_time;
                        $t2 = $test_log[0]->logout_time;
                        $from_time = strtotime($t1);
                        $to_time = strtotime($t2);
                        echo round(abs($to_time - $from_time) / 60,2). " Mins";
                        ?>
                    @else
                        {{'-'}}
                    @endif
                </div>
                </div>
            </p>

            <p><b>Summary :</b></p>
            <table class="table table-bordered">
                <thead>
                <th>Section</th>
                <th>No.of.Qns</th>
                <th>Correct</th>
                <th>Incorrect</th>
                <th>Not attended</th>
                <th>Marks</th>
                </thead>
                <tbody>
                <?php
                $total_section_questions_count = 0;$total_correct_questions_count = 0;$total_incorrect_questions_count = 0;$total_na_questions_count = 0;
                ?>
                @foreach($subject as $skey => $sval)
                    <tr>
                        <td>{!! $sval !!}</td>
                        <td>
                            <?php $section_questions_count = 0; ?>
                            @foreach($Question_records as $qrkey1 => $qrval1)
                                @if($qrval1->section_subject == $sval)
                                        <?php $section_questions_count++; ?>
                                @endif
                            @endforeach
                                <?php $total_section_questions_count = $total_section_questions_count + $section_questions_count;?>
                                {!!  $section_questions_count !!}
                        </td>
                        <td>
                            <?php
                            $correct_questions_count = 0;$incorrect_questions_count = 0;$na_questions_count = 0;
                            ?>

                            @foreach($Question_records as $qrkey2 => $qrval2)
                                @if(in_array($qrval2->qpq_id,$responded_questions) && $qrval2->section_subject == $sval)
                                    @foreach($student_answer as $sakey_1 => $saval_1 )
                                            @if($saval_1->qpq_id == $qrval2->qpq_id && $saval_1->is_correct == 1)
                                                <?php $correct_questions_count++;?>
                                            @endif
                                            @if($saval_1->qpq_id == $qrval2->qpq_id && $saval_1->is_correct == 0)
                                                    <?php $incorrect_questions_count++;?>
                                            @endif
                                    @endforeach
                                @elseif($qrval2->section_subject == $sval)
                                        <?php $na_questions_count++;?>
                                @endif
                            @endforeach

                            <?php $total_correct_questions_count = $total_correct_questions_count + $correct_questions_count;?>
                            {!!  $correct_questions_count !!}
                        </td>
                        <td>
                            <?php $total_incorrect_questions_count = $total_incorrect_questions_count + $incorrect_questions_count;?>
                            {!!  $incorrect_questions_count !!}
                        </td>
                        <td>
                            <?php $total_na_questions_count = $total_na_questions_count + $na_questions_count;?>
                            {!!  $na_questions_count !!}
                        </td>
                        <td>
                            {!!  $correct_questions_count !!}
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <td><b>Total :</b></td>
                        <td>{!! $total_section_questions_count !!}</td>
                        <td>{!! $total_correct_questions_count !!}</td>
                        <td>{!! $total_incorrect_questions_count !!}</td>
                        <td>{!! $total_na_questions_count !!}</td>
                        <td>{!! $total_correct_questions_count !!}</td>
                    </tr>
                </tbody>
            </table>

            <p><b>Detailed result:</b></p>
            <table class="table table-bordered">
                <thead>
                <th>Section</th>
                <th>Question</th>
                <th>Result</th>
                </thead>
                <tbody>
                <?php $question=1;$alphabet = range('A', 'Z'); ?>
                @foreach($subject as $sbk => $sbv)
                    <?php $question=1; ?>
                    @foreach($Section_records as $srk => $srv)
                        @if($srv->section_subject == $sbv)
                            @foreach($Question_records as $qrk => $qrv)
                                @if(in_array($qrv->qpq_id,$responded_questions))
                                    @foreach($student_answer as $sak => $sav)
                                        @if($sav->qpq_id == $qrv->qpq_id && $sav->section_id == $srv->section_id)
                                            <tr>
                                                <td>{!! $alphabet[$sbk] !!}</td>
                                                <td>
                                                    <?php echo 'Q.'.$question;$question=$question+1;?>
                                                </td>
                                                <td>
                                                    @if($sav->qpq_id == $qrv->qpq_id)
                                                        @if($sav->is_correct)
                                                            <i class="fa fa-check"></i>
                                                        @else
                                                            <i class="fa fa-times"></i>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @elseif($srv->section_id == $qrv->section_id)
                                    <tr>
                                        <td>{!! $alphabet[$sbk] !!}</td>
                                        <td>
                                            <?php echo 'Q.'.$question;$question=$question+1;?>
                                        </td>
                                        <td>
                                            <i class="fa fa-times"></i>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endforeach
                </tbody>
            </table>

            </div>
            <div class="col-md-2"></div>
        </div>

    </div>

@stop


