<?php namespace App\Http\Controllers;

use App;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyFormRequest;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

use Maatwebsite\Excel\Facades\Excel;

use Cache;

class AdminController extends Controller {

    /**
    * Middleware handles the request
    */
    public function __construct(Store $session) {
        $this->session = $session;
        $this->middleware('auth', ['except' => 'index','testlogin']);
    }

    public function index($id,Request $request)
    {

        if($id == 'not_Started'){
        $request['status']= 0;
        }
        if($id == 'active'){
        $request['status']= 1;
        }
        elseif($id == 'inactive'){
        $request['status']= 2;
        }
        elseif($id == 'finished'){
        $request['status']= 3;
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

        $API = App::make('APIService');

        $API->request('/admin/dashboard_batch_details', "POST", $request->all());
/*dd($API->responseJSON());*/
        $batch_details=$API->responseJSON()->batch_details;

        $count1 = $API->responseJSON()->count1;
        $count2 = $API->responseJSON()->count2;

        $first = $API->responseJSON()->first_last[0]->first;
        $last = $API->responseJSON()->first_last[0]->last;


        if($batch_details){

        $first_action_value=$batch_details[0]->batch_id;
        $last_action_value=$batch_details[count($batch_details)-1]->batch_id;

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

        }


         if(!isset($first_action_value)){
            $first_action_value = 0;
         }
         if(!isset($last_action_value)){
            $last_action_value = 0;
         }

        return view('admin.testboard')
        ->with('count1',$count1)
        ->with('count2',$count2)
        ->with('status',$id)
        ->with('total_records',$last)
        ->with('first_action_value',$first_action_value)
        ->with('last_action_value',$last_action_value)
        ->with('previous',$previous)
        ->with('next',$next)
        ->with('search_key',$request['search_key'])
        ->with('batch_details',$batch_details);
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

        $API = App::make('APIService');
        $API->request('/admin/dashboard_questionpaper_details', "POST", $request->all());

        $count1 = $API->responseJSON()->count1;
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
        ->with('count1',$count1)
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
        
        $API = App::make('APIService');
        $API->request('/admin/set_questionpaper', "POST", $request->all());

        if( $API->responseJSON()->responseType == "success" ){
            $questionpaper = $API->responseJSON()->id;

            return redirect($questionpaper.'/admin/'.'set_section');

        }
        else{
            dd($API->responseJSON());
        }
    }

    public function get_chapter(Request $request)
    {
        $API = App::make('APIService');
        $API->request('/get_chapter', "POST", $request->all());

        $data = (array)$API->responseJSON();    

        return $data;
    }

    public function set_section($id, Request $request)
    {
        
        $API = App::make('APIService');
        $API->request('/admin/get_questionpaper_detail', "POST", $id);       

        $details = $API->responseJSON()->qp_details[0];
        $subject = $API->responseJSON()->subject;
        $section = $API->responseJSON()->section;

        // DD($API->responseJSON());

        return view('admin.create_sections')->with('details',$details)->with('subject',$subject)->with('section',$section);
    }

    public function edit_section($id1,$id2 ,Request $request)
    {

        $API = App::make('APIService');
        $API->request('/admin/get_questionpaper_detail', "POST",$id1);
        $details = $API->responseJSON()->qp_details[0];
        $subject = $API->responseJSON()->subject;
        $section = $API->responseJSON()->section;

        $API = App::make('APIService');
        $API->request('/admin/get_section_chapter', "POST",$id2);

        $section_chapter = $API->responseJSON();

        return view('admin.edit_section')->with('details',$details)->with('subject',$subject)
        ->with('section',$section)->with('editable_section',$id2)->with('section_chapter',$section_chapter);

    }

    public function edit_section1($id, Request $request)
    {
        
        $API = App::make('APIService');
        $API->request('/admin/get_questionpaper_detail', "POST", $id);

       

        $details = $API->responseJSON()->qp_details[0];
        $subject = $API->responseJSON()->subject;
        $section = $API->responseJSON()->section;

        return view('admin.edit_sections_1')->with('details',$details)->with('subject',$subject)->with('section',$section);
    }    

    public function add_section(Request $request)
    {
        //dd($request->all());
        $action = $request['action'];
        unset($request['action']);
        
        $API = App::make('APIService');
        $API->request('/admin/add_section', "POST",$request->all());
        
        $section_id = $API->responseJSON()->id;

        // Begin question image upload

        $image = Input::file('question_image');


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

            $API->request('/admin/update_section_image_url', "POST", $image_url);

        }

        // End of question image upload

        if($action == 2)
            return redirect($request['qp_id'].'/admin/'.'set_section');
        else{
            return redirect($request['qp_id'].'/admin/'.'set_questions/1/1');
        }
        
    }
   
    public function update_section(Request $request)
    {
        
       $action = $request['action'];
        unset($request['action']);
        
        $API = App::make('APIService');
        $API->request('/admin/update_section', "POST",$request->all());

        $section_id = $request['section_id'];

        // Begin question image upload

        $image = Input::file('question_image');


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

            $API->request('/admin/update_section_image_url', "POST", $image_url);

        }

        // End of question image upload

        if($action == 2)
            return redirect($request['qp_id'].'/admin/'.'set_section');
        else{
           return redirect($request['qp_id'].'/admin/'.'set_questions/1/1');
        }
        
    } 

        public function delete_section(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/admin/delete_section', "POST",$request->all());

        return redirect($request['qp_id'].'/admin/'.'set_section');
        
    }    

    public function edit_questionpaper($id, Request $request)
    {
        $API = App::make('APIService');
        $API->request('/admin/edit_questionpaper', "POST",$id);

        $details = $API->responseJSON()->details[0];

        return view('admin.edit_questionpaper')->with('details',$details);
    }

    public function update_questionpaper($id, Request $request)
    {
        $request['qp_id']=$id;
       $API = App::make('APIService');
        $API->request('/admin/update_questionpaper', "POST",$request->all());

        if (200 == $API->responseStatusCode()) {
               return redirect($id.'/admin/'.'edit_section');
            }
        else{
            dd("Failure");
        }
    }


    



    public function set_question($id1,$id2,$id3,Request $request)
    {

// dd(123);exit;
        $API = App::make('APIService');

        $API->request('/admin/get_questionpaper_detail2', "POST", [$id1,$id2,$id3]);

$tmp_data = $API->responseJSON();

// dd($tmp_data);exit;

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

    public function add_question(Request $request)
    {   

       $API = App::make('APIService');

        $API->request('/admin/add_question', "POST", $request->all());

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
            

        // Begin question image upload

        $image = Input::file('question_image');


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

          $files = Input::file('option_image');

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

        $API->request('/admin/set_question_option_image_url', "POST", $image_url);
        }
                 

        return redirect($request['qp_id'].'/admin/'.'set_questions/'.$next_section.'/'.$next_question );

}

     public function update_question(Request $request)
    {   

        $action_page=0;

        if(isset($request['action_page'])){
            $action_page = $request['action_page'];
            unset($request['action_page']);
        }

        $API = App::make('APIService');

        $API->request('/admin/update_question', "POST", $request->all());

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

        $image = Input::file('question_image');


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

            $API->request('/admin/update_question_image_url', "POST", $image_url);

        }

        // End of question image upload

         // Begin update option image upload

        
        $updated_files = Input::file('update_option_image');

        if($updated_files[0] != null){

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

             $API->request('/admin/update_option_image_url', "POST", $image_url);
        }

        // End of update option image upload

         // Begin new option image upload

        
        $new_files = Input::file('option_image');

        if($new_files[0] != null){

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

             $API->request('/admin/update_option_image_url', "POST", $image_url);
           
        }

        // End of new option image upload


        if($action_page == 1){

            $redirectURL = 'admin/questionpaper/active';
                
            return redirect($redirectURL);
        }

         return redirect($request['qp_id'].'/admin/'.'set_questions/'.$next_section.'/'.$next_question );
    }

    
public function delete_option(Request $request)
    {

      $API = App::make('APIService');

      $API->request('/admin/delete_option', "POST", $request->all());

      dd($API->responseJSON());

    }

    public function create_batch(Request $request)
    {
		
		$API = App::make('APIService');
        
        $API->request('/admin/get_degree', "POST",$request->all());

         $degree_list = $API->responseJSON()->degree_list;

        return view('admin.create_batch')->with('degree_list',$degree_list);
        
    }

      public function edit_batch($id, Request $request)
    {
        $API = App::make('APIService');
        $API->request('/admin/edit_batch', "POST",$id);
        
        $details = $API->responseJSON()->details[0];

        $degree_list = $API->responseJSON()->degree_list;

        $selected_degree_branch = $API->responseJSON()->selected_degree_branch;

        return view('admin.edit_batch')->with('degree_list',$degree_list)->with('details',$details)->with('selected_degree_branch',$selected_degree_branch);
    }
	
	


    public function set_batch(Request $request)
    {

        
        $API = App::make('APIService');
        $API->request('/admin/set_batch', "POST", $request->all());

        $this->session->set('message',$API->responseJSON()->reponseMessage);
        
        $redirectURL = 'admin/batch/active';

        return redirect($redirectURL);
    }

     public function update_batch(Request $request)
    {
        
        $API = App::make('APIService');
        $API->request('/admin/update_batch', "POST", $request->all());


        $this->session->set('message',$API->responseJSON()->reponseMessage);
        
        $redirectURL = 'admin/batch/active';

        return redirect($redirectURL);
    }

     public function assign_questionpaper($id,Request $request)
    {

       return view('admin.assign_questionpaper')->with('test_id',$id);
    }


       public function check_questionpaper(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/admin/check_questionpaper', "POST", $request['qp_id']);

        $details = $API->responseJSON()->record;
       
        if($details){
            return $details;     
        }
        else{
            return ["Failed"];
        }
        
    }  



    public function updatetest_status($id,Request $request)
    {
        $request['test_id'] = $id;

        $action_page=0;

        if(isset($request['action_page'])){
            $action_page = $request['action_page'];
            unset($request['action_page']);
        }

        $API = App::make('APIService');
        $API->request('/admin/updatetest', "POST", $request->all());

        if($action_page == 3){

            return redirect('/admin/'.'view_batch/'.$request['test_id']);
        }

        return redirect('admin/test/active');
    }



     public function update_assigned_questionpaper($id,Request $request)
    {

         $API = App::make('APIService');
        $API->request('/admin/edit_test', "POST",$id);

        $details = $API->responseJSON()->details[0];

       return view('admin.update_assigned_questionpaper')->with('details',$details);
    }

    public function view_batch(Request $request,$id)
    {

        $API = App::make('APIService');
        $API->request('/admin/view_batch_details', "POST",$id);
		
         $batch_details = $API->responseJSON()->batch_details;
         

        return view('admin.view_batch_details')->with('batch_details',$batch_details);
    }

    public function view_question_paper(Request $request,$id)
    {
        $request['qp_id'] = $id;
        $API = App::make('APIService');
        $API->request('/admin/view_question_paper', "POST",$request->all());



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
        $API->request('/admin/get_option_details', "POST",$id);
        $option_details=$API->responseJSON()->option_details;
// dd(['section_details'=>$section_details,'question_details'=>$question_details]);
         return view('admin.view_question_paper')
         ->with('qp_details',$qp_details)
         ->with('subject',$subject)
         ->with('section_details',$section_details)
         ->with('question_details',$question_details)
         ->with('option_details',$option_details);
    }


     public function testhome(Request $request,$id) 
    {

         $request['test_id'] = $id;

         $request['user_id'] = $this->session->get('user_authenticated.id');

         $request['student_id'] = $this->session->get('user_authenticated.reg_id');

        $API = App::make('APIService');
        
        $API->request('/admin/create_test_login', "POST",$request->all());

        

		$testdetails = $API->responseJSON()->testdetails[0];
		
		$reappear_id = $API->responseJSON()->reappear_id;

        if(isset($API->responseJSON()->testdetails[0]->remember_question)){


            $this->session->set('user_authenticated.question_array',$API->responseJSON()->testdetails[0]->remember_question);

        }

        
			
            $responseJSON = Cache::rememberForever($id, function()  use ($id)

            {

                 $API = App::make('APIService');
        
                $API->request('/admin/get_question_paper', "POST", ['test_id'=>$id] );


                return $API->responseJSON();

            });
       

		if($reappear_id){
			
            return view('admin.restart_test')->with('id',$id)->with('reappear_id',$reappear_id )->with('testdetails',$testdetails);
        }
        

       return view('admin.starttest')->with('id',$id)->with('testdetails',$testdetails);
    }

    public function testkey(Request $request,$id)
    {

        $API = App::make('APIService');
       $API->request('/admin/testkey', "POST",$id);

       $testdetails=$API->responseJSON()->testdetails[0];
       $Section_records=$API->responseJSON()->Section_records;
       $Question_records=$API->responseJSON()->Question_records;
       $Option_records=$API->responseJSON()->Option_records;

       foreach ($Section_records as $key => $value) {
           $subject_tmp[] = $value->section_subject;
        }

        $subject_tmp = array_unique($subject_tmp);  

        foreach ($subject_tmp as $key => $value) {
           $subject[] = $value;
        }

       return view('admin.testkey')
       ->with('subject',$subject)
       ->with('testdetails',$testdetails)
       ->with('Section_records',$Section_records)
       ->with('Question_records',$Question_records)
       ->with('Option_records',$Option_records);
    }

    public function update_remaining_time(Request $request)
    {
        $API = App::make('APIService');
       $API->request('/admin/update_remaining_time', "POST",$request->all() );

       return $API->responseJSON();
    }

   

    public function endtestinstance(Request $request,$id)
    {
        $request['test_login_id'] = $id;

       $API = App::make('APIService');

       $API->request('/admin/endtestinstance', "POST",$request->all());

        return redirect('admin/'.'testinstance/'.$API->responseJSON()->test_id)->with('message',$API->responseJSON()->reponseMessage);
        
    }

    public function testadmin_endtest(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/testadmin/endtest', "POST",$request->all());

        $data = (array)$API->responseJSON()->reponseMessage;    

        return $data;
    }
	
	public function admin_delete_test(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/admin/delete_test', "POST",$request->all()); 

        $data = (array)$API->responseJSON()->reponseMessage;    

        return $data;
    }

    public function testreport(Request $request,$id)
    {
       $API = App::make('APIService');
       $API->request('/admin/testreport', "POST",$id);
     
       $subject=$API->responseJSON()->subject; 
       $testdetails=$API->responseJSON()->testdetails;
       $student_details_list=$API->responseJSON()->student_details_list;
       $student_answer=$API->responseJSON()->student_answer;

       if($student_answer == null){
        
        $details['responseType'] = 'failure';
        $details['reponseMessage'] = 'Sorry ! End test to view test report';

         return view('viewurl')->with('details',$details);

       }


       foreach ($student_details_list as $sdlkey => $sdlvalue) {
       $sdlvalue->correct = 0;$sdlvalue->incorrect = 0;$sdlvalue->attended = 0;$sdlvalue->not_attended = 0;
           foreach ($subject as $skey => $svalue) {
                foreach ($student_answer as $sakey => $savalue) {
                    if($savalue->student_id ==  $sdlvalue->student_id && $savalue->subject_id == $skey){
                        $sdlvalue->$svalue = $savalue->correct;
                        $sdlvalue->correct = $sdlvalue->correct+$savalue->correct;
                        $sdlvalue->incorrect = $sdlvalue->incorrect+$savalue->incorrect;
                        $sdlvalue->attended = $sdlvalue->attended+$savalue->attended;
                        $sdlvalue->not_attended = $sdlvalue->not_attended+$savalue->not_attended;
						
                    }
                }
               
           }
		   $sdlvalue->time_lapsed = round(abs($sdlvalue->time_lapsed) / 60,2);
       }
     
        return view('admin.testreport')
       ->with('student_answer',$student_answer)
       ->with('subject',$subject)
       ->with('testdetails',$testdetails)
       ->with('student_details_list',$student_details_list);
    }
    
    public function full_testreport(Request $request,$id)
    {
       $API = App::make('APIService');
       $API->request('/admin/full_testreport', "POST",$id);
     
       $subject=$API->responseJSON()->subject; 
       $testdetails=$API->responseJSON()->testdetails;
       $student_details_list=$API->responseJSON()->student_details_list;
       $student_answer=$API->responseJSON()->student_answer;

       if($student_answer == null){
        
        $details['responseType'] = 'failure';
        $details['reponseMessage'] = 'Sorry ! End test to view test report';

         return view('viewurl')->with('details',$details);

       }


       foreach ($student_details_list as $sdlkey => $sdlvalue) {
       $sdlvalue->correct = 0;$sdlvalue->incorrect = 0;$sdlvalue->attended = 0;$sdlvalue->not_attended = 0;
           foreach ($subject as $skey => $svalue) {
                foreach ($student_answer as $sakey => $savalue) {
                    if($savalue->student_id ==  $sdlvalue->student_id && $savalue->subject_id == $skey){
                        $sdlvalue->$svalue = $savalue->correct;
                        $sdlvalue->correct = $sdlvalue->correct+$savalue->correct;
                        $sdlvalue->incorrect = $sdlvalue->incorrect+$savalue->incorrect;
                        $sdlvalue->attended = $sdlvalue->attended+$savalue->attended;
                        $sdlvalue->not_attended = $sdlvalue->not_attended+$savalue->not_attended;
                    }
                }
               
           }
       }

     
        return view('admin.testreport')
       ->with('student_answer',$student_answer)
       ->with('subject',$subject)
       ->with('testdetails',$testdetails)
       ->with('student_details_list',$student_details_list);
    }

    public function individual_testreport(Request $request,$id1,$id2)
    {

       $request['test_login_id']=$id1;
       $request['student_id']=$id2;


       $API = App::make('APIService');
       $API->request('/admin/individual_testreport', "POST",$request->all());
     
        $Section_records=$API->responseJSON()->Section_records;
        $Question_records=$API->responseJSON()->Question_records;
        $student_answer=$API->responseJSON()->student_answer;
        $test_log=$API->responseJSON()->test_log;

        foreach ($Section_records as $key => $value) {
           $subject_tmp[] = $value->section_subject;
        }

        $subject_tmp = array_unique($subject_tmp);  

        foreach ($subject_tmp as $key => $value) {
           $subject[] = $value;
        }

        foreach ($Section_records as $key11 => $value11) {
           $subject_id_tmp[] = $value11->section_subject_id;
        }

        $subject_id_tmp = array_unique($subject_id_tmp);  

        foreach ($subject_id_tmp as $key12 => $value12) {
           $subject_id[] = $value12;
        }

        foreach ($student_answer as $Sakey => $Savalue) {
            $responded_questions[] = $Savalue->qpq_id;
        }

//  dd([
// 'Section_records'=>$Section_records,
// 'Question_records'=>$Question_records,
// 'student_answer'=>$student_answer,
// 'test_log'=>$test_log,
// 'subject'=>$subject,
//     ]);
        return view('admin.individual_testreport')
       ->with('Section_records',$Section_records)
       ->with('Question_records',$Question_records)
       ->with('student_answer',$student_answer)
       ->with('responded_questions',$responded_questions)
       ->with('test_log',$test_log)
       ->with('subject',$subject)
       ->with('subject_id',$subject_id);
    }

     public function export_testreport(Request $request,$id)
    {
        
        function check_range($id)
    {

        switch ($id){
            
        case ($id<= 40): 
            $id = "< 40%";
        break;

        case ($id>= 40 && $id< 45): 
            $id = "40 - 44.9%";
        break;
        
        case ($id>= 45 && $id< 50): 
            $id = "45 - 49.9%";
        break;
        
        case ($id>= 50 && $id< 55): 
            $id = "50 - 54.9%";
        break;
        
        case ($id>= 55 && $id< 60): 
            $id = "55 - 59.9%";
        break;
        
        case ($id>= 60 && $id< 65): 
            $id = "60 - 64.9%";
        break;
        
        case ($id>= 65 && $id< 70): 
            $id = "65 - 69.9%";
        break;
        
        case ($id>= 70 && $id< 75): 
            $id = "70 - 74.9%";
        break;
        
        case ($id>= 75 && $id< 80): 
            $id = "75 - 79.9%";
        break;
        
        case ($id>= 80 && $id< 85): 
            $id = "80 - 84.9%";
        break;
        
        case ($id>= 85 && $id< 90): 
            $id = "85 - 89.9%";
        break;
        
        case ($id>= 90 && $id< 95): 
            $id = "90 - 94.9%";
        break;
        
        case ($id>= 95 && $id< 100): 
            $id = "95 - 99.9%";
        break;
        
        case ($id== 100): 
            $id = "100%";
        break;
        
        
        default: 
            $id = " ";
        break;
     }
     
     return $id;
     
    }
     
       $API = App::make('APIService');
       $API->request('/admin/testreport', "POST",$id);
//dd($API->responseJSON());
       $subject=$API->responseJSON()->subject; 
       $testdetails=$API->responseJSON()->testdetails;
       $student_details_list=$API->responseJSON()->student_details_list;
       $student_answer=$API->responseJSON()->student_answer;

        foreach ($student_details_list as $sdlkey => $sdlvalue) {
         $sdlvalue->correct = 0;$sdlvalue->incorrect = 0;$sdlvalue->attended = 0;$sdlvalue->not_attended = 0;
           foreach ($subject as $skey => $svalue) {
                foreach ($student_answer as $sakey => $savalue) {
                    if($savalue->student_id ==  $sdlvalue->student_id && $savalue->subject_id == $skey){
                        $sdlvalue->$svalue = $savalue->correct;
                        $sdlvalue->correct = $sdlvalue->correct+$savalue->correct;
                        $sdlvalue->incorrect = $sdlvalue->incorrect+$savalue->incorrect;
                        $sdlvalue->attended = $sdlvalue->attended+$savalue->attended;
                        $sdlvalue->not_attended = $sdlvalue->not_attended+$savalue->not_attended;
                    }
                }
               
           }
       }
     
        $tmp_array = $student_details_list;

       
        foreach ($tmp_array as $iteration => $value) {
        $userArray[$iteration]['S.No'] = $iteration + 1;
        $userArray[$iteration]['Student id'] = $value->student_id;
        $userArray[$iteration]['Name'] = $value->student_name;
		
         $dob = date_create($value->date_of_birth);

        $userArray[$iteration]['DOB'] = date_format($dob, 'd-M-Y'); 

        $userArray[$iteration]['Email'] = $value->email;
        $userArray[$iteration]['Mobile'] = $value->mobile; 
        
        $userArray[$iteration]['XII Marks'] =$value->HSC_percentage; 
        
        $userArray[$iteration]['X Marks'] = $value->SSLC_percentage ; 
        
        if ($value->diploma1_institution == "Update Institution details") {
            $value->diploma1_institution = null;
        }
        
        $userArray[$iteration]['Diploma University / College / Institute'] = $value->diploma1_institution ; 
        $userArray[$iteration]['Diploma Specialization'] = $value->diploma1_branch ; 
        
        if($value->diploma1_percentage){
        $userArray[$iteration]['Diploma Marks / Grade'] = $value->diploma1_percentage;}
        else{$userArray[$iteration]['Diploma Marks / Grade'] = null;} 

         
		
		if ($value->UG1_institution == "Update Institution details") {
            $value->UG1_institution = null;
        }
		
		$userArray[$iteration]['UG University / College / Institute'] = $value->UG1_institution ; 
        $userArray[$iteration]['UG Course'] = $value->UG1_degree ; 
        $userArray[$iteration]['UG Specialization'] = $value->UG1_branch ;

         if($value->UG1_percentage){
        $userArray[$iteration]['UG Marks / Grade'] = $value->UG1_percentage;}
        else{$userArray[$iteration]['UG Marks / Grade'] = null;}
		
		if ($value->PG1_institution == "Update Institution details") {
            $value->PG1_institution = null;
        }
		
		$userArray[$iteration]['PG University / College / Institute'] = $value->PG1_institution ; 
        $userArray[$iteration]['PG Course'] = $value->PG1_degree ; 
        $userArray[$iteration]['PG Specialization'] = $value->PG1_branch ;

        if($value->PG1_percentage){
        $userArray[$iteration]['PG Marks / Grade'] = $value->PG1_percentage;}
        else{$userArray[$iteration]['PG Marks / Grade'] = null;}
           
		
		 foreach($subject as $skey => $sval){

            if(isset($value->$sval)){
            $userArray[$iteration][$sval] = $value->$sval;
            }
            else{
            $userArray[$iteration][$sval] = 0;
            }
        }      
		
		$userArray[$iteration]['Correct'] = $value->correct;
		
		$t1 = $value->login;
        $t2 =$value->logout;
        $from_time = strtotime($t1);
        $to_time = strtotime($t2);
        $duration_tmp =  round(abs($to_time - $from_time) / 60,2);
		
		$userArray[$iteration]['Percentage (%)'] = ((  $value->correct / $testdetails[0]->number_of_questions)*100);
        /*
		$userArray[$iteration]['Attended (Out of '.$testdetails[0]->number_of_questions.')'] = $value->attended;
        $userArray[$iteration]['Not Attended'] =  $value->not_attended;
		$userArray[$iteration]['Total (Out of '.$testdetails[0]->number_of_questions.')'] = $value->correct;
        $userArray[$iteration]['Wrong'] = $value->incorrect;

        $date1 = date_create($value->login);
        $login_tmp = date_format($date1, 'd M y - g:i A'); 

        $userArray[$iteration]['Login Time'] = $login_tmp;

        if($value->logout){
        $date2 = date_create($value->logout);
        $logout_tmp = date_format($date2, 'd M y - g:i A');


        }
        else{
            $logout_tmp = '-';
            $duration_tmp = '-'; 
        }

        $userArray[$iteration]['Logout Time'] = $logout_tmp;
		$userArray[$iteration]['Time lapsed (In Mins)'] = round(abs($value->time_lapsed) / 60,2);
		*/
		

        $DetailArray[$iteration]['S.No'] = $iteration + 1;
        $DetailArray[$iteration]['Techruit Student id'] = $value->student_id;
        $DetailArray[$iteration]['Name'] = $value->student_name;
        $DetailArray[$iteration]['Email'] = $value->email;
        $DetailArray[$iteration]['Mobile'] = $value->mobile; 

       

        $DetailArray[$iteration]['Day'] = date_format($dob, 'd'); 
        $DetailArray[$iteration]['Month'] = date_format($dob, 'M'); 
        $DetailArray[$iteration]['Year'] = date_format($dob, 'Y'); 
        $DetailArray[$iteration]['Gender'] = $value->gender; 
        $DetailArray[$iteration]['STD code'] = null ; 

        $DetailArray[$iteration]['Phone Number'] = $value->phone ; 
        $DetailArray[$iteration]['Current Location'] = null ; 
        $DetailArray[$iteration]['Home Town'] = null ; 
        $DetailArray[$iteration]['Work Type'] = $value->work_type ; 
        $DetailArray[$iteration]['Joining Date'] = $value->work_month ; 

        $DetailArray[$iteration]['Preferred Location'] =  $value->preferred_location ; 
        $DetailArray[$iteration]['Highest Degree'] = $value->highest_degree ; 

        $DetailArray[$iteration]['XII Board'] = $value->HSC_board ; 
        
        $xii_mark = check_range($value->HSC_percentage);
        
        $DetailArray[$iteration]['XII Marks'] = $xii_mark ; 
        $DetailArray[$iteration]['XII Year'] = $value->HSC_year_of_completion ; 
        $DetailArray[$iteration]['XII Medium'] = $value->HSC_medium ; 

        $DetailArray[$iteration]['X Board'] = $value->SSLC_board ; 
        
        $x_mark = check_range($value->SSLC_percentage);
        
        $DetailArray[$iteration]['X Marks'] = $x_mark ; 
        $DetailArray[$iteration]['X Year'] = $value->SSLC_year_of_completion ; 
        $DetailArray[$iteration]['X Medium'] = $value->SSLC_medium ; 
        
        $DetailArray[$iteration]['Diploma Type'] = null ; 
        $DetailArray[$iteration]['Diploma City'] = null ; 
        
        if ($value->diploma1_institution == "Update Institution details") {
            $value->diploma1_institution = null;
        }
        
        $DetailArray[$iteration]['Diploma University / College / Institute'] = $value->diploma1_institution ; 
        $DetailArray[$iteration]['Diploma Course'] = null ; 
        $DetailArray[$iteration]['Diploma Specialization'] = $value->diploma1_branch ; 
        $DetailArray[$iteration]['Diploma Month of Passing'] = null ; 
        $DetailArray[$iteration]['Diploma Year of Passing'] = $value->diploma1_year_of_completion ; 
        $DetailArray[$iteration]['Diploma Grading System'] = null ; 
        
        if($value->diploma1_percentage){
        $DetailArray[$iteration]['Diploma Marks / Grade'] = check_range($value->diploma1_percentage);}
        else{$DetailArray[$iteration]['Diploma Marks / Grade'] = null;} 

        $DetailArray[$iteration]['UG Type'] = null ; 
        $DetailArray[$iteration]['UG City'] = null ; 
        
        if ($value->UG1_institution == "Update Institution details") {
            $value->UG1_institution = null;
        }
        
        $DetailArray[$iteration]['UG University / College / Institute'] = $value->UG1_institution ; 
        $DetailArray[$iteration]['UG Course'] = $value->UG1_degree ; 
        $DetailArray[$iteration]['UG Specialization'] = $value->UG1_branch ; 
        $DetailArray[$iteration]['UG Month of Passing'] = null ; 
        $DetailArray[$iteration]['UG Year of Passing'] = $value->UG1_year_of_completion ; 
        $DetailArray[$iteration]['UG Grading System'] = null ; 
        
        if($value->UG1_percentage){
        $DetailArray[$iteration]['UG Marks / Grade'] = check_range($value->UG1_percentage);}
        else{$DetailArray[$iteration]['UG Marks / Grade'] = null;}
        
        
        $DetailArray[$iteration]['PG Type'] = null ; 
        $DetailArray[$iteration]['PG City'] = null ; 
        
        
        if ($value->PG1_institution == "Update Institution details") {
            $value->PG1_institution = null;
        }
        
        $DetailArray[$iteration]['PG University / College / Institute'] = $value->PG1_institution ; 
        $DetailArray[$iteration]['PG Course'] = $value->PG1_degree ; 
        $DetailArray[$iteration]['PG Specialization'] = $value->PG1_branch ; 
        $DetailArray[$iteration]['PG Month of Passing'] = null ; 
        $DetailArray[$iteration]['PG Year of Passing'] = $value->PG1_year_of_completion ; 
        $DetailArray[$iteration]['PG Grading System'] = null ; 
        
        if($value->PG1_percentage){
        $DetailArray[$iteration]['PG Marks / Grade'] = check_range($value->PG1_percentage);}
        else{$DetailArray[$iteration]['PG Marks / Grade'] = null;}

        $DetailArray[$iteration]['AssesmentTest Mark / Score'] = $value->correct ; 

        }
        
//dd([$userArray,$DetailArray]);        

        Excel::create($testdetails[0]->title.' report', function($excel) use ($userArray,$DetailArray) {

        $excel->sheet('Student Test Report', function($sheet) use ($userArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($userArray);          
        });

        $excel->sheet('Student details', function($sheet) use ($DetailArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($DetailArray);          
        });

        })->download('xls');
        exit;
        
        
    }
	
	public function export_fulltestreport(Request $request,$id) 
    {
        
        function check_range($id)
    {

        switch ($id){
            
        case ($id<= 40): 
            $id = "< 40%";
        break;

        case ($id>= 40 && $id< 45): 
            $id = "40 - 44.9%";
        break;
        
        case ($id>= 45 && $id< 50): 
            $id = "45 - 49.9%";
        break;
        
        case ($id>= 50 && $id< 55): 
            $id = "50 - 54.9%";
        break;
        
        case ($id>= 55 && $id< 60): 
            $id = "55 - 59.9%";
        break;
        
        case ($id>= 60 && $id< 65): 
            $id = "60 - 64.9%";
        break;
        
        case ($id>= 65 && $id< 70): 
            $id = "65 - 69.9%";
        break;
        
        case ($id>= 70 && $id< 75): 
            $id = "70 - 74.9%";
        break;
        
        case ($id>= 75 && $id< 80): 
            $id = "75 - 79.9%";
        break;
        
        case ($id>= 80 && $id< 85): 
            $id = "80 - 84.9%";
        break;
        
        case ($id>= 85 && $id< 90): 
            $id = "85 - 89.9%";
        break;
        
        case ($id>= 90 && $id< 95): 
            $id = "90 - 94.9%";
        break;
        
        case ($id>= 95 && $id< 100): 
            $id = "95 - 99.9%";
        break;
        
        case ($id== 100): 
            $id = "100%";
        break;
        
        
        default: 
            $id = " ";
        break;
     }
     
     return $id;
     
    }
     
       $API = App::make('APIService');
       $API->request('/admin/full_testreport', "POST",$id);

       $subject=$API->responseJSON()->subject; 
       $testdetails=$API->responseJSON()->testdetails;
       $student_details_list=$API->responseJSON()->student_details_list;
       $student_answer=$API->responseJSON()->student_answer;

        foreach ($student_details_list as $sdlkey => $sdlvalue) {
         $sdlvalue->correct = 0;$sdlvalue->incorrect = 0;$sdlvalue->attended = 0;$sdlvalue->not_attended = 0;
           foreach ($subject as $skey => $svalue) {
                foreach ($student_answer as $sakey => $savalue) {
                    if($savalue->student_id ==  $sdlvalue->student_id && $savalue->subject_id == $skey){
                        $sdlvalue->$svalue = $savalue->correct;
                        $sdlvalue->correct = $sdlvalue->correct+$savalue->correct;
                        $sdlvalue->incorrect = $sdlvalue->incorrect+$savalue->incorrect;
                        $sdlvalue->attended = $sdlvalue->attended+$savalue->attended;
                        $sdlvalue->not_attended = $sdlvalue->not_attended+$savalue->not_attended;
                    }
                }
               
           }
       }
     
        $tmp_array = $student_details_list;

       
        foreach ($tmp_array as $iteration => $value) {
        $userArray[$iteration]['S.No'] = $iteration + 1;
        $userArray[$iteration]['Student id'] = $value->student_id;
        $userArray[$iteration]['Name'] = $value->student_name;
        
         $dob = date_create($value->date_of_birth);

        $userArray[$iteration]['DOB'] = date_format($dob, 'd-M-Y'); 

        $userArray[$iteration]['Email'] = $value->email;
        $userArray[$iteration]['Mobile'] = $value->mobile; 
        
        $userArray[$iteration]['XII Marks'] =$value->HSC_percentage; 
        
        $userArray[$iteration]['X Marks'] = $value->SSLC_percentage ; 
        
        if ($value->diploma1_institution == "Update Institution details") {
            $value->diploma1_institution = null;
        }
        
        $userArray[$iteration]['Diploma University / College / Institute'] = $value->diploma1_institution ; 
        $userArray[$iteration]['Diploma Specialization'] = $value->diploma1_branch ; 
        
        if($value->diploma1_percentage){
        $userArray[$iteration]['Diploma Marks / Grade'] = $value->diploma1_percentage;}
        else{$userArray[$iteration]['Diploma Marks / Grade'] = null;} 

         
        
        if ($value->UG1_institution == "Update Institution details") {
            $value->UG1_institution = null;
        }
        
        $userArray[$iteration]['UG University / College / Institute'] = $value->UG1_institution ; 
        $userArray[$iteration]['UG Course'] = $value->UG1_degree ; 
        $userArray[$iteration]['UG Specialization'] = $value->UG1_branch ;

         if($value->UG1_percentage){
        $userArray[$iteration]['UG Marks / Grade'] = $value->UG1_percentage;}
        else{$userArray[$iteration]['UG Marks / Grade'] = null;}
        
        if ($value->PG1_institution == "Update Institution details") {
            $value->PG1_institution = null;
        }
        
        $userArray[$iteration]['PG University / College / Institute'] = $value->PG1_institution ; 
        $userArray[$iteration]['PG Course'] = $value->PG1_degree ; 
        $userArray[$iteration]['PG Specialization'] = $value->PG1_branch ;

        if($value->PG1_percentage){
        $userArray[$iteration]['PG Marks / Grade'] = $value->PG1_percentage;}
        else{$userArray[$iteration]['PG Marks / Grade'] = null;}
           
        
         foreach($subject as $skey => $sval){

            if(isset($value->$sval)){
            $userArray[$iteration][$sval] = $value->$sval;
            }
            else{
            $userArray[$iteration][$sval] = 0;
            }
        }      
        
        $userArray[$iteration]['Correct'] = $value->correct;
        
        $t1 = $value->login;
        $t2 =$value->logout;
        $from_time = strtotime($t1);
        $to_time = strtotime($t2);
        $duration_tmp =  round(abs($to_time - $from_time) / 60,2);
        
        $userArray[$iteration]['Percentage (%)'] = ((  $value->correct / $testdetails[0]->number_of_questions)*100);
        /*
        $userArray[$iteration]['Attended (Out of '.$testdetails[0]->number_of_questions.')'] = $value->attended;
        $userArray[$iteration]['Not Attended'] =  $value->not_attended;
        $userArray[$iteration]['Total (Out of '.$testdetails[0]->number_of_questions.')'] = $value->correct;
        $userArray[$iteration]['Wrong'] = $value->incorrect;

        $date1 = date_create($value->login);
        $login_tmp = date_format($date1, 'd M y - g:i A'); 

        $userArray[$iteration]['Login Time'] = $login_tmp;

        if($value->logout){
        $date2 = date_create($value->logout);
        $logout_tmp = date_format($date2, 'd M y - g:i A');


        }
        else{
            $logout_tmp = '-';
            $duration_tmp = '-'; 
        }

        $userArray[$iteration]['Logout Time'] = $logout_tmp;
        $userArray[$iteration]['Time lapsed (In Mins)'] = round(abs($value->time_lapsed) / 60,2);
        */
        

        $DetailArray[$iteration]['S.No'] = $iteration + 1;
        $DetailArray[$iteration]['Techruit Student id'] = $value->student_id;
        $DetailArray[$iteration]['Name'] = $value->student_name;
        $DetailArray[$iteration]['Email'] = $value->email;
        $DetailArray[$iteration]['Mobile'] = $value->mobile; 

       

        $DetailArray[$iteration]['Day'] = date_format($dob, 'd'); 
        $DetailArray[$iteration]['Month'] = date_format($dob, 'M'); 
        $DetailArray[$iteration]['Year'] = date_format($dob, 'Y'); 
        $DetailArray[$iteration]['Gender'] = $value->gender; 
        $DetailArray[$iteration]['STD code'] = null ; 

        $DetailArray[$iteration]['Phone Number'] = $value->phone ; 
        $DetailArray[$iteration]['Current Location'] = null ; 
        $DetailArray[$iteration]['Home Town'] = null ; 
        $DetailArray[$iteration]['Work Type'] = $value->work_type ; 
        $DetailArray[$iteration]['Joining Date'] = $value->work_month ; 

        $DetailArray[$iteration]['Preferred Location'] =  $value->preferred_location ; 
        $DetailArray[$iteration]['Highest Degree'] = $value->highest_degree ; 

        $DetailArray[$iteration]['XII Board'] = $value->HSC_board ; 
        
        $xii_mark = check_range($value->HSC_percentage);
        
        $DetailArray[$iteration]['XII Marks'] = $xii_mark ; 
        $DetailArray[$iteration]['XII Year'] = $value->HSC_year_of_completion ; 
        $DetailArray[$iteration]['XII Medium'] = $value->HSC_medium ; 

        $DetailArray[$iteration]['X Board'] = $value->SSLC_board ; 
        
        $x_mark = check_range($value->SSLC_percentage);
        
        $DetailArray[$iteration]['X Marks'] = $x_mark ; 
        $DetailArray[$iteration]['X Year'] = $value->SSLC_year_of_completion ; 
        $DetailArray[$iteration]['X Medium'] = $value->SSLC_medium ; 
        
        $DetailArray[$iteration]['Diploma Type'] = null ; 
        $DetailArray[$iteration]['Diploma City'] = null ; 
        
        if ($value->diploma1_institution == "Update Institution details") {
            $value->diploma1_institution = null;
        }
        
        $DetailArray[$iteration]['Diploma University / College / Institute'] = $value->diploma1_institution ; 
        $DetailArray[$iteration]['Diploma Course'] = null ; 
        $DetailArray[$iteration]['Diploma Specialization'] = $value->diploma1_branch ; 
        $DetailArray[$iteration]['Diploma Month of Passing'] = null ; 
        $DetailArray[$iteration]['Diploma Year of Passing'] = $value->diploma1_year_of_completion ; 
        $DetailArray[$iteration]['Diploma Grading System'] = null ; 
        
        if($value->diploma1_percentage){
        $DetailArray[$iteration]['Diploma Marks / Grade'] = check_range($value->diploma1_percentage);}
        else{$DetailArray[$iteration]['Diploma Marks / Grade'] = null;} 

        $DetailArray[$iteration]['UG Type'] = null ; 
        $DetailArray[$iteration]['UG City'] = null ; 
        
        if ($value->UG1_institution == "Update Institution details") {
            $value->UG1_institution = null;
        }
        
        $DetailArray[$iteration]['UG University / College / Institute'] = $value->UG1_institution ; 
        $DetailArray[$iteration]['UG Course'] = $value->UG1_degree ; 
        $DetailArray[$iteration]['UG Specialization'] = $value->UG1_branch ; 
        $DetailArray[$iteration]['UG Month of Passing'] = null ; 
        $DetailArray[$iteration]['UG Year of Passing'] = $value->UG1_year_of_completion ; 
        $DetailArray[$iteration]['UG Grading System'] = null ; 
        
        if($value->UG1_percentage){
        $DetailArray[$iteration]['UG Marks / Grade'] = check_range($value->UG1_percentage);}
        else{$DetailArray[$iteration]['UG Marks / Grade'] = null;}
        
        
        $DetailArray[$iteration]['PG Type'] = null ; 
        $DetailArray[$iteration]['PG City'] = null ; 
        
        
        if ($value->PG1_institution == "Update Institution details") {
            $value->PG1_institution = null;
        }
        
        $DetailArray[$iteration]['PG University / College / Institute'] = $value->PG1_institution ; 
        $DetailArray[$iteration]['PG Course'] = $value->PG1_degree ; 
        $DetailArray[$iteration]['PG Specialization'] = $value->PG1_branch ; 
        $DetailArray[$iteration]['PG Month of Passing'] = null ; 
        $DetailArray[$iteration]['PG Year of Passing'] = $value->PG1_year_of_completion ; 
        $DetailArray[$iteration]['PG Grading System'] = null ; 
        
        if($value->PG1_percentage){
        $DetailArray[$iteration]['PG Marks / Grade'] = check_range($value->PG1_percentage);}
        else{$DetailArray[$iteration]['PG Marks / Grade'] = null;}

        $DetailArray[$iteration]['AssesmentTest Mark / Score'] = $value->correct ; 

        }
        
        
        //dd($DetailArray);

        Excel::create($testdetails[0]->title.' report', function($excel) use ($userArray,$DetailArray) {

        $excel->sheet('Student Test Report', function($sheet) use ($userArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($userArray);          
        });

        $excel->sheet('Student details', function($sheet) use ($DetailArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($DetailArray);          
        });

        })->download('xls');
        exit;
        
    }
	
	
	public function export_feedback(Request $request,$id)
    {
        
       $API = App::make('APIService');
       $API->request('/admin/export_feedback', "POST",$id);
	
		$title=$API->responseJSON()->title; 
       $college_feedback=$API->responseJSON()->college_feedback;
       $student_feedback=$API->responseJSON()->student_feedback;
	   $userArray = [];
	   foreach ($student_feedback as $iteration => $value) {
        $userArray[$iteration]['S.No'] = $iteration + 1;
		$userArray[$iteration]['Test Instance Id'] = $value->test_login_id;
		$userArray[$iteration]['Student Id'] = $value->student_id;
		$userArray[$iteration]['Name'] = $value->name;
		$userArray[$iteration]['Email'] = $value->email;
		$userArray[$iteration]['Feedback'] = $value->message;
	   }
	   $collegeArray = [];
       if($college_feedback){
		   foreach ($college_feedback as $iteration => $value) {
        $collegeArray[$iteration]['S.No'] = $iteration + 1;
		$collegeArray[$iteration]['Test Instance Id'] = $value->test_login_id;
		$collegeArray[$iteration]['College Id'] = $value->test_user_id;
		$collegeArray[$iteration]['College Name'] = $title;
		$collegeArray[$iteration]['Feedback'] = $value->message;
	   }
	   }
	   
	   Excel::create($title.' feedback', function($excel) use ($userArray,$collegeArray) {

        $excel->sheet('Students feedback', function($sheet) use ($userArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($userArray);          
        });

        $excel->sheet('College feedback', function($sheet) use ($collegeArray) { 
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($collegeArray);          
        });

        })->download('xls');
        exit;
        
    }
	
	public function download_college_students($id)
    {
		
		function check_range($id)
    {

        switch ($id){
            
        case ($id<= 40): 
            $id = "< 40%";
        break;

        case ($id>= 40 && $id< 45): 
            $id = "40 - 44.9%";
        break;
        
        case ($id>= 45 && $id< 50): 
            $id = "45 - 49.9%";
        break;
        
        case ($id>= 50 && $id< 55): 
            $id = "50 - 54.9%";
        break;
        
        case ($id>= 55 && $id< 60): 
            $id = "55 - 59.9%";
        break;
        
        case ($id>= 60 && $id< 65): 
            $id = "60 - 64.9%";
        break;
        
        case ($id>= 65 && $id< 70): 
            $id = "65 - 69.9%";
        break;
        
        case ($id>= 70 && $id< 75): 
            $id = "70 - 74.9%";
        break;
        
        case ($id>= 75 && $id< 80): 
            $id = "75 - 79.9%";
        break;
        
        case ($id>= 80 && $id< 85): 
            $id = "80 - 84.9%";
        break;
        
        case ($id>= 85 && $id< 90): 
            $id = "85 - 89.9%";
        break;
        
        case ($id>= 90 && $id< 95): 
            $id = "90 - 94.9%";
        break;
        
        case ($id>= 95 && $id< 100): 
            $id = "95 - 99.9%";
        break;
        
        case ($id== 100): 
            $id = "100%";
        break;
        
        
        default: 
            $id = " ";
        break;
     }
     
     return $id;
     
    }
     
        
       $API = App::make('APIService');
       $API->request('/admin/download_college_students', "POST",$id);
	
		$detail = $API->responseJSON()->detail;
		$title = $API->responseJSON()->title;
		
		$DetailArray = [];
		
	   foreach ($detail as $iteration => $value) {
         $DetailArray[$iteration]['S.No'] = $iteration + 1;
		  $DetailArray[$iteration]['Techruit Student id'] = $value->student_id;
        $DetailArray[$iteration]['Name'] = $value->student_name;
        $DetailArray[$iteration]['Email'] = $value->email;
        $DetailArray[$iteration]['Mobile'] = $value->mobile; 

        $dob = date_create($value->date_of_birth);

        $DetailArray[$iteration]['Day'] = date_format($dob, 'd'); 
        $DetailArray[$iteration]['Month'] = date_format($dob, 'M'); 
        $DetailArray[$iteration]['Year'] = date_format($dob, 'Y'); 
        $DetailArray[$iteration]['Gender'] = $value->gender; 
        $DetailArray[$iteration]['STD code'] = null ; 

        $DetailArray[$iteration]['Phone Number'] = $value->phone ; 
        $DetailArray[$iteration]['Current Location'] = null ; 
        $DetailArray[$iteration]['Home Town'] = null ; 
        $DetailArray[$iteration]['Work Type'] = $value->work_type ; 
        $DetailArray[$iteration]['Joining Date'] = $value->work_month ; 

        $DetailArray[$iteration]['Preferred Location'] =  $value->preferred_location ; 
        $DetailArray[$iteration]['Highest Degree'] = $value->highest_degree ; 

        $DetailArray[$iteration]['XII Board'] = $value->HSC_board ; 
        
        $xii_mark = check_range($value->HSC_percentage);
        
        $DetailArray[$iteration]['XII Marks'] = $xii_mark ; 
        $DetailArray[$iteration]['XII Year'] = $value->HSC_year_of_completion ; 
        $DetailArray[$iteration]['XII Medium'] = $value->HSC_medium ; 

        $DetailArray[$iteration]['X Board'] = $value->SSLC_board ; 
        
        $x_mark = check_range($value->SSLC_percentage);
        
        $DetailArray[$iteration]['X Marks'] = $x_mark ; 
        $DetailArray[$iteration]['X Year'] = $value->SSLC_year_of_completion ; 
        $DetailArray[$iteration]['X Medium'] = $value->SSLC_medium ; 
        
        $DetailArray[$iteration]['Diploma Type'] = null ; 
        $DetailArray[$iteration]['Diploma City'] = null ; 
        
        if ($value->diploma1_institution == "Update Institution details") {
            $value->diploma1_institution = null;
        }
        
        $DetailArray[$iteration]['Diploma University / College / Institute'] = $value->diploma1_institution ; 
        $DetailArray[$iteration]['Diploma Course'] = null ; 
        $DetailArray[$iteration]['Diploma Specialization'] = $value->diploma1_branch ; 
        $DetailArray[$iteration]['Diploma Month of Passing'] = null ; 
        $DetailArray[$iteration]['Diploma Year of Passing'] = $value->diploma1_year_of_completion ; 
        $DetailArray[$iteration]['Diploma Grading System'] = null ; 
        
        if($value->diploma1_percentage){
        $DetailArray[$iteration]['Diploma Marks / Grade'] = check_range($value->diploma1_percentage);}
        else{$DetailArray[$iteration]['Diploma Marks / Grade'] = null;} 

        $DetailArray[$iteration]['UG Type'] = null ; 
        $DetailArray[$iteration]['UG City'] = null ; 
        
        if ($value->UG1_institution == "Update Institution details") {
            $value->UG1_institution = null;
        }
        
        $DetailArray[$iteration]['UG University / College / Institute'] = $value->UG1_institution ; 
        $DetailArray[$iteration]['UG Course'] = $value->UG1_degree ; 
        $DetailArray[$iteration]['UG Specialization'] = $value->UG1_branch ; 
        $DetailArray[$iteration]['UG Month of Passing'] = null ; 
        $DetailArray[$iteration]['UG Year of Passing'] = $value->UG1_year_of_completion ; 
        $DetailArray[$iteration]['UG Grading System'] = null ; 
        
        if($value->UG1_percentage){
        $DetailArray[$iteration]['UG Marks / Grade'] = check_range($value->UG1_percentage);}
        else{$DetailArray[$iteration]['UG Marks / Grade'] = null;}
        
        
        $DetailArray[$iteration]['PG Type'] = null ; 
        $DetailArray[$iteration]['PG City'] = null ; 
        
        
        if ($value->PG1_institution == "Update Institution details") {
            $value->PG1_institution = null;
        }
        
        $DetailArray[$iteration]['PG University / College / Institute'] = $value->PG1_institution ; 
        $DetailArray[$iteration]['PG Course'] = $value->PG1_degree ; 
        $DetailArray[$iteration]['PG Specialization'] = $value->PG1_branch ; 
        $DetailArray[$iteration]['PG Month of Passing'] = null ; 
        $DetailArray[$iteration]['PG Year of Passing'] = $value->PG1_year_of_completion ; 
        $DetailArray[$iteration]['PG Grading System'] = null ; 
        
        if($value->PG1_percentage){
        $DetailArray[$iteration]['PG Marks / Grade'] = check_range($value->PG1_percentage);}
        else{$DetailArray[$iteration]['PG Marks / Grade'] = null;}	

	   }
        
		Excel::create($title.' records', function($excel) use ($DetailArray) {

        $excel->sheet('Student details', function($sheet) use ($DetailArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($DetailArray);          
        });

        })->download('xls');
        exit;
    }
	
	public function download_record(Request $request)
    {
		function check_range($id)
    {

        switch ($id){
            
        case ($id<= 40): 
            $id = "< 40%";
        break;

        case ($id>= 40 && $id< 45): 
            $id = "40 - 44.9%";
        break;
        
        case ($id>= 45 && $id< 50): 
            $id = "45 - 49.9%";
        break;
        
        case ($id>= 50 && $id< 55): 
            $id = "50 - 54.9%";
        break;
        
        case ($id>= 55 && $id< 60): 
            $id = "55 - 59.9%";
        break;
        
        case ($id>= 60 && $id< 65): 
            $id = "60 - 64.9%";
        break;
        
        case ($id>= 65 && $id< 70): 
            $id = "65 - 69.9%";
        break;
        
        case ($id>= 70 && $id< 75): 
            $id = "70 - 74.9%";
        break;
        
        case ($id>= 75 && $id< 80): 
            $id = "75 - 79.9%";
        break;
        
        case ($id>= 80 && $id< 85): 
            $id = "80 - 84.9%";
        break;
        
        case ($id>= 85 && $id< 90): 
            $id = "85 - 89.9%";
        break;
        
        case ($id>= 90 && $id< 95): 
            $id = "90 - 94.9%";
        break;
        
        case ($id>= 95 && $id< 100): 
            $id = "95 - 99.9%";
        break;
        
        case ($id== 100): 
            $id = "100%";
        break;
        
        
        default: 
            $id = " ";
        break;
     }
     
     return $id;
     
    }
     
        
       $API = App::make('APIService');
       $API->request('/admin/download_college_students', "POST",$request['college_id']);
	
		$detail = $API->responseJSON()->detail;
		$title = $API->responseJSON()->title;
		
		$DetailArray = [];
		
	   foreach ($detail as $iteration => $value) {
         $DetailArray[$iteration]['S.No'] = $iteration + 1;
		  $DetailArray[$iteration]['Techruit Student id'] = $value->student_id;
        $DetailArray[$iteration]['Name'] = $value->student_name;
        $DetailArray[$iteration]['Email'] = $value->email;
        $DetailArray[$iteration]['Mobile'] = $value->mobile; 

        $dob = date_create($value->date_of_birth);

        $DetailArray[$iteration]['Day'] = date_format($dob, 'd'); 
        $DetailArray[$iteration]['Month'] = date_format($dob, 'M'); 
        $DetailArray[$iteration]['Year'] = date_format($dob, 'Y'); 
        $DetailArray[$iteration]['Gender'] = $value->gender; 
        $DetailArray[$iteration]['STD code'] = null ; 

        $DetailArray[$iteration]['Phone Number'] = $value->phone ; 
        $DetailArray[$iteration]['Current Location'] = null ; 
        $DetailArray[$iteration]['Home Town'] = null ; 
        $DetailArray[$iteration]['Work Type'] = $value->work_type ; 
        $DetailArray[$iteration]['Joining Date'] = $value->work_month ; 

        $DetailArray[$iteration]['Preferred Location'] =  $value->preferred_location ; 
        $DetailArray[$iteration]['Highest Degree'] = $value->highest_degree ; 

        $DetailArray[$iteration]['XII Board'] = $value->HSC_board ; 
        
        $xii_mark = check_range($value->HSC_percentage);
        
        $DetailArray[$iteration]['XII Marks'] = $xii_mark ; 
        $DetailArray[$iteration]['XII Year'] = $value->HSC_year_of_completion ; 
        $DetailArray[$iteration]['XII Medium'] = $value->HSC_medium ; 

        $DetailArray[$iteration]['X Board'] = $value->SSLC_board ; 
        
        $x_mark = check_range($value->SSLC_percentage);
        
        $DetailArray[$iteration]['X Marks'] = $x_mark ; 
        $DetailArray[$iteration]['X Year'] = $value->SSLC_year_of_completion ; 
        $DetailArray[$iteration]['X Medium'] = $value->SSLC_medium ; 
        
        $DetailArray[$iteration]['Diploma Type'] = null ; 
        $DetailArray[$iteration]['Diploma City'] = null ; 
        
        if ($value->diploma1_institution == "Update Institution details") {
            $value->diploma1_institution = null;
        }
        
        $DetailArray[$iteration]['Diploma University / College / Institute'] = $value->diploma1_institution ; 
        $DetailArray[$iteration]['Diploma Course'] = null ; 
        $DetailArray[$iteration]['Diploma Specialization'] = $value->diploma1_branch ; 
        $DetailArray[$iteration]['Diploma Month of Passing'] = null ; 
        $DetailArray[$iteration]['Diploma Year of Passing'] = $value->diploma1_year_of_completion ; 
        $DetailArray[$iteration]['Diploma Grading System'] = null ; 
        
        if($value->diploma1_percentage){
        $DetailArray[$iteration]['Diploma Marks / Grade'] = $value->diploma1_percentage;}
        else{$DetailArray[$iteration]['Diploma Marks / Grade'] = null;} 

        $DetailArray[$iteration]['UG Type'] = null ; 
        $DetailArray[$iteration]['UG City'] = null ; 
        
        if ($value->UG1_institution == "Update Institution details") {
            $value->UG1_institution = null;
        }
        
        $DetailArray[$iteration]['UG University / College / Institute'] = $value->UG1_institution ; 
        $DetailArray[$iteration]['UG Course'] = $value->UG1_degree ; 
        $DetailArray[$iteration]['UG Specialization'] = $value->UG1_branch ; 
        $DetailArray[$iteration]['UG Month of Passing'] = null ; 
        $DetailArray[$iteration]['UG Year of Passing'] = $value->UG1_year_of_completion ; 
        $DetailArray[$iteration]['UG Grading System'] = null ; 
        
        if($value->UG1_percentage){
        $DetailArray[$iteration]['UG Marks / Grade'] = $value->UG1_percentage;}
        else{$DetailArray[$iteration]['UG Marks / Grade'] = null;}
        
        
        $DetailArray[$iteration]['PG Type'] = null ; 
        $DetailArray[$iteration]['PG City'] = null ; 
        
        
        if ($value->PG1_institution == "Update Institution details") {
            $value->PG1_institution = null;
        }
        
        $DetailArray[$iteration]['PG University / College / Institute'] = $value->PG1_institution ; 
        $DetailArray[$iteration]['PG Course'] = $value->PG1_degree ; 
        $DetailArray[$iteration]['PG Specialization'] = $value->PG1_branch ; 
        $DetailArray[$iteration]['PG Month of Passing'] = null ; 
        $DetailArray[$iteration]['PG Year of Passing'] = $value->PG1_year_of_completion ; 
        $DetailArray[$iteration]['PG Grading System'] = null ; 
        
        if($value->PG1_percentage){
        $DetailArray[$iteration]['PG Marks / Grade'] = $value->PG1_percentage;}
        else{$DetailArray[$iteration]['PG Marks / Grade'] = null;}	

	   }
        
		Excel::create($title.' records', function($excel) use ($DetailArray) {

        $excel->sheet('Student details', function($sheet) use ($DetailArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($DetailArray);          
        });

        })->download('xls');
        exit;
	}
    
   public function download_all_college_students($id)
    {
		
		function check_range($id)
    {

        switch ($id){
            
        case ($id<= 40): 
            $id = "< 40%";
        break;

        case ($id>= 40 && $id< 45): 
            $id = "40 - 44.9%";
        break;
        
        case ($id>= 45 && $id< 50): 
            $id = "45 - 49.9%";
        break;
        
        case ($id>= 50 && $id< 55): 
            $id = "50 - 54.9%";
        break;
        
        case ($id>= 55 && $id< 60): 
            $id = "55 - 59.9%";
        break;
        
        case ($id>= 60 && $id< 65): 
            $id = "60 - 64.9%";
        break;
        
        case ($id>= 65 && $id< 70): 
            $id = "65 - 69.9%";
        break;
        
        case ($id>= 70 && $id< 75): 
            $id = "70 - 74.9%";
        break;
        
        case ($id>= 75 && $id< 80): 
            $id = "75 - 79.9%";
        break;
        
        case ($id>= 80 && $id< 85): 
            $id = "80 - 84.9%";
        break;
        
        case ($id>= 85 && $id< 90): 
            $id = "85 - 89.9%";
        break;
        
        case ($id>= 90 && $id< 95): 
            $id = "90 - 94.9%";
        break;
        
        case ($id>= 95 && $id< 100): 
            $id = "95 - 99.9%";
        break;
        
        case ($id== 100): 
            $id = "100%";
        break;
        
        
        default: 
            $id = " ";
        break;
     }
     
     return $id;
     
    }
     
        
       $API = App::make('APIService');
       $API->request('/admin/download_all_college_students', "POST",$id);
	
		$detail = $API->responseJSON()->detail;
		$title = $API->responseJSON()->title;
		
		$DetailArray = [];
		
	   foreach ($detail as $iteration => $value) {
         $DetailArray[$iteration]['S.No'] = $iteration + 1;
		  $DetailArray[$iteration]['Techruit Student id'] = $value->student_id;
        $DetailArray[$iteration]['Name'] = $value->student_name;
        $DetailArray[$iteration]['Email'] = $value->email;
        $DetailArray[$iteration]['Mobile'] = $value->mobile; 

        $dob = date_create($value->date_of_birth);

        $DetailArray[$iteration]['Day'] = date_format($dob, 'd'); 
        $DetailArray[$iteration]['Month'] = date_format($dob, 'M'); 
        $DetailArray[$iteration]['Year'] = date_format($dob, 'Y'); 
        $DetailArray[$iteration]['Gender'] = $value->gender; 
        $DetailArray[$iteration]['STD code'] = null ; 

        $DetailArray[$iteration]['Phone Number'] = $value->phone ; 
        $DetailArray[$iteration]['Current Location'] = null ; 
        $DetailArray[$iteration]['Home Town'] = null ; 
        $DetailArray[$iteration]['Work Type'] = $value->work_type ; 
        $DetailArray[$iteration]['Joining Date'] = $value->work_month ; 

        $DetailArray[$iteration]['Preferred Location'] =  $value->preferred_location ; 
        $DetailArray[$iteration]['Highest Degree'] = $value->highest_degree ; 

        $DetailArray[$iteration]['XII Board'] = $value->HSC_board ; 
        
        $xii_mark = check_range($value->HSC_percentage);
        
        $DetailArray[$iteration]['XII Marks'] = $xii_mark ; 
        $DetailArray[$iteration]['XII Year'] = $value->HSC_year_of_completion ; 
        $DetailArray[$iteration]['XII Medium'] = $value->HSC_medium ; 

        $DetailArray[$iteration]['X Board'] = $value->SSLC_board ; 
        
        $x_mark = check_range($value->SSLC_percentage);
        
        $DetailArray[$iteration]['X Marks'] = $x_mark ; 
        $DetailArray[$iteration]['X Year'] = $value->SSLC_year_of_completion ; 
        $DetailArray[$iteration]['X Medium'] = $value->SSLC_medium ; 
        
        $DetailArray[$iteration]['Diploma Type'] = null ; 
        $DetailArray[$iteration]['Diploma City'] = null ; 
        
        if ($value->diploma1_institution == "Update Institution details") {
            $value->diploma1_institution = null;
        }
        
        $DetailArray[$iteration]['Diploma University / College / Institute'] = $value->diploma1_institution ; 
        $DetailArray[$iteration]['Diploma Course'] = null ; 
        $DetailArray[$iteration]['Diploma Specialization'] = $value->diploma1_branch ; 
        $DetailArray[$iteration]['Diploma Month of Passing'] = null ; 
        $DetailArray[$iteration]['Diploma Year of Passing'] = $value->diploma1_year_of_completion ; 
        $DetailArray[$iteration]['Diploma Grading System'] = null ; 
        
        if($value->diploma1_percentage){
        $DetailArray[$iteration]['Diploma Marks / Grade'] = check_range($value->diploma1_percentage);}
        else{$DetailArray[$iteration]['Diploma Marks / Grade'] = null;} 

        $DetailArray[$iteration]['UG Type'] = null ; 
        $DetailArray[$iteration]['UG City'] = null ; 
        
        if ($value->UG1_institution == "Update Institution details") {
            $value->UG1_institution = null;
        }
        
        $DetailArray[$iteration]['UG University / College / Institute'] = $value->UG1_institution ; 
        $DetailArray[$iteration]['UG Course'] = $value->UG1_degree ; 
        $DetailArray[$iteration]['UG Specialization'] = $value->UG1_branch ; 
        $DetailArray[$iteration]['UG Month of Passing'] = null ; 
        $DetailArray[$iteration]['UG Year of Passing'] = $value->UG1_year_of_completion ; 
        $DetailArray[$iteration]['UG Grading System'] = null ; 
        
        if($value->UG1_percentage){
        $DetailArray[$iteration]['UG Marks / Grade'] = $value->UG1_percentage;}
        else{$DetailArray[$iteration]['UG Marks / Grade'] = null;}
        
        
        $DetailArray[$iteration]['PG Type'] = null ; 
        $DetailArray[$iteration]['PG City'] = null ; 
        
        
        if ($value->PG1_institution == "Update Institution details") {
            $value->PG1_institution = null;
        }
        
        $DetailArray[$iteration]['PG University / College / Institute'] = $value->PG1_institution ; 
        $DetailArray[$iteration]['PG Course'] = $value->PG1_degree ; 
        $DetailArray[$iteration]['PG Specialization'] = $value->PG1_branch ; 
        $DetailArray[$iteration]['PG Month of Passing'] = null ; 
        $DetailArray[$iteration]['PG Year of Passing'] = $value->PG1_year_of_completion ; 
        $DetailArray[$iteration]['PG Grading System'] = null ; 
        
        if($value->PG1_percentage){
        $DetailArray[$iteration]['PG Marks / Grade'] = check_range($value->PG1_percentage);}
        else{$DetailArray[$iteration]['PG Marks / Grade'] = null;}	

	   }
        
		Excel::create($title.' records', function($excel) use ($DetailArray) {

        $excel->sheet('Student details', function($sheet) use ($DetailArray) {
        $sheet->freezeFirstRow();   
        $sheet->setOrientation('landscape');
        
        $sheet->fromArray($DetailArray);          
        });

        })->download('xls');
        exit;
    }
    
   
   
	 public function batchinstance(Request $request,$id)
    {
     
       $API = App::make('APIService');
       $API->request('/admin/batchinstance', "POST",$id);

       $batch_details = $API->responseJSON()->batch_details;
       $test_details = $API->responseJSON()->test_details;
	   
        return view('admin.testinstance')->with('batch_details',$batch_details)->with('test_details',$test_details);
    }

    public function testlogin_admin($id) 
    {
		
		if($this->session->get('user_authenticated.reg_id') != $id){
			return redirect('/')->with('error', 'Authentication Failed ! ')->with('errortype',1);
		}
		
        $API = App::make('APIService');
        $API->request('/testadmin/testlogin_details', "POST",$id);

		 $details = $API->responseJSON()->details;
	   
	   $college_id = $API->responseJSON()->college_id;
	   $college_name = $API->responseJSON()->college_name;
	   $registered_students = $API->responseJSON()->registered_students;
	   $test_taken = $API->responseJSON()->test_taken;
	   $feedback_count = $API->responseJSON()->feedback;
	   
        return view('testadmin_dashboard')
		->with('details',$details
		)->with('test_id',$id)
		->with('college_id',$college_id)
		->with('college_name',$college_name)
		->with('registered_students',$registered_students)
		->with('feedback_count',$feedback_count)
		->with('test_taken',$test_taken);
		
    }

    public function testadmin_starttest(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/testadmin/starttest', "POST",$request->all());

        $data = (array)$API->responseJSON()->reponseMessage;    

        return $data;
    }

    

    public function reappear_student(Request $request)
    {

        $API = App::make('APIService');
        $API->request('/testadmin/reappear_student', "POST",$request->all());
//dd($API->responseJSON());
        $data = (array)$API->responseJSON()->reponseMessage;    

        return $data;
    }

    public function testadmin_testreport(Request $request,$id)
    {


       $API = App::make('APIService');
       $API->request('/testadmin/testreport', "POST",[$id,$this->session->get('user_authenticated.reg_id')]);
      
      if($API->responseJSON()->responseType == 'success'){
       $subject=$API->responseJSON()->subject; 
       $testdetails=$API->responseJSON()->testdetails;
       $student_details_list=$API->responseJSON()->student_details_list;
       $student_answer=$API->responseJSON()->student_answer;

       if($student_answer == null){

        $details['responseType'] = 'failure';
        $details['reponseMessage'] = 'Sorry ! End test to view test report';

         return view('viewurl')->with('details',$details);

       }


       foreach ($student_details_list as $sdlkey => $sdlvalue) {
       $sdlvalue->correct = 0;$sdlvalue->incorrect = 0;$sdlvalue->attended = 0;$sdlvalue->not_attended = 0;
           foreach ($subject as $skey => $svalue) {
                foreach ($student_answer as $sakey => $savalue) {
                    if($savalue->student_id ==  $sdlvalue->student_id && $savalue->subject_id == $skey){
                        $sdlvalue->$svalue = $savalue->correct;
                        $sdlvalue->correct = $sdlvalue->correct+$savalue->correct;
                        $sdlvalue->incorrect = $sdlvalue->incorrect+$savalue->incorrect;
                        $sdlvalue->attended = $sdlvalue->attended+$savalue->attended;
                        $sdlvalue->not_attended = $sdlvalue->not_attended+$savalue->not_attended;
                    }
                }
               
           }
       }

     
        return view('admin.testadminreport')
       ->with('student_answer',$student_answer)
       ->with('subject',$subject)
       ->with('testdetails',$testdetails)
       ->with('student_details_list',$student_details_list);

       }

       else{

            $details['responseType'] = $API->responseJSON()->responseType;
            $details['reponseMessage'] = $API->responseJSON()->reponseMessage;

            return view('viewurl')->with('details',$details);
       }
    }

    public function testadmin_viewstudents(Request $request,$id)
    {

        $test_user_id = ($this->session->get('user_authenticated.reg_id'));

       $API = App::make('APIService');
       $API->request('/testadmin/viewstudents', "POST",['test_id'=>$id,"test_user_id"=>$test_user_id]);

       if($API->responseJSON()->responseType == 'success'){
       $testdetails = $API->responseJSON()->test_details;
       $student_details_list = $API->responseJSON()->student_details;

       return view('admin.testadmin_view students')->with('testdetails',$testdetails)->with('student_details_list',$student_details_list);
        }
       else{

        $details['responseType'] = $API->responseJSON()->responseType;
            $details['reponseMessage'] = $API->responseJSON()->reponseMessage;

            return view('viewurl')->with('details',$details);
       }
    }
	
	public function admin_viewstudents(Request $request,$id)
    {

        $test_user_id = ($this->session->get('user_authenticated.reg_id'));

       $API = App::make('APIService');
       $API->request('/admin/viewstudents', "POST",['test_id'=>$id,"test_user_id"=>$test_user_id]);
dd($API->responseJSON());
       if($API->responseJSON()->responseType == 'success'){
       $testdetails = $API->responseJSON()->test_details;
       $student_details_list = $API->responseJSON()->student_details;

       return view('admin.admin_view_students')->with('testdetails',$testdetails)->with('student_details_list',$student_details_list);
        }
       else{

			$details['responseType'] = $API->responseJSON()->responseType;
            $details['reponseMessage'] = $API->responseJSON()->reponseMessage;

			return redirect('/')->with('error', $API->responseJSON()->reponseMessage);
       }
    }
	
	

public function page4()
    {

        return view('admin.page4');
    }
    

    
}