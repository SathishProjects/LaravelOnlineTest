<?php namespace App\Http\Controllers;

use JWTAuth;
use Redirect;
use Carbon;
use App\DegreeType;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuestionPaperMaster;
use App\QuestionPaperSubjectMaster;
use App\SectionMaster;
use App\SubjectMaster;
use App\QuestionPaperQuestionsMaster;
use App\QuestionPaperQuestionAnswersMaster;
use App\BatchMaster;
use App\TestLoginMaster;
use App\TestMaster;
use App\Users;
use App\CandidateEducationDetail;
use App\TestResponseMaster;
use App\TestReportMaster;
use App\StudentTestLoginMaster;
use App\TestAdminFeedbackMaster;
use App\TestStudentFeedbackMaster;
use App\CandidateMaster;
use Illuminate\Support\Facades\Input;

use Cache;

class AdminController extends Controller {
    /**
     * authentication
     */
    public function __construct() {
       // $this->middleware('auth');
    }

    /**
    * Company Registration
    * @param Request $request
    * @return type JSON
    */


    }


    