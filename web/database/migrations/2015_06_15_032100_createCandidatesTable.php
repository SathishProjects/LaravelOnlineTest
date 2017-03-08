<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration {

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
			$table->string('registration_type')->nullable();
                        $table->integer('institution_id')->nullable()/*->reference('id')->on('institution')*/;
                        $table->string('first_name')->nullable();
                        $table->string('middle_name')->nullable();
                        $table->string('last_name')->nullable();
                        $table->enum('gender', ['male','female'])->nullable();
                        $table->enum('marital_status', ['married','single'])->default('single');
                        $table->date('date_of_birth')->nullable();
                        $table->string('fathers_name')->nullable();
                        $table->string('mother_tongue')->nullable();
                        $table->string('language_known')->nullable();
                        $table->string('address1')->nullable();
                        $table->string('address2')->nullable();
                        $table->string('area')->nullable();
                        $table->string('city')->nullable();
                        $table->string('pincode', 6)->nullable();
                        $table->string('district')->nullable();
                        $table->string('state')->nullable();
                        $table->string('country')->nullable();
                        $table->string('email')->nullable();
                        $table->string('password')->nullable();
                        $table->string('alternate_email')->nullable();
                        $table->string('mobile', 10)->nullable();
                        $table->string('alternate_mobile', 10)->nullable();
                        $table->string('phone', 20)->nullable();
                        $table->string('alternate_phone', 20)->nullable();
                        $table->string('SSLC_course')->nullable();
                        $table->string('SSLC_institution')->nullable();
                        $table->string('SSLC_percentage')->nullable();
                        $table->string('SSLC_year_of_completion', 4)->nullable();
                        $table->string('HSC_course')->nullable();
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
                        $table->string('final_year_project_title')->nullable();
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
                        $table->string('profile_picture_upload_URL')->nullable();
                        $table->enum('status', ['active','inactive'])->default('inactive');
                        $table->datetime('created_on')->nullable();
                        $table->string('created_by')->nullable();
                        $table->datetime('modified_on')->nullable();
                        $table->string('modified_by')->nullable();
                        $table->datetime('deactive_on')->nullable();
                        $table->string('deactivate_by')->nullable();
                        $table->text('remarks')->nullable();
                        //$table->primary([/*'institution_id,*/ 'first_name', 'last_name']);
		});
                // Candidate Upload - ExcelImportProcedure
                $insertProcedureForExcelImport = "DROP PROCEDURE IF EXISTS `create_candidates_from_excel`; CREATE PROCEDURE `create_candidates_from_excel` (IN _first_name VARCHAR(255), IN _last_name VARCHAR(255), IN _email VARCHAR(255), IN _mobile VARCHAR(10), IN _gender ENUM('male', 'female'), IN _date_of_birth DATE, IN _SSLC_course VARCHAR(255), IN _SSLC_percentage VARCHAR(255), IN _SSLC_year_of_completion VARCHAR(4), IN _HSC_course VARCHAR(255), IN _HSC_percentage VARCHAR(255), IN _HSC_year_of_completion VARCHAR(4), IN _UG_percentage VARCHAR(255), IN _status ENUM('active', 'inactive'), IN _created_by VARCHAR(255), IN _modified_by VARCHAR(255), OUT insertCount INT(11)) BEGIN INSERT INTO candidates (first_name, last_name, email, mobile, gender, date_of_birth, SSLC_course, SSLC_percentage, SSLC_year_of_completion, HSC_course, HSC_percentage, HSC_year_of_completion, UG_percentage, status, created_on, created_by, modified_on, modified_by) VALUES (_first_name, _last_name, _email, _mobile, _gender, _date_of_birth, _SSLC_course, _SSLC_percentage, _SSLC_year_of_completion, _HSC_course, _HSC_percentage, _HSC_year_of_completion, _UG_percentage, _status, now(), _created_by, now(), _modified_by); SET insertCount = ROW_COUNT(); END";
                DB::unprepared($insertProcedureForExcelImport);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
                DB::unprepared("DROP PROCEDURE IF EXISTS `create_candidates_from_excel`");
		Schema::drop('candidates');
	}
}
