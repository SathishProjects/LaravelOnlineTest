<?php namespace App;

use Carbon;
use App\TestResponseMaster;
use App\StudentTestLoginMaster;

use Illuminate\Database\Eloquent\Model;

class TestReportMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "test_report_id";

		public static function save_report_before_delete($data,$subject)
		{
			$data1 =  array_filter($data);	
			$created_on = Carbon::now();

				foreach ($data1 as $dkey => $dvalue) {

					foreach ($dvalue as $key => $value) {
						$record[] = $value;
					}
					
				}

				foreach ($record as $rkey => $rvalue) {
					$record[$rkey]['created_on'] = $created_on ;

					TestReportMaster::create($record[$rkey]);
				}
			  
			  

			  return "hai";

	    }
		
		public static function generate_report($test_id,$students,$subjects)
		{

			$insert_count = 0;
			$student_subject_marks = [];
			$time = Carbon::now();
			
			
				 foreach ($students as $sd_key => $sd_val) {

				 	$student_subject_marks['test_id'] = $test_id;
					$student_subject_marks['student_id'] = $sd_val;
					$student_subject_marks['created_on'] = $time;	

					$total_mark_detail = \DB::select(sprintf("SELECT SUM(is_correct) AS total FROM `test_response_masters` WHERE student_id = %d AND test_id = %d ",$sd_val,$test_id));

					StudentTestLoginMaster::where('student_id',$sd_val)->where('test_id',$test_id)->update(['score'=>$total_mark_detail[0]->total]);

				 	foreach ($subjects as $sub_key => $sub_value) {
				 		$student_subject_marks['subject_id'] = $sub_value['id'];
						$student_subject_marks['total'] =  $sub_value['total'];

						$subject_mark_detail = \DB::select(sprintf("SELECT COUNT(test_response_id) AS attended,SUM(is_correct) AS correct FROM `test_response_masters` WHERE student_id = %d AND test_id = %d  AND subject_id = %d",$sd_val,$test_id,$sub_value['id']));

						$student_subject_marks['correct'] = $subject_mark_detail[0]->correct;
						$student_subject_marks['incorrect'] = $sub_value['total'] - $subject_mark_detail[0]->correct;	
						
						$student_subject_marks['attended'] = $subject_mark_detail[0]->attended;
						$student_subject_marks['not_attended'] = $sub_value['total'] - $subject_mark_detail[0]->attended;	

						$count = TestReportMaster::create($student_subject_marks);

									if($count){
										$insert_count++;
									}

			            } 


				 }
			
			
			return $count;
	    }

}
