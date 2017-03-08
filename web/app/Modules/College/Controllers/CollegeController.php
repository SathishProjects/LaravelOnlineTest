<?php namespace App\Modules\College\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Response;

use Maatwebsite\Excel\Facades\Excel;

use Cache;




class CollegeController extends Controller {   

    public function __construct(Store $session) {
        $this->session = $session;
       
    }
  
public function AddCollege()
    {

         $API = App::make('APIService');

         $API->request('/college/get_collegesignup_details', "GET");

         
         $university_records = $API->responseJSON()->university_records;

         $state_records = $API->responseJSON()->state_records;


       return view('college.college_register')

       ->with('university_records',$university_records)
       ->with('state_records',$state_records);
    }


public function submit_signup(Request $request)
    {

	 $API = App::make('APIService');

     $API->request('/college/submit_signup', "POST",$request->all());

     $reponseMessage = $API->responseJSON()->reponseMessage;
     $reponseType = $API->responseJSON()->reponseMessage;

     if($reponseType == 'success'){
     	$this->session->set('message',$reponseMessage);
     }
     else{
     	$this->session->set('error',$reponseMessage);	
     }
     

     return redirect('/');


	}

    public function batch_details($id,Request $request)
    {

        
        if($id == 'active'){
        $request['status']= 1;
        }
        elseif($id == 'finished'){
        $request['status']= 3;
        }

        if($id == 'year'){
        $request['status']= 1;
        }
        elseif($id == 'degree'){
        $request['status']= 2;
        }

        $request['college_id'] = $this->session->get('user_authenticated.reg_id');

        $API = App::make('APIService');

        $API->request('/college/dashboard_batch_details', "POST", $request->all());

        

        $tmp = $API->responseJSON()->batch;

        $count2 = $API->responseJSON()->count2;

        $year = [];$batch_tmp = [];$batch_year_temp = [];$batch = [];$degree = [];$branch = [];$degree_tmp = [];$branch_tmp = [];

        foreach ($tmp as $bk => $bv) {
            if(!in_array($bv->batch_year, $batch)){
                $batch[] = $bv->batch_year;    
            }

            $year[$bk]['course'] = $bv->course;
            $year[$bk]['course_id'] = $bv->batch_branch;
            $year[$bk]['batch'] = $bv->batch; 
            $year[$bk]['batch_id'] = $bv->batch_id; 

        }

        foreach ($batch as $dk => $dv) {
            foreach ($tmp as $bk => $bv) {

            if(!in_array($bv->degree, $degree_tmp) && ($bv->batch_year == $dv)){
                $degree[$bk]['year'] = $bv->batch_year;
                $degree[$bk]['batch'] = $bv->batch;
                $degree[$bk]['degree'] = $bv->degree;    

                $degree_tmp[] = $bv->degree;    
            }
        }
        }

        foreach ($degree_tmp as $dtk => $dtv) {
            foreach ($tmp as $bk => $bv) {

            if(!in_array($bv->course, $branch_tmp) && ($bv->degree == $dtv)){
                
                $branch[$bk]['degree'] = $bv->degree;
                $branch[$bk]['branch'] = $bv->course; 
                $branch[$bk]['course_id'] = $bv->batch_branch;   

                $branch_tmp[] = $bv->course;    
            }
        }
        }

// dd($degree[0]['year']);
        return view('admin.testboard')
        
        ->with('degree',$degree)
        ->with('branch',$branch)
        ->with('year',$year)

        ->with('count2',$count2)
        ->with('status',$id);
    }

public function questionboard($id,Request $request)
    {
        if($id == 'active'){
        $request['status']= 1;
        }
        elseif($id == 'inactive'){
        $request['status']= 0;
        }
        elseif($id == 'finished'){
        $request['status']= 2;
        }

        if(!isset($request['action'])){
            if($request['action']!='>')
        $request['action']='>';
        
        }

        if(!isset($request['action_value'])){
            if($request['action_value']!='0')
        $request['action_value']='0';
        
        }

        if(!isset($request['search_key'])){
            if($request['search_key']!='%%')
        $request['search_key']='%%';
        
        }   

        $request['college_id'] = $this->session->get('user_authenticated.reg_id');

        $API = App::make('APIService');
        $API->request('/college/dashboard_questionpaper_details', "POST", $request->all());
// dd($API->responseJSON());
        
        $count2 = $API->responseJSON()->count2;

        $qp_details=$API->responseJSON()->qp_details;

        $first = $API->responseJSON()->first_last[0]->first;
        $last = $API->responseJSON()->first_last[0]->last;

        if($qp_details){

        $first_action_value=$qp_details[0]->id;
        $last_action_value=$qp_details[count($qp_details)-1]->id;

        }

          if(isset($_SERVER['QUERY_STRING']))
        {
            parse_str( $_SERVER['QUERY_STRING'], $queryString);

                $queryString['action'] = '<';
                
                if(isset($first_action_value)){
                $queryString['action_value'] = $first_action_value;
                }
                else{unset($queryString['action_value']);}
                
                $queryString['search_key'] = $request['search_key']; 
                $queryString['status'] = $request['status']; 
                $previous = sprintf( "?%s", http_build_query($queryString));

                $queryString['action'] = '>';

                if(isset($first_action_value)){
                $queryString['action_value'] = $last_action_value;
                }
                else{unset($queryString['action_value']);}
                
                $queryString['search_key'] = $request['search_key']; 
                $queryString['status'] = $request['status']; 
                $next = sprintf( "?%s", http_build_query($queryString));

                $queryString['action'] = '>';
                $queryString['action_value'] = 0;
                $queryString['status'] = $request['status']; 
                $search_query = sprintf( "?%s", http_build_query($queryString));
        }

         if(!isset($first_action_value)){
            $first_action_value = 0;
         }
         if(!isset($last_action_value)){
            $last_action_value = 0;
         }

        return view('admin.questionboard')
        
        ->with('count2',$count2)
        ->with('status',$id)
        ->with('total_records',$last)
        ->with('first_action_value',$first_action_value)
        ->with('last_action_value',$last_action_value)
        ->with('previous',$previous)
        ->with('next',$next)
        ->with('search_key',$request['search_key'])->with('qp_details',$qp_details);
    }

    public function create_question()
    {
       
        return view('admin.create_questionpaper');
    }

    public function set_questionpaper(Request $request)
    {
        
        $request['college_id'] = $this->session->get('user_authenticated.reg_id');

        $API = App::make('APIService');
        $API->request('/college/set_questionpaper', "POST", $request->all());

        if( $API->responseJSON()->responseType == "success" ){
            $questionpaper = $API->responseJSON()->id;

            return redirect($questionpaper.'/college/'.'set_section');

        }
        else{
            dd($API->responseJSON());
        }
    }

    public function set_section($id, Request $request)
    {
        
        $API = App::make('APIService');
        $API->request('/college/get_questionpaper_detail', "POST", $id);       

        $details = $API->responseJSON()->qp_details[0];
        $subject = $API->responseJSON()->subject;
        $section = $API->responseJSON()->section;

        // DD($API->responseJSON());

        return view('admin.create_sections')->with('details',$details)->with('subject',$subject)->with('section',$section);
    }

    public function add_section(Request $request)
    {


        if(isset($request['question_image'])){
            $image = Input::file('question_image');
        }

        $action = $request['action'];
        unset($request['action']);
        
        $API = App::make('APIService');
        $API->request('/college/add_section', "POST",$request->all());
        
        $section_id = $API->responseJSON()->id;

        // Begin question image upload
        
        


        if (isset($image)) {
            
            
            $name = $section_id;

            $filename  =$name . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path().'\testengine\question_paper\QP_'.$request['qp_id'].'\QPSection_'.$section_id;

            $destinationPath1 = '\testengine\question_paper\QP_'.$request['qp_id'].'\QPSection_'.$section_id;
            
            $a = '\\'; 

            $question =  "{$destinationPath1}{$a}{$filename}";

            Input::file('question_image')->move($destinationPath, $filename); 

            $image_url['question_image'] =  $question;

            $image_url['section_id'] =  $section_id;  

            $API = App::make('APIService');

            $API->request('/college/update_section_image_url', "POST", $image_url);

        }

        // End of question image upload

        if($action == 2)
            return redirect($request['qp_id'].'/college/'.'set_section');
        else{
            return redirect($request['qp_id'].'/college/'.'set_questions/1/1');
        }
        
    }

    public function set_question($id1,$id2,$id3,Request $request)
    {

// dd(123);exit;
        $API = App::make('APIService');

        $API->request('/college/get_questionpaper_detail2', "POST", [$id1,$id2,$id3]);

$tmp_data = $API->responseJSON();

        $qp_details = json_decode($tmp_data->qp_details);
        $qp_details = $qp_details[0];
        $section_details = json_decode($tmp_data->section);
        $finished = json_decode($tmp_data->finished_questions);

       $tmp=[];

// dd($section_details);exit;

        foreach ($section_details as $key => $value) {


            $val = $value->finished_questions;
            foreach ( $val as $key1 => $value1) {
                $tmp[]=$value1->qpq_order_id;
            }

            $value->finished_questions = $tmp;$tmp=[];
        }
// dd($section_details);exit;
      

       $current_question_tmp =  json_decode($tmp_data->current_question);
       // $current_question_tmp = json_decode($current_question_tmp);

// $current_question_tmp = $current_question_tmp->toArray();
// dd(123);exit;

        if(count($current_question_tmp->question)){
            $current_question = $current_question_tmp->question[0];
        }else{
          $current_question = null;  
        }


//    dd($current_question);exit;

        if(count($current_question_tmp->option)){
        $current_question_answer = $current_question_tmp->option;
        }
        else{
            $current_question_answer = null;
        }



        $question_details = ['section_id'=>$id2,'question_id'=>$id3];

 // 
        
        if(($current_question != null) && ($current_question_answer != null)){


        return view('admin.update_question')->with('qp_details',$qp_details)->with('section_details',$section_details)
        ->with('finished',$finished)->with('question_details',$question_details)->with('current_question',$current_question)->with('current_question_answer',$current_question_answer);
        }
        else{
            // dd($section_details);exit;
        return view('admin.set_question')->with('qp_details',$qp_details)->with('section_details',$section_details)
        ->with('finished',$finished)->with('question_details',$question_details);
        }
    }

    public function edit_section($id1,$id2 ,Request $request)
    {

        $API = App::make('APIService');
        $API->request('/college/get_questionpaper_detail', "POST",$id1);

        

        $details = $API->responseJSON()->qp_details[0];
        $subject = $API->responseJSON()->subject;
        $section = $API->responseJSON()->section;

        $API = App::make('APIService');
        $API->request('/college/get_section_chapter', "POST",$id2);

        $section_chapter = $API->responseJSON();

        return view('admin.edit_section')->with('details',$details)->with('subject',$subject)
        ->with('section',$section)->with('editable_section',$id2)->with('section_chapter',$section_chapter);

    }

    public function edit_section1($id, Request $request)
    {
        
        $API = App::make('APIService');
        $API->request('/college/get_questionpaper_detail', "POST", $id);

       

        $details = $API->responseJSON()->qp_details[0];
        $subject = $API->responseJSON()->subject;
        $section = $API->responseJSON()->section;

        return view('admin.edit_sections_1')->with('details',$details)->with('subject',$subject)->with('section',$section);
    }  

    public function update_section(Request $request)
    {
        
       $action = $request['action'];
        unset($request['action']);
        
        $API = App::make('APIService');
        $API->request('/college/update_section', "POST",$request->all());

        $section_id = $request['section_id'];

        // Begin question image upload
        if(isset($request['question_image'])){
        $image = Input::file('question_image');
        }


        if (isset($image)) {
            
            
            $name = $section_id;

            $filename  =$name . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path().'\testengine\question_paper\QP_'.$request['qp_id'].'\QPSection_'.$section_id;

            $destinationPath1 = '\testengine\question_paper\QP_'.$request['qp_id'].'\QPSection_'.$section_id;
            
            $a = '\\'; 

            $question =  "{$destinationPath1}{$a}{$filename}";

            Input::file('question_image')->move($destinationPath, $filename); 

            $image_url['question_image'] =  $question;

            $image_url['section_id'] =  $section_id;  

            $API = App::make('APIService');

            $API->request('/college/update_section_image_url', "POST", $image_url);

        }

        // End of question image upload

        if($action == 2)
            return redirect($request['qp_id'].'/college/'.'set_section');
        else{
           return redirect($request['qp_id'].'/college/'.'set_questions/1/1');
        }
        
    }

    public function edit_questionpaper($id, Request $request)
    {
        $API = App::make('APIService');
        $API->request('/college/edit_questionpaper', "POST",$id);

        $details = $API->responseJSON()->details[0];

        return view('admin.edit_questionpaper')->with('details',$details);
    }

    public function update_questionpaper($id, Request $request)
    {

        $request['qp_id']=$id;
       $API = App::make('APIService');
        $API->request('/college/update_questionpaper', "POST",$request->all());

        if (200 == $API->responseStatusCode()) {
               return redirect($id.'/college/'.'edit_section');
            }
        else{
            dd("Failure");
        }
    }

    public function add_question(Request $request)
    {   

       $API = App::make('APIService');

        $API->request('/college/add_question', "POST", $request->all());

        $maximum_id= $API->responseJSON()->maximum_section[0]->id;

        $section = $API->responseJSON()->section;
        
        foreach ($section as $key => $value) {
            
            if($value->section_id == $request['section_id']){

            if($request['qpq_order_id'] < $value->number_of_questions_section){
                $next_section =$request['section_order_id']; 
                $next_question=$request['qpq_order_id']+1;
            }
            else{
                if($request['section_id'] != $maximum_id){
                $next_section =$request['section_order_id']+1; 
                $next_question=1;   
                }
                else{
                    $next_section =1; 
                    $next_question=1;  
                }
            }

            }
        }
            

        // Begin question image upload
        if(isset($request['question_image'])){
        $image = Input::file('question_image');
        }

        if (isset($image)) {
            
            
            $name = $API->responseJSON()->question_id;

            $filename  =$name . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path().'\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$API->responseJSON()->question_id.'\question';

            $destinationPath1 = '\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$API->responseJSON()->question_id.'\question';
            
            $a = '\\'; 

            $question =  "{$destinationPath1}{$a}{$filename}";

          Input::file('question_image')->move($destinationPath, $filename); 
        }

        // End of question image upload


        // Begin options image upload

          $option = ($API->responseJSON()->answer_id);  

          if(isset($request['option_image'])){

                $files = Input::file('option_image');
            }

          if (isset($image)) {
    
          $file_count = count($files);
          
          foreach($files as $key=>$file1) {
      if($file1!=null){
            $filename = $option[$key].'.'.$file1->getClientOriginalExtension();

            $destinationPath = public_path().'\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$API->responseJSON()->question_id.'\options';
            
            $destinationPath2 = '\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$API->responseJSON()->question_id.'\options';

            $a = '\\'; 

            $options[] =  "{$destinationPath2}{$a}{$filename}";

            $file1->move($destinationPath, $filename);
            
            }}} 

        // End of options image upload

            if (isset($question)) {

            $image_url['question'] =  $question;

             $image_url['question_id'] =  $API->responseJSON()->question_id;  

        }

        if (isset($options)) {

             $image_url['options'] =  $options;  

             $image_url['answer_id'] =  ($API->responseJSON()->answer_id);   

        }

            
        if (isset($image_url)) {

            $API = App::make('APIService');

        $API->request('/college/set_question_option_image_url', "POST", $image_url);
        }
                 

        return redirect($request['qp_id'].'/college/'.'set_questions/'.$next_section.'/'.$next_question );

        }

    public function update_question(Request $request)
    {   

        $action_page=0;

        if(isset($request['action_page'])){
            $action_page = $request['action_page'];
            unset($request['action_page']);
        }

        $API = App::make('APIService');

        $API->request('/college/update_question', "POST", $request->all());

        $maximum_id=$API->responseJSON()->maximum_section[0]->id;

        $section = $API->responseJSON()->section;
        
        foreach ($section as $key => $value) {
            
            if($value->section_id == $request['section_id']){

            if($request['qpq_order_id'] < $value->number_of_questions_section){
                $next_section =$request['section_order_id']; 
                $next_question=$request['qpq_order_id']+1;
            }
            else{
                if($request['section_id'] != $maximum_id){
                $next_section =$request['section_order_id']+1; 
                $next_question=1;   
                }
                else{
                    $next_section =1; 
                    $next_question=1;  
                }
            }

            }
        }

        $update_id = $API->responseJSON()->updated_answer_id;
        $new_id = $API->responseJSON()->created_answer_id;
        $qn_id = $API->responseJSON()->question_id;



          // Begin question image upload
        if(isset($request['question_image'])){
        $image = Input::file('question_image');}


        if (isset($image)) {
            
            
            $name = $API->responseJSON()->question_id;

            $filename  =$name . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path().'\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$API->responseJSON()->question_id.'\question';

            $destinationPath1 = '\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$API->responseJSON()->question_id.'\question';
            
            $a = '\\'; 

            $question =  "{$destinationPath1}{$a}{$filename}";

            Input::file('question_image')->move($destinationPath, $filename); 

            $image_url['question_image'] =  $question;

            $image_url['qpq_id'] =  $API->responseJSON()->question_id;  

            $API = App::make('APIService');

            $API->request('/college/update_question_image_url', "POST", $image_url);

        }

        // End of question image upload

         // Begin update option image upload

        if(isset($request['update_option_image'])){
        $updated_files = Input::file('update_option_image');
        }

        if(isset($updated_files)){

            $file_count = count($updated_files);
          
          foreach($updated_files as $key=>$file1) {
            
                if($file1!=null){
            
                $filename = $update_id[$key].'.'.$file1->getClientOriginalExtension();

                $destinationPath = public_path().'\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$qn_id.'\options';
            
                $destinationPath2 = '\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$qn_id.'\options';

                $a = '\\'; 

                $options[] =  "{$destinationPath2}{$a}{$filename}";

                $file1->move($destinationPath, $filename);
            
                }
            }

             if (isset($options)) {

             $image_url['answer_image'] =  $options;  

             $image_url['qpqa_id'] =   $update_id ;   

            } 

             $API = App::make('APIService');

             $API->request('/college/update_option_image_url', "POST", $image_url);
        }

        // End of update option image upload

         // Begin new option image upload

        if(isset($request['option_image'])){
        $new_files = Input::file('option_image');}

        if(isset($new_files)){

            $file_count = count($new_files);
          
          foreach($new_files as $key=>$file2) {
            
                if($file2!=null){
            
                $filename = $new_id[$key].'.'.$file2->getClientOriginalExtension();

                $destinationPath = public_path().'\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$qn_id.'\options';
            
                $destinationPath2 = '\testengine\question_paper\QP_'.$request['qp_id'].'\QPQ_'.$qn_id.'\options';

                $a = '\\'; 

                $new_options[] =  "{$destinationPath2}{$a}{$filename}";

                $file2->move($destinationPath, $filename);
            
                }
            }

             if (isset($new_options)) {

             $image_url['answer_image'] =  $new_options;  

             $image_url['qpqa_id'] =   $new_id ;   

            } 

             $API = App::make('APIService');

             $API->request('/college/update_option_image_url', "POST", $image_url);
           
        }

        // End of new option image upload


        if($action_page == 1){

            $redirectURL = 'college/questionpaper/active';
                
            return redirect($redirectURL);
        }

         return redirect($request['qp_id'].'/college/'.'set_questions/'.$next_section.'/'.$next_question );
    }    

     public function view_question_paper(Request $request,$id)
    {
        $request['qp_id'] = $id;
        $API = App::make('APIService');
        $API->request('/college/view_question_paper', "POST",$request->all());



        $qp_details = $API->responseJSON()->qp_details[0];
        $section_details=$API->responseJSON()->section_details;
        $question_details=$API->responseJSON()->question_details;

        $subject=null; 

         foreach ($section_details as $key => $value) {
           $subject_tmp[] = $value->section_subject;
        }

        $subject_tmp = array_unique($subject_tmp);  

        foreach ($subject_tmp as $key => $value) {
           $subject[] = $value;
        }

        $API = App::make('APIService');
        $API->request('/college/get_option_details', "POST",$id);
        $option_details=$API->responseJSON()->option_details;
// dd(['section_details'=>$section_details,'question_details'=>$question_details]);
         return view('admin.view_question_paper')
         ->with('qp_details',$qp_details)
         ->with('subject',$subject)
         ->with('section_details',$section_details)
         ->with('question_details',$question_details)
         ->with('option_details',$option_details);
    }

     public function create_batch(Request $request)
    {
        
        $API = App::make('APIService');
        
        $API->request('/college/get_degree', "POST",$request->all());

         $degree_list = $API->responseJSON()->degree_list;

        return view('admin.create_batch')->with('degree_list',$degree_list);
        
    }

    public function set_batch(Request $request)
    {

        $request['college_id'] = $this->session->get('user_authenticated.reg_id');

        $API = App::make('APIService');
        $API->request('/college/set_batch', "POST", $request->all());

        $this->session->set('message',$API->responseJSON()->reponseMessage);
        
        $redirectURL = 'college/batch/active';

        return redirect($redirectURL);
    }

    public function view_batch(Request $request,$id)
    {

        $API = App::make('APIService');
        $API->request('/college/view_batch_details', "POST",$id);
        
         $batch_details = $API->responseJSON()->batch_details;


        return view('admin.view_batch_details')->with('batch_details',$batch_details);
    }

     public function batchinstance(Request $request,$id)
    {
        
       $college_id = $this->session->get('user_authenticated.reg_id');

       $API = App::make('APIService');
       $API->request('/college/batchinstance', "POST",[$id,$college_id]);

       // dd($API->responseJSON());

       $batch_details = $API->responseJSON()->batch_details;
       $test_details = $API->responseJSON()->test_details;
       
        return view('admin.testinstance')->with('batch_details',$batch_details)->with('test_details',$test_details);
    }

    public function edit_batch($id, Request $request)
    {
        $API = App::make('APIService');
        $API->request('/college/edit_batch', "POST",$id);
        
        $details = $API->responseJSON()->details[0];

        $degree_list = $API->responseJSON()->degree_list;

        $selected_degree_branch = $API->responseJSON()->selected_degree_branch;

        return view('admin.edit_batch')->with('degree_list',$degree_list)->with('details',$details)->with('selected_degree_branch',$selected_degree_branch);
    }

    public function update_batch(Request $request)
    {
        $API = App::make('APIService');
        $API->request('/college/update_batch', "POST", $request->all());


        $this->session->set('message',$API->responseJSON()->reponseMessage);
        
        $redirectURL = 'college/view_batch/'.$request["batch_id"];

        return redirect($redirectURL);
    }

    public function download_batch_students($id1,$id2)
    {
        
        $id1 = base64_decode($id1);
        $title = base64_decode($id2);
        
       $API = App::make('APIService');
       $API->request('/college/download_batch_students', "POST",$id1);
    
        $user = (array) $API->responseJSON()->data;
        
        $userArray = [];
        foreach ($user as $iteration => $userData) {
        
            
        $userArray[$iteration]['S.No'] = $iteration + 1;
        $userArray[$iteration]['Student id'] = $userData->student_id;
        $userArray[$iteration]['Name'] = $userData->first_name .'  '. $userData->last_name;
        $userArray[$iteration]['Gender'] = $userData->gender;
        $userArray[$iteration]['D.O.B'] = $userData->date_of_birth;
        
        $dob= $userData->date_of_birth;
            $age = (date('Y') - date('Y',strtotime($dob)));
        $userArray[$iteration]['Age'] = $age;
            $age = null;

        $userArray[$iteration]['E-mail'] = $userData->email;
        $userArray[$iteration]['Mobile'] = $userData->mobile;
        $userArray[$iteration]['Address1'] = $userData->address1;
        $userArray[$iteration]['Address2'] = $userData->address2;
        
        $userArray[$iteration]['Pincode'] = $userData->pincode;
        $userArray[$iteration]['City'] = $userData->city;
        $userArray[$iteration]['District'] = $userData->district;
        $userArray[$iteration]['State'] = $userData->state;
        $userArray[$iteration]['Mother tongue'] = $userData->mother_tongue;
        $userArray[$iteration]['Language known'] = $userData->language_known;
        $userArray[$iteration]['Career interest'] = $userData->career_interest;
        
        $userArray[$iteration]['Technical skills'] = $userData->technical_skills;

        $userArray[$iteration]['SSLC School'] = $userData->sslc_school;
        $userArray[$iteration]['SSLC Board'] = $userData->sslc_board;
        $userArray[$iteration]['SSLC Medium'] = $userData->sslc_medium;
        $userArray[$iteration]['SSLC Marks'] = $userData->sslc_marks;
        $userArray[$iteration]['SSLC Year'] = $userData->sslc_year;

        $userArray[$iteration]['HSC School'] = $userData->hsc_school;
        $userArray[$iteration]['HSC Board'] = $userData->hsc_board;
        $userArray[$iteration]['HSC Medium'] = $userData->hsc_medium;
        $userArray[$iteration]['HSC Marks'] = $userData->hsc_marks;
        $userArray[$iteration]['HSC Year'] = $userData->hsc_year;

        $userArray[$iteration]['Diploma College'] = str_replace("\r\n",'', $userData->diploma_institution_name1).str_replace("\r\n",'', $userData->diploma_institution_name2);
        $userArray[$iteration]['Diploma Course'] = $userData->diploma_course;
        $userArray[$iteration]['Diploma Medium'] = $userData->diploma_medium;
        $userArray[$iteration]['Diploma Marks'] = $userData->diploma_percentage;
        $userArray[$iteration]['Diploma Year'] = $userData->diploma_year_of_passing;

        $userArray[$iteration]['UG College'] = str_replace("\r\n",'', $userData->ug_institution_name1).str_replace("\r\n",'', $userData->ug_institution_name2);
        $userArray[$iteration]['UG Degree'] = $userData->ug_subtype;
        $userArray[$iteration]['UG Course'] = $userData->ug_course;
        $userArray[$iteration]['UG Medium'] = $userData->ug_medium;
        $userArray[$iteration]['UG Marks'] = $userData->ug_percentage;
        $userArray[$iteration]['UG Year'] = $userData->ug_year_of_passing;

        $userArray[$iteration]['PG College'] = str_replace("\r\n",'', $userData->pg_institution_name1).str_replace("\r\n",'', $userData->pg_institution_name2);
        $userArray[$iteration]['PG Degree'] = $userData->pg_subtype;
        $userArray[$iteration]['PG Course'] = $userData->pg_course;
        $userArray[$iteration]['PG Medium'] = $userData->pg_medium;
        $userArray[$iteration]['PG Marks'] = $userData->pg_percentage;
        $userArray[$iteration]['PG Year'] = $userData->pg_year_of_passing;

        
        if($userData->work_mode == 1){
            $userArray[$iteration]['Work Mode'] = "FULL TIME";
        }
        elseif($userData->work_mode == 2){
            $userArray[$iteration]['Work Mode'] = "PART TIME";   
        }
        else{
            $userArray[$iteration]['Work Mode'] = "INTERN";   
        }

        if($userData->availability == 1){
            $userArray[$iteration]['Availability'] = "IMMEDIETLY";
        }
        else{
            $userArray[$iteration]['Availability'] = "AFTER PASSED OUT"; 
        }
        
        $userArray[$iteration]['Preferred location'] = $userData->preferred_location;
        
        }

        // dd($userArray);
    
        Excel::create( $title , function($excel) use ($userArray) {    
        $excel->sheet('Sheet 1', function($sheet) use ($userArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        $sheet->fromArray($userArray);      
        });
        })->download('xls');
        exit;
       
    }

    public function download_batch_report($id1,$id2)
    {
        
        $id1 = base64_decode($id1);
        $title = base64_decode($id2);
        
       $API = App::make('APIService');
       $API->request('/college/download_batch_report', "POST",$id1);
    
        $user = $API->responseJSON()->data;
        $test_record = $API->responseJSON()->test_record;
        
        

        $userArray = [];
        foreach ($user as $iteration => $userData) {
        
            
            $userArray[$iteration]['S.No'] = $iteration + 1;
            $userArray[$iteration]['Student id'] = $userData->student_id;
            $userArray[$iteration]['Name'] = $userData->first_name .'  '. $userData->last_name;
            $userArray[$iteration]['Gender'] = $userData->gender;
            $userArray[$iteration]['D.O.B'] = $userData->date_of_birth;
            
            $dob= $userData->date_of_birth;
                $age = (date('Y') - date('Y',strtotime($dob)));
            $userArray[$iteration]['Age'] = $age;
                $age = null;

            $userArray[$iteration]['E-mail'] = $userData->email;
            $userArray[$iteration]['Mobile'] = $userData->mobile;
            $userArray[$iteration]['Address1'] = $userData->address1;
            $userArray[$iteration]['Address2'] = $userData->address2;
            
            $userArray[$iteration]['Pincode'] = $userData->pincode;
            $userArray[$iteration]['City'] = $userData->city;
            $userArray[$iteration]['District'] = $userData->district;
            $userArray[$iteration]['State'] = $userData->state;
            $userArray[$iteration]['Mother tongue'] = $userData->mother_tongue;
            $userArray[$iteration]['Language known'] = $userData->language_known;
            $userArray[$iteration]['Career interest'] = $userData->career_interest;
            
            $userArray[$iteration]['Technical skills'] = $userData->technical_skills;

            $userArray[$iteration]['SSLC School'] = $userData->sslc_school;
            $userArray[$iteration]['SSLC Board'] = $userData->sslc_board;
            $userArray[$iteration]['SSLC Medium'] = $userData->sslc_medium;
            $userArray[$iteration]['SSLC Marks'] = $userData->sslc_marks;
            $userArray[$iteration]['SSLC Year'] = $userData->sslc_year;

            $userArray[$iteration]['HSC School'] = $userData->hsc_school;
            $userArray[$iteration]['HSC Board'] = $userData->hsc_board;
            $userArray[$iteration]['HSC Medium'] = $userData->hsc_medium;
            $userArray[$iteration]['HSC Marks'] = $userData->hsc_marks;
            $userArray[$iteration]['HSC Year'] = $userData->hsc_year;

            $userArray[$iteration]['Diploma College'] = str_replace("\r\n",'', $userData->diploma_institution_name1).str_replace("\r\n",'', $userData->diploma_institution_name2);
            $userArray[$iteration]['Diploma Course'] = $userData->diploma_course;
            $userArray[$iteration]['Diploma Medium'] = $userData->diploma_medium;
            $userArray[$iteration]['Diploma Marks'] = $userData->diploma_percentage;
            $userArray[$iteration]['Diploma Year'] = $userData->diploma_year_of_passing;

            $userArray[$iteration]['UG College'] = str_replace("\r\n",'', $userData->ug_institution_name1).str_replace("\r\n",'', $userData->ug_institution_name2);
            $userArray[$iteration]['UG Degree'] = $userData->ug_subtype;
            $userArray[$iteration]['UG Course'] = $userData->ug_course;
            $userArray[$iteration]['UG Medium'] = $userData->ug_medium;
            $userArray[$iteration]['UG Marks'] = $userData->ug_percentage;
            $userArray[$iteration]['UG Year'] = $userData->ug_year_of_passing;

            $userArray[$iteration]['PG College'] = str_replace("\r\n",'', $userData->pg_institution_name1).str_replace("\r\n",'', $userData->pg_institution_name2);
            $userArray[$iteration]['PG Degree'] = $userData->pg_subtype;
            $userArray[$iteration]['PG Course'] = $userData->pg_course;
            $userArray[$iteration]['PG Medium'] = $userData->pg_medium;
            $userArray[$iteration]['PG Marks'] = $userData->pg_percentage;
            $userArray[$iteration]['PG Year'] = $userData->pg_year_of_passing;

            
            if($userData->work_mode == 1){
                $userArray[$iteration]['Work Mode'] = "FULL TIME";
            }
            elseif($userData->work_mode == 2){
                $userArray[$iteration]['Work Mode'] = "PART TIME";   
            }
            else{
                $userArray[$iteration]['Work Mode'] = "INTERN";   
            }

            if($userData->availability == 1){
                $userArray[$iteration]['Availability'] = "IMMEDIETLY";
            }
            else{
                $userArray[$iteration]['Availability'] = "AFTER PASSED OUT"; 
            }
            
            $userArray[$iteration]['Preferred location'] = $userData->preferred_location;

            foreach ($test_record as $trkey => $trvalue) {
                $tmp_title = $trvalue->title;
                $userArray[$iteration][$tmp_title] = $userData->$tmp_title;
            }
        
        }
    
        Excel::create( $title . ' batch report' , function($excel) use ($userArray) {    
        $excel->sheet('Students Report', function($sheet) use ($userArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        $sheet->fromArray($userArray);      
        });
        })->download('xls');
        exit;
       
    }

    public function export_test_feedback(Request $request,$id)
    {
        
       $API = App::make('APIService');
       $API->request('/college/export_test_feedback', "POST",$id);

    
    
       $title=$API->responseJSON()->title; 
       
       $student_feedback=$API->responseJSON()->student_feedback;
       $batch_details=$API->responseJSON()->batch_details;

       $userArray = [];
       foreach ($student_feedback as $iteration => $value) {
        $userArray[$iteration]['S.No'] = $iteration + 1;

        $userArray[$iteration]['Student Id'] = $value->student_id;
        $userArray[$iteration]['Name'] = $value->name;
        $userArray[$iteration]['Email'] = $value->email;

        $userArray[$iteration]['Degree'] = $batch_details[0]->degree_subtype_name;
        $userArray[$iteration]['Branch'] = $batch_details[0]->course_name;
        $userArray[$iteration]['Batch'] = $batch_details[0]->batch_year.' - '.$batch_details[0]->batch_year_to;

        $userArray[$iteration]['Feedback'] = $value->message;
       }
       
       
       Excel::create($title.' feedback', function($excel) use ($userArray) {

        $excel->sheet('Students feedback', function($sheet) use ($userArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($userArray);          
        });

        })->download('xls');
        exit;
        
    }

    public function export_test_report(Request $request,$id)
    {
        

       $API = App::make('APIService');
       $API->request('/college/export_test_report', "POST",$id);

       // dd($API->responseJSON()->student_details);
    
       $title=$API->responseJSON()->title; 

       $batch_details=$API->responseJSON()->batch_details;

       $subject=$API->responseJSON()->subject;

       $student_details=$API->responseJSON()->student_details;

       $userArray = [];

       foreach ($student_details as $iteration => $value) {

        $userArray[$iteration]['S.No'] = $iteration + 1;
        $userArray[$iteration]['Student Id'] = $value->student_id;
        $userArray[$iteration]['Name'] = $value->first_name.' '.$value->last_name;
        $userArray[$iteration]['Email'] = $value->email;
        $userArray[$iteration]['Degree'] = $batch_details[0]->degree_subtype_name;
        $userArray[$iteration]['Branch'] = $batch_details[0]->course_name;
        $userArray[$iteration]['Batch'] = $batch_details[0]->batch_year.' - '.$batch_details[0]->batch_year_to;

        $userArray[$iteration]['Login'] = $value->login;
        $userArray[$iteration]['Logout'] = $value->logout;

        
        $userArray[$iteration]['Attended'] = $value->attended;
        $userArray[$iteration]['Not Attended'] = $value->not_attended;
        
        $userArray[$iteration]['Total Incorrect'] = $value->incorrect;

        foreach ($subject as $skey => $svalue) {
            $userArray[$iteration][$svalue] = $value->$svalue;
        }

        $userArray[$iteration]['Total Score'] = $value->correct;

       }
       
       
       Excel::create($title.' test report', function($excel) use ($userArray) {

        $excel->sheet('Students report', function($sheet) use ($userArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($userArray);          
        });

        })->download('xls');
        exit;
        
    }






}






