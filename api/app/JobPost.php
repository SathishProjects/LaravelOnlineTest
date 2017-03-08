<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CollegeMaster;
use App\CompanyMaster;
use App\CollegeCourse;

class JobPost extends Model {

	protected $guarded =[];
	public $timestamps = false;

		protected $primaryKey = "job_id";
		protected $table = "job_post";


		public static function College_getJobs($data)
		{

				$college_degree = \DB::select('SELECT DISTINCT GROUP_CONCAT(degree_type_id) as college_dge from college_course_master where college_id = :clgid',array('clgid' => $data['college_id']));

				$college_dge = $college_degree[0]->college_dge;

				$jobs = \DB::select('SELECT DISTINCT jp.job_id, jp.status, jp.company_id, jp.drive_type, jp.title, jp.designation, jp.lastdate_to_apply, jp.created_on, jp.salary, jp.diploma_required_branch, jp.ug_required_degree, jp.ug_required_branch, jp.pg_required_degree, jp.pg_required_branch,
					(SELECT GROUP_CONCAT(DISTINCT sm.name) from skills_master as sm where FIND_IN_SET(sm.id, jp.skills)) as skills,
					(SELECT GROUP_CONCAT(DISTINCT course_name) from course_master where FIND_IN_SET(id,jp.diploma_required_branch) OR FIND_IN_SET(id,jp.ug_required_branch) OR FIND_IN_SET(id,jp.pg_required_branch)) as course,
					(SELECT GROUP_CONCAT(DISTINCT degree_subtype_name) from degree_subtype where FIND_IN_SET(id,jp.ug_required_degree) OR FIND_IN_SET(id,jp.pg_required_degree)) as degree
				    from `job_post` as jp
				    inner join college_course_master as ccm on ccm.college_id = :collegeid
				    where jp.status = 1 
				    AND 
				    (CASE WHEN FIND_IN_SET(26,:clgdge) THEN
					CASE WHEN FIND_IN_SET(26,jp.degree_type_required) THEN FIND_IN_SET(ccm.course_id,jp.diploma_required_branch) ELSE FALSE END 					
				    	ELSE
				    	  FALSE
				    	END
					OR
					CASE WHEN FIND_IN_SET(20,:clgdge1) THEN
						    CASE WHEN FIND_IN_SET(20,jp.degree_type_required) THEN 
								    	CASE WHEN FIND_IN_SET(-1,jp.ug_required_degree)  THEN 
								    		TRUE 
								    		ELSE
								    		FIND_IN_SET(ccm.degree_subtype_id,jp.ug_required_degree) AND 

								    		(FIND_IN_SET(ccm.course_id,jp.ug_required_branch) OR jp.ug_required_branch < 0) 
								    	END 
						    	ELSE FALSE END
				    ELSE FALSE END
				    OR
					CASE WHEN FIND_IN_SET(21,:clgdge2) THEN
						    CASE WHEN FIND_IN_SET(21,jp.degree_type_required) THEN 
								    	CASE WHEN FIND_IN_SET(-2,jp.pg_required_degree)  THEN 
								    		TRUE 
								    		ELSE
								    		FIND_IN_SET(ccm.degree_subtype_id,jp.pg_required_degree) AND 

								    		(FIND_IN_SET(ccm.course_id,jp.pg_required_branch) OR jp.pg_required_branch < 0)
								    	END 
						    	ELSE FALSE END
				    ELSE FALSE END)
				    ORDER BY jp.job_id DESC LIMIT 10',array('collegeid' => $data['college_id'],'clgdge' => $college_dge,'clgdge1' => $college_dge,'clgdge2' => $college_dge));			

			        return $jobs;

		}


		public static function College_getJobs_nextpage($data)
		{

			    $college_degree = \DB::select('SELECT DISTINCT GROUP_CONCAT(degree_type_id) as college_dge from college_course_master where college_id = :clgid',array('clgid' => $data['college_id']));

				$college_dge = $college_degree[0]->college_dge;

				$jobs = \DB::select('SELECT DISTINCT jp.job_id, jp.status, jp.company_id, jp.drive_type, jp.title, jp.designation, jp.lastdate_to_apply, jp.created_on, jp.salary, jp.diploma_required_branch, jp.ug_required_degree, jp.ug_required_branch, jp.pg_required_degree, jp.pg_required_branch,
					(SELECT GROUP_CONCAT(DISTINCT sm.name) from skills_master as sm where FIND_IN_SET(sm.id, jp.skills)) as skills,
					(SELECT GROUP_CONCAT(DISTINCT course_name) from course_master where FIND_IN_SET(id,jp.diploma_required_branch) OR FIND_IN_SET(id,jp.ug_required_branch) OR FIND_IN_SET(id,jp.pg_required_branch)) as course,
					(SELECT GROUP_CONCAT(DISTINCT degree_subtype_name) from degree_subtype where FIND_IN_SET(id,jp.ug_required_degree) OR FIND_IN_SET(id,jp.pg_required_degree)) as degree
				    from `job_post` as jp
				    inner join college_course_master as ccm on ccm.college_id = :collegeid
				    where jp.drive_type = :sort AND jp.job_id>:next AND jp.status = 1 
				    AND 
				    (CASE WHEN FIND_IN_SET(26,:clgdge) THEN
					CASE WHEN FIND_IN_SET(26,jp.degree_type_required) THEN FIND_IN_SET(ccm.course_id,jp.diploma_required_branch) ELSE FALSE END 					
				    	ELSE
				    	  FALSE
				    	END
					OR
					CASE WHEN FIND_IN_SET(20,:clgdge1) THEN
						    CASE WHEN FIND_IN_SET(20,jp.degree_type_required) THEN 
								    	CASE WHEN FIND_IN_SET(-1,jp.ug_required_degree)  THEN 
								    		TRUE 
								    		ELSE
								    		FIND_IN_SET(ccm.degree_subtype_id,jp.ug_required_degree) AND 

								    		(FIND_IN_SET(ccm.course_id,jp.ug_required_branch) OR jp.ug_required_branch < 0) 
								    	END 
						    	ELSE FALSE END
				    ELSE FALSE END
				    OR
					CASE WHEN FIND_IN_SET(21,:clgdge2) THEN
						    CASE WHEN FIND_IN_SET(21,jp.degree_type_required) THEN 
								    	CASE WHEN FIND_IN_SET(-2,jp.pg_required_degree)  THEN 
								    		TRUE 
								    		ELSE
								    		FIND_IN_SET(ccm.degree_subtype_id,jp.pg_required_degree) AND 

								    		(FIND_IN_SET(ccm.course_id,jp.pg_required_branch) OR jp.pg_required_branch < 0)
								    	END 
						    	ELSE FALSE END
				    ELSE FALSE END)
				    ORDER BY jp.job_id DESC LIMIT 10',array('collegeid' => $data['college_id'],'clgdge' => $college_dge,'clgdge1' => $college_dge,'clgdge2' => $college_dge,'next' => $data['next_value'],'sort' => $data['sort_value']));			

			        return $jobs;

		}



		public static function College_getJobs_prevpage($data)
		{

			    $college_degree = \DB::select('SELECT DISTINCT GROUP_CONCAT(degree_type_id) as college_dge from college_course_master where college_id = :clgid',array('clgid' => $data['college_id']));

				$college_dge = $college_degree[0]->college_dge;

				$jobs = \DB::select('SELECT DISTINCT jp.job_id, jp.status, jp.company_id, jp.drive_type, jp.title, jp.designation, jp.lastdate_to_apply, jp.created_on, jp.salary, jp.diploma_required_branch, jp.ug_required_degree, jp.ug_required_branch, jp.pg_required_degree, jp.pg_required_branch,
					(SELECT GROUP_CONCAT(DISTINCT sm.name) from skills_master as sm where FIND_IN_SET(sm.id, jp.skills)) as skills,
					(SELECT GROUP_CONCAT(DISTINCT course_name) from course_master where FIND_IN_SET(id,jp.diploma_required_branch) OR FIND_IN_SET(id,jp.ug_required_branch) OR FIND_IN_SET(id,jp.pg_required_branch)) as course,
					(SELECT GROUP_CONCAT(DISTINCT degree_subtype_name) from degree_subtype where FIND_IN_SET(id,jp.ug_required_degree) OR FIND_IN_SET(id,jp.pg_required_degree)) as degree
				    from `job_post` as jp
				    inner join college_course_master as ccm on ccm.college_id = :collegeid
				    where jp.drive_type = :sort AND jp.job_id<:prev AND jp.status = 1 
				    AND 
				    (CASE WHEN FIND_IN_SET(26,:clgdge) THEN
					CASE WHEN FIND_IN_SET(26,jp.degree_type_required) THEN FIND_IN_SET(ccm.course_id,jp.diploma_required_branch) ELSE FALSE END 					
				    	ELSE
				    	  FALSE
				    	END
					OR
					CASE WHEN FIND_IN_SET(20,:clgdge1) THEN
						    CASE WHEN FIND_IN_SET(20,jp.degree_type_required) THEN 
								    	CASE WHEN FIND_IN_SET(-1,jp.ug_required_degree)  THEN 
								    		TRUE 
								    		ELSE
								    		FIND_IN_SET(ccm.degree_subtype_id,jp.ug_required_degree) AND 

								    		(FIND_IN_SET(ccm.course_id,jp.ug_required_branch) OR jp.ug_required_branch < 0) 
								    	END 
						    	ELSE FALSE END
				    ELSE FALSE END
				    OR
					CASE WHEN FIND_IN_SET(21,:clgdge2) THEN
						    CASE WHEN FIND_IN_SET(21,jp.degree_type_required) THEN 
								    	CASE WHEN FIND_IN_SET(-2,jp.pg_required_degree)  THEN 
								    		TRUE 
								    		ELSE
								    		FIND_IN_SET(ccm.degree_subtype_id,jp.pg_required_degree) AND 

								    		(FIND_IN_SET(ccm.course_id,jp.pg_required_branch) OR jp.pg_required_branch < 0)
								    	END 
						    	ELSE FALSE END
				    ELSE FALSE END)
				    ORDER BY jp.job_id DESC LIMIT 10',array('collegeid' => $data['college_id'],'clgdge' => $college_dge,'clgdge1' => $college_dge,'clgdge2' => $college_dge,'prev' => $data['prev_value'],'sort' => $data['sort_value']));			

			        return $jobs;

		}



		public static function Company_getJobs($data)
		{

					
				$jobs = \DB::select('SELECT DISTINCT jp.job_id,jp.status,jp.company_id,jp.drive_type,jp.title,jp.designation,jp.lastdate_to_apply,jp.created_on,jp.skills_applicable,jp.salary,jp.diploma_required_branch,jp.ug_required_degree,jp.ug_required_branch,jp.pg_required_degree,jp.pg_required_branch from `job_post` as jp
				    where company_id = :companyid AND jp.status = 1 AND jp.job_id>0 ORDER BY jp.job_id DESC LIMIT 10',array('companyid' => $data['company_id']));
			

			        return $jobs;

		}

		public static function Company_getJobs_nextpage($data)
		{

					
				$jobs = \DB::select('SELECT DISTINCT jp.job_id,jp.status,jp.company_id,jp.drive_type,jp.title,jp.designation,jp.lastdate_to_apply,jp.created_on,jp.skills_applicable,jp.salary,jp.diploma_required_branch,jp.ug_required_degree,jp.ug_required_branch,jp.pg_required_degree,jp.pg_required_branch from `job_post` as jp
				    where company_id = :companyid AND jp.status = 1 AND jp.drive_type = :sort AND jp.job_id>:next ORDER BY jp.job_id DESC LIMIT 10',array('companyid' => $data['company_id'],'next' => $data['next_value'] ,'sort' => $data['sort_value']));
			

			        return $jobs;

		}


		public static function Company_getJobs_prevpage($data)
		{

					
				$jobs = \DB::select('SELECT DISTINCT jp.job_id,jp.status,jp.company_id,jp.drive_type,jp.title,jp.designation,jp.lastdate_to_apply,jp.created_on,jp.skills_applicable,jp.salary,jp.diploma_required_branch,jp.ug_required_degree,jp.ug_required_branch,jp.pg_required_degree,jp.pg_required_branch from `job_post` as jp
				    where company_id = :companyid AND jp.status = 1 AND jp.drive_type = :sort AND jp.job_id<:prev ORDER BY jp.job_id DESC LIMIT 10',array('companyid' => $data['company_id'],'prev' => $data['prev_value'],'sort' => $data['sort_value']));
			

			        return $jobs;

		}



		public static function Company_getclosedJobs($data)
		{

					
				$jobs = \DB::select('SELECT DISTINCT jp.job_id,jp.status,jp.company_id,jp.drive_type,jp.title,jp.designation,jp.lastdate_to_apply,jp.created_on,jp.skills_applicable,jp.salary,jp.diploma_required_branch,jp.ug_required_degree,jp.ug_required_branch,jp.pg_required_degree,jp.pg_required_branch from `job_post` as jp
				    where company_id = :companyid AND jp.status = 2 AND jp.job_id>0 ORDER BY jp.job_id DESC LIMIT 10',array('companyid' => $data['company_id']));
			

			        return $jobs;

		}

		public static function Company_getclosedJobs_nextpage($data)
		{

					
				$jobs = \DB::select('SELECT DISTINCT jp.job_id,jp.status,jp.company_id,jp.drive_type,jp.title,jp.designation,jp.lastdate_to_apply,jp.created_on,jp.skills_applicable,jp.salary,jp.diploma_required_branch,jp.ug_required_degree,jp.ug_required_branch,jp.pg_required_degree,jp.pg_required_branch from `job_post` as jp
				    where company_id = :companyid AND jp.status = 2 AND jp.drive_type = :sort AND jp.job_id > :next ORDER BY jp.job_id DESC LIMIT 10',array('companyid' => $data['company_id'] ,'next' => $data['next_value'] ,'sort' => $data['sort_value']));
			

			        return $jobs;

		}


		public static function Company_getclosedJobs_prevpage($data)
		{

					
				$jobs = \DB::select('SELECT DISTINCT jp.job_id,jp.status,jp.company_id,jp.drive_type,jp.title,jp.designation,jp.lastdate_to_apply,jp.created_on,jp.skills_applicable,jp.salary,jp.diploma_required_branch,jp.ug_required_degree,jp.ug_required_branch,jp.pg_required_degree,jp.pg_required_branch from `job_post` as jp
				    where company_id = :companyid AND jp.status = 2 AND jp.drive_type = :sort AND jp.job_id<:prev ORDER BY jp.job_id DESC LIMIT 10',array('companyid' => $data['company_id'],'prev' => $data['prev_value'],'sort' => $data['sort_value']));
			

			        return $jobs;

		}




}
?>