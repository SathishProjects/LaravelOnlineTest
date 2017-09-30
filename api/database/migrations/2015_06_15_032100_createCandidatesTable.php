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
                // API Insert Procedure
                $insertProcedureAPI = "DROP PROCEDURE IF EXISTS create_candidates; CREATE PROCEDURE create_candidates (IN _registration_type VARCHAR(255), IN _institution_id INT(11), IN _first_name VARCHAR(255), IN _middle_name VARCHAR(255), IN _last_name VARCHAR(255), IN _gender ENUM('male', 'female'), IN _marital_status ENUM('married','single'), IN _date_of_birth DATE, IN _fathers_name VARCHAR(255), IN _mother_tongue VARCHAR(255), IN _language_known VARCHAR(255), IN _address1 VARCHAR(255), IN _address2 VARCHAR(255), IN _area VARCHAR(255), IN _city VARCHAR(255), IN _pincode VARCHAR(6), IN _district VARCHAR(255), IN _state VARCHAR(255), IN _country VARCHAR(255), IN _email VARCHAR(255), IN _password VARCHAR(255), IN _alternate_email VARCHAR(255), IN _mobile VARCHAR(10), IN _alternate_mobile VARCHAR(10), IN _phone VARCHAR(20), IN _alternate_phone VARCHAR(20), IN _SSLC_course VARCHAR(255), IN _SSLC_institution VARCHAR(255), IN _SSLC_percentage VARCHAR(255), IN _SSLC_year_of_completion VARCHAR(4), IN _HSC_course VARCHAR(255), IN _HSC_institution VARCHAR(255), IN _HSC_percentage VARCHAR(255), IN _HSC_year_of_completion VARCHAR(4), IN _diploma_course VARCHAR(255), IN _diploma_institution VARCHAR(255), IN _diploma_percentage VARCHAR(255), IN _diploma_year_of_completion VARCHAR(4), IN _UG_course VARCHAR(255), IN _UG_institution VARCHAR(255), IN _UG_percentage VARCHAR(255), IN _UG_year_of_completion VARCHAR(4), IN _PG_course VARCHAR(255), IN _PG_institution VARCHAR(255), IN _PG_percentage VARCHAR(255), IN _year_of_completion VARCHAR(4), IN _final_year_project_title VARCHAR(255), IN _final_year_project_summary VARCHAR(255), IN _experience1_organisation VARCHAR(255), IN _experience1_designation VARCHAR(255), IN _experience1_duration_in_years VARCHAR(3), IN _experience1_responsibility VARCHAR(255), IN _experience1_salary_drawn VARCHAR(255), IN _experience2_organisation VARCHAR(255), IN _experience2_designation VARCHAR(255), IN _experience2_duration_in_years VARCHAR(3), IN _experience2_responsibility VARCHAR(255), IN _experience2_salary_drawn VARCHAR(255), IN _experience3_organisation VARCHAR(255), IN _experience3_designation VARCHAR(255), IN _experience3_duration_in_years VARCHAR(3), IN _experience3_responsibility VARCHAR(255), IN _experience3_salary_drawn VARCHAR(255), IN _career_interests VARCHAR(255), IN _skills VARCHAR(255), IN _technical_proficiency VARCHAR(255), IN _typewriting_proficiency VARCHAR(255), IN _extra_curricular_activities1 VARCHAR(255), IN _extra_curricular_activities2 VARCHAR(255), IN _extra_curricular_activities3 VARCHAR(255), IN _extra_qualification1 VARCHAR(255), IN _extra_qualification2 VARCHAR(255), IN _extra_qualification3 VARCHAR(255), IN _awards_and_recognition1 VARCHAR(255), IN _awards_and_recognition2 VARCHAR(255), IN _awards_and_recognition3 VARCHAR(255), IN _resume_web_URL VARCHAR(255), IN _resume_upload_URL VARCHAR(255), IN _linkedin_profile_URL VARCHAR(255), IN _profile_picture_upload_URL VARCHAR(255), IN _created_on DATETIME, IN _created_by VARCHAR(255), IN _modified_on DATETIME, IN _modified_by VARCHAR(255), IN _remarks TEXT) BEGIN INSERT INTO candidates (registration_type, institution_id, first_name, middle_name, last_name, gender, marital_status, date_of_birth, fathers_name, mother_tongue, language_known, address1, address2, area, city, pincode, district, state, country, email, password, alternate_email, mobile, alternate_mobile, phone, alternate_phone, SSLC_course, SSLC_institution, SSLC_percentage, SSLC_year_of_completion, HSC_course, HSC_institution, HSC_percentage, HSC_year_of_completion, diploma_course, diploma_institution, diploma_percentage, diploma_year_of_completion, UG_course, UG_institution, UG_percentage, UG_year_of_completion, PG_course, PG_institution, PG_percentage, year_of_completion, final_year_project_title, final_year_project_summary, experience1_organisation, experience1_designation, experience1_duration_in_years, experience1_responsibility, experience1_salary_drawn, experience2_organisation, experience2_designation, experience2_duration_in_years, experience2_responsibility, experience2_salary_drawn, experience3_organisation, experience3_designation, experience3_duration_in_years, experience3_responsibility, experience3_salary_drawn, career_interests, skills, technical_proficiency, typewriting_proficiency, extra_curricular_activities1, extra_curricular_activities2, extra_curricular_activities3, extra_qualification1, extra_qualification2, extra_qualification3, awards_and_recognition1, awards_and_recognition2, awards_and_recognition3, resume_web_URL, resume_upload_URL, linkedin_profile_URL, profile_picture_upload_URL, created_on, created_by, modified_on, modified_by, remarks) VALUES (_registration_type, _institution_id, _first_name, _middle_name, _last_name, _gender, _marital_status, _date_of_birth, _fathers_name, _mother_tongue, _language_known, _address1, _address2, _area, _city, _pincode, district, _state, _country, _email, _password, _alternate_email, _mobile, _alternate_mobile, _phone, _alternate_phone, _SSLC_course, _SSLC_institution, _SSLC_percentage, _SSLC_year_of_completion, _HSC_course, _HSC_institution, _HSC_percentage, _HSC_year_of_completion, _diploma_course, _diploma_institution, _diploma_percentage, _diploma_year_of_completion, _UG_course, _UG_institution, _UG_percentage, _UG_year_of_completion, _PG_course, _PG_institution, _PG_percentage, _year_of_completion, _final_year_project_title, _final_year_project_summary, _experience1_organisation, _experience1_designation, _experience1_duration_in_years, _experience1_responsibility, _experience1_salary_drawn, _experience2_organisation, _experience2_designation, _experience2_duration_in_years, _experience2_responsibility, _experience2_salary_drawn, _experience3_organisation, _experience3_designation, _experience3_duration_in_years, _experience3_responsibility, _experience3_salary_drawn, _career_interests, _skills, _technical_proficiency, _typewriting_proficiency, _extra_curricular_activities1, _extra_curricular_activities2, _extra_curricular_activities3, _extra_qualification1, _extra_qualification2, _extra_qualification3, _awards_and_recognition1, _awards_and_recognition2, _awards_and_recognition3, _resume_web_URL, _resume_upload_URL, _linkedin_profile_URL, _profile_picture_upload_URL, _created_on, _created_by, _modified_on, _modified_by, _remarks); END";
                DB::unprepared($insertProcedureAPI);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            DB::unprepared("DROP PROCEDURE IF EXISTS `create_candidates`");
            DB::unprepared("DROP PROCEDURE IF EXISTS `create_candidates_from_excel`");
            Schema::drop('candidates');
	}
}
