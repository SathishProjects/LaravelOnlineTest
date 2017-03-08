<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchMaster extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "batch_id";


	public static function saveall($data)
		{
			$a =   BatchMaster::create($data);

			return $a->batch_id;	

	    }

	    public static function updateAll($data)
		{
			$a =   BatchMaster::where('batch_id',$data['batch_id'])->update($data);

			return $a;	

	    }


public static function getBatch($college_id,$status)
{

 	$batch = \DB:: select (sprintf('SELECT b.batch_id,b.batch_year,CONCAT(b.batch_year, " - " ,b.batch_year_to) AS batch,b.batch_degree,deg.degree_subtype_name AS degree,b.batch_branch,bra.course_name AS course,b.student_count FROM `batch_masters` AS b

INNER JOIN `degree_subtype` AS deg ON deg.id = b.batch_degree

INNER JOIN `course_master` AS bra ON bra.id = b.batch_branch

WHERE b.college_id = "%d" ORDER BY b.batch_year DESC,b.batch_degree ASC',$college_id));

	return $batch;
}

public static function viewBatch($data)
{

 	$users = BatchMaster::where('batch_id',$data)->join('degree_subtype', 'degree_subtype.id', '=', 'batch_masters.batch_degree')
 			->join('course_master', 'course_master.id', '=', 'batch_masters.batch_branch')
            ->select('batch_masters.*','degree_subtype.degree_subtype_name','course_master.course_name')
            ->get();

	return $users;
}

public static function view_editbatch_detail($data)
{

 	$users = BatchMaster::where('batch_id',$data)->get();

	return $users;
}
















}
