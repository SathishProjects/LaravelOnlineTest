<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubjectMaster;

class SectionMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "section_id";


	public static function saveall($data)
		{
			$a =   SectionMaster::create($data);

			return $a->section_id;	

	    }

	    public static function get_section_data($id)
		{

			$tmp_data =  SectionMaster::where('qp_id',$id)->get();

			

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_subject_id'] = $tmp_data[$key]['section_subject'];
				$tmp_data[$key]['section_subject']   =  SubjectMaster::where('subject_id',$tmp_data[$key]['section_subject'])->pluck('name');
			}

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_chapter_id'] = $tmp_data[$key]['section_chapter'];
				$tmp_data[$key]['section_chapter']   =  SubjectMaster::where('subject_id',$tmp_data[$key]['section_chapter'])->pluck('name');
			}

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_value']   =  $key+1;
			}

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['finished_questions']   =  QuestionPaperQuestionsMaster::where('qp_id',$id)->where('section_id',$tmp_data[$key]['section_id'])->get(['qpq_order_id']);
			}

			return $tmp_data;
		}

	    public static function get_section_chapter_data($id)
		{

			$section_subject =  SectionMaster::where('section_id',$id)->get(['section_subject']);

			$subject_id =  $section_subject[0]->section_subject;

			return SubjectMaster::where('reference_id',$subject_id)->orderBy('subject_id', 'ASC')->lists('name', 'subject_id');
		}	

		 public static function get_all_section_data($id)
		{

			 $section_details =  SectionMaster::where('qp_id','=',$id)->get();

            foreach ($section_details as $key => $value) {
                
                $section_details[$key]['section_subject_id'] = $section_details[$key]['section_subject'];
                $section_details[$key]['section_subject']   =  SubjectMaster::where('subject_id',$section_details[$key]['section_subject'])->pluck('name');
            }

            return $section_details;
		}		


		public static function get_section_list($id)
		{

			$tmp_data =  SectionMaster::where('qp_id',$id)->get(['section_id','qp_id','terms_conditions','section_type','question_type','section_question','question_image','section_subject','section_chapter','number_of_questions_section','marks_per_question','section_total','if_negative_marks','status']);

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_subject_id'] = $tmp_data[$key]['section_subject'];
				$tmp_data[$key]['section_subject']   =  SubjectMaster::where('subject_id',$tmp_data[$key]['section_subject'])->pluck('name');
			}

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_chapter_id'] = $tmp_data[$key]['section_chapter'];
				$tmp_data[$key]['section_chapter']   =  SubjectMaster::where('subject_id',$tmp_data[$key]['section_chapter'])->pluck('name');
			}

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_value']   =  $key+1;
			}

			return $tmp_data;
		}

		public static function get_section_details($id)
		{

			$tmp_data =  SectionMaster::where('qp_id',$id)->get(['section_id','qp_id','section_subject','number_of_questions_section','marks_per_question','section_total','if_negative_marks']);

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_subject_id'] = $tmp_data[$key]['section_subject'];
				$tmp_data[$key]['section_subject']   =  SubjectMaster::where('subject_id',$tmp_data[$key]['section_subject'])->pluck('name');
			}

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_chapter_id'] = $tmp_data[$key]['section_chapter'];
				$tmp_data[$key]['section_chapter']   =  SubjectMaster::where('subject_id',$tmp_data[$key]['section_chapter'])->pluck('name');
			}

			foreach ($tmp_data as $key => $value) {
				
				$tmp_data[$key]['section_value']   =  $key+1;
			}

			return $tmp_data;
		}
		
		public static function get_questionpaper_subject_list($id)
		{
			
			$tmp_data =  SectionMaster::where('qp_id',$id)->get(['section_id','section_subject','number_of_questions_section']);
			
			
			$tmp_subject = [];
               
                foreach ($tmp_data as $tkey1 => $tvalue1) {
                    if(!in_array( $tvalue1->section_subject, $tmp_subject))
                        $tmp_subject[] = $tvalue1->section_subject;
                }
			
			foreach ($tmp_subject as $tskey => $tsvalue) {				
				$subject[$tskey]['id'] = $tsvalue;
				$subject[$tskey]['subject'] = SubjectMaster::where('subject_id',$tsvalue)->pluck('name');
				$subject[$tskey]['total'] = 0;
			}	
			
			
			foreach ($subject as $subkey => $subval) {
				foreach($tmp_data as $tmpdata => $tmpval){
					if($subject[$subkey]['id'] == $tmpval->section_subject){
						$subject[$subkey]['total'] = $subject[$subkey]['total'] + $tmpval->number_of_questions_section;
					}
				}
					
			}
					
			
			return $subject;			
			
		}
















}
