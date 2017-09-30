<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('candidates', function(Blueprint $table)
		{
			$table->increments('id');
			// $table->string('registration_type')->nullable();
			// $table->integer('institution_id')->nullable()/*->reference('id')->on('institution')*/;
			$table->string('first_name')->nullable();
			$table->string('middle_name')->nullable();
			$table->string('last_name')->nullable();
			$table->enum('gender', ['male','female'])->nullable();
			// $table->enum('marital_status', ['married','single'])->default('single');
			$table->date('date_of_birth')->nullable();
			/* $table->string('fathers_name')->nullable();
			$table->string('mother_tongue')->nullable();
			$table->string('language_known')->nullable(); */
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('area')->nullable();
			$table->string('city')->nullable();
			// $table->string('pincode', 6)->nullable();
			$table->string('district')->nullable();
			$table->string('state')->nullable();
			$table->string('country')->nullable();
			$table->string('email')->nullable();
			/* $table->string('password')->nullable();
			$table->string('alternate_email')->nullable(); */
			$table->string('mobile', 10)->nullable();
			/* $table->string('alternate_mobile', 10)->nullable();
			$table->string('phone', 20)->nullable();
			$table->string('alternate_phone', 20)->nullable(); */
			// $table->string('SSLC_course')->nullable();
			$table->string('SSLC_institution')->nullable();
			$table->string('SSLC_percentage')->nullable();
			$table->string('SSLC_year_of_completion', 4)->nullable();
			// $table->string('HSC_course')->nullable();
			$table->string('HSC_institution')->nullable();
			$table->string('HSC_percentage')->nullable();
			$table->string('HSC_year_of_completion', 4)->nullable();
			$table->string('diploma_course')->nullable();
			$table->string('diploma_institution')->nullable();
			$table->string('diploma_percentage')->nullable();
			$table->string('diploma_year_of_completion', 4)->nullable();
			$table->string('UG_course')->nullable();
			$table->string('UG_institution')->nullable();
			$table->string('UG_percentage')->nullable();
			$table->string('UG_year_of_completion', 4)->nullable();
			$table->string('PG_course')->nullable();
			$table->string('PG_institution')->nullable();
			$table->string('PG_percentage')->nullable();
			$table->string('year_of_completion', 4)->nullable();
			/* $table->string('final_year_project_title')->nullable();
			$table->string('final_year_project_summary')->nullable();
			$table->string('experience1_organisation')->nullable();
			$table->string('experience1_designation')->nullable();
			$table->string('experience1_duration_in_years', 3)->default(0);
			$table->string('experience1_responsibility')->nullable();
			$table->string('experience1_salary_drawn')->nullable();
			$table->string('experience2_organisation')->nullable();
			$table->string('experience2_designation')->nullable();
			$table->string('experience2_duration_in_years', 3)->nullable();
			$table->string('experience2_responsibility')->nullable();
			$table->string('experience2_salary_drawn')->nullable();
			$table->string('experience3_organisation')->nullable();
			$table->string('experience3_designation')->nullable();
			$table->string('experience3_duration_in_years', 3)->nullable();
			$table->string('experience3_responsibility')->nullable();
			$table->string('experience3_salary_drawn')->nullable();
			$table->string('career_interests')->nullable();
			$table->string('skills')->nullable();
			$table->string('technical_proficiency')->nullable();
			$table->string('typewriting_proficiency')->nullable();
			$table->string('extra_curricular_activities1')->nullable();
			$table->string('extra_curricular_activities2')->nullable();
			$table->string('extra_curricular_activities3')->nullable();
			$table->string('extra_qualification1')->nullable();
			$table->string('extra_qualification2')->nullable();
			$table->string('extra_qualification3')->nullable();
			$table->string('awards_and_recognition1')->nullable();
			$table->string('awards_and_recognition2')->nullable();
			$table->string('awards_and_recognition3')->nullable();
			$table->string('resume_web_URL')->nullable();
			$table->string('resume_upload_URL')->nullable();
			$table->string('linkedin_profile_URL')->nullable();
			$table->string('profile_picture_upload_URL')->nullable(); */
			$table->enum('status', ['active','inactive'])->default('inactive');
			$table->datetime('created_on')->nullable();
			$table->string('created_by')->nullable();
			$table->datetime('modified_on')->nullable();
			$table->string('modified_by')->nullable();
			$table->datetime('deactive_on')->nullable();
			$table->string('deactivate_by')->nullable();
			$table->text('remarks')->nullable();
		});
		$insertProcedureForExcelImport = "DROP PROCEDURE IF EXISTS `create_candidates_from_form`; 
			CREATE PROCEDURE `create_candidates_from_form` 
			(IN _first_name VARCHAR(255), IN _middle_name VARCHAR(255), IN _last_name VARCHAR(255), IN _gender ENUM('male', 'female'), IN _date_of_birth DATE, 
			IN _address1 VARCHAR(255), IN _address2 VARCHAR(255), IN _area VARCHAR(255), IN _city VARCHAR(255), IN _district VARCHAR(255), IN _state VARCHAR(255), 
			IN _country VARCHAR(255), IN _email VARCHAR(255), IN _mobile VARCHAR(10), 
			IN _SSLC_institution VARCHAR(255), IN _SSLC_year_of_completion VARCHAR(4), IN _SSLC_percentage VARCHAR(255), 
			IN _HSC_institution VARCHAR(255), IN _HSC_year_of_completion VARCHAR(4), IN _HSC_percentage VARCHAR(255), 
			IN _diploma_institution VARCHAR(255), IN _diploma_course VARCHAR(255), IN _diploma_project VARCHAR(255), 
			IN _diploma_year_of_completion VARCHAR(4), IN _diploma_percentage VARCHAR(255), IN _diploma_summary VARCHAR(255), 
			IN _UG_institution VARCHAR(255), IN _UG_course VARCHAR(255), IN _UG_year_of_completion VARCHAR(4), 
			IN _UG_project VARCHAR(255), IN _UG_percentage VARCHAR(255), IN _UG_summary VARCHAR(255), 
			IN _PG_institution VARCHAR(255), IN _PG_course VARCHAR(255), IN _PG_year_of_completion VARCHAR(4), 
			IN _PG_project VARCHAR(255), IN _PG_percentage VARCHAR(255), IN _PG_summary VARCHAR(255), 
			IN _status ENUM('active', 'inactive'), IN _created_on DATETIME, IN _created_by VARCHAR(255), 
			IN _modified_on DATETIME, IN _modified_by VARCHAR(255), OUT insertCount INT(11)) 
			BEGIN 
			INSERT INTO candidates 
			(first_name, middle_name, last_name, gender, date_of_birth, 
			address1, address2, area, city, district, state, 
			country, email, mobile, 
			SSLC_institution, SSLC_year_of_completion, SSLC_percentage, 
			HSC_institution, HSC_year_of_completion, HSC_percentage, 
			diploma_institution, diploma_course, diploma_project, 
			diploma_year_of_completion, diploma_percentage, diploma_summary, 
			UG_institution, UG_course, UG_year_of_completion, UG_project, UG_percentage, UG_summary, 
			PG_institution, PG_course, PG_year_of_completion, PG_project, PG_percentage, PG_summary, 
			status, created_on, created_by, modified_on, modified_by) 
			VALUES (_first_name, _middle_name, _last_name, _gender, _date_of_birth, 
			_address1, _address2, _area, _city, _district, _state, _country, _email, _mobile, 
			_SSLC_institution, _SSLC_year_of_completion, _SSLC_percentage, 
			_HSC_institution, _HSC_year_of_completion, _HSC_percentage, 
			_diploma_institution, _diploma_course, _diploma_project, _diploma_year_of_completion, 
			_diploma_percentage, _diploma_summary, 
			_UG_institution, _UG_course, _UG_year_of_completion, _UG_project, _UG_percentage, _UG_summary, 
			_PG_institution, _PG_course, _PG_year_of_completion, _PG_project, _PG_percentage, _PG_summary, 
			_status, now(), _created_by, now(), _modified_by); SET insertCount = ROW_COUNT(); END";
		DB::unprepared($insertProcedureForExcelImport);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared("DROP PROCEDURE IF EXISTS `create_candidates_from_form`");
		Schema::drop('candidates');
	}

}
