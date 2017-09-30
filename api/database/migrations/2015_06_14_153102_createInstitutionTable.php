<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institution', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('name')->unique();
                        $table->integer('institution_type')->default(0)/*->reference('id')->on('institution_type')*/;
                        $table->integer('university_id')->reference('id')->on('university');
                        $table->text('address1')->nullable();
                        $table->text('address2')->nullable();
                        $table->string('area')->nullable();
                        $table->string('city')->nullable();
                        $table->string('pincode', 6)->nullable();
                        $table->string('landmark')->nullable();
                        $table->string('district')->nullable();
                        $table->string('state')->nullable();
                        $table->string('country')->nullable();
                        $table->string('email');
                        $table->string('password')->nullable();
                        $table->string('alternate_email')->nullable();
                        $table->string('phone', 20)->nullable();
                        $table->string('alternate_phone', 20)->nullable();
                        $table->string('fax', 20)->nullable();
                        $table->string('college_official_contact_person_name')->nullable();
                        $table->string('college_official_contact_person_designation')->nullable();
                        $table->string('college_official_contact_person_mobile')->nullable();
                        $table->string('college_official_contact_person_email')->nullable();
                        $table->string('principal_name')->nullable();
                        $table->string('principal_phone', 20)->nullable();
                        $table->string('principal_email')->nullable();
                        $table->string('principal_mobile', 10)->nullable();
                        $table->string('principal_alternate_mobile', 10)->nullable();
                        $table->string('HOD_name')->nullable();
                        $table->string('HOD_phone', 20)->nullable();
                        $table->string('HOD_email')->nullable();
                        $table->string('HOD_mobile', 10)->nullable();
                        $table->string('HOD_alternate_mobile', 10)->nullable();
                        $table->string('PO_name')->nullable();
                        $table->string('PO_phone', 20)->nullable();
                        $table->string('PO_email')->nullable();
                        $table->string('PO_mobile', 10)->nullable();
                        $table->string('PO_alternate_mobile', 10)->nullable();
                        $table->string('management_name')->nullable();
                        $table->string('management_phone', 20)->nullable();
                        $table->string('management_email')->nullable();
                        $table->string('management_mobile', 10)->nullable();
                        $table->string('management_alternate_mobile', 10)->nullable();
                        $table->string('VIP_name')->nullable();
                        $table->string('VIP_phone', 20)->nullable();
                        $table->string('VIP_email')->nullable();
                        $table->string('VIP_mobile', 10)->nullable();
                        $table->string('VIP_alternate_mobile', 10)->nullable();
                        $table->integer('student_strength')->nullable();
                        $table->integer('staff_strength')->nullable();
                        $table->string('branch_of')->nullable();
                        $table->enum('status', ['active','inactive'])->default('inactive');
                        $table->dateTime('created_on')->nullable();
                        $table->string('created_by')->nullable();
                        $table->dateTime('modified_on')->nullable();
                        $table->string('modified_by')->nullable();
                        $table->dateTime('deactive_on')->nullable();
                        $table->string('deactivate_by')->nullable();
                        $table->string('remarks')->nullable();
		});
                // Insert Procedure                
                $insertProcedure = "DROP PROCEDURE IF EXISTS create_institution; CREATE PROCEDURE create_institution (IN _name VARCHAR(255), IN _institution_type INT(11), IN _university_id INT(11), IN _address1 TEXT, IN _address2 TEXT, IN _area VARCHAR(255), IN _city VARCHAR(255), IN _pincode VARCHAR(6), IN _landmark VARCHAR(255), IN _district VARCHAR(255), IN _state VARCHAR(255), IN _country VARCHAR(255), IN _email VARCHAR(255), IN _password VARCHAR(255), IN _alternate_email VARCHAR(255), IN _phone VARCHAR(20), IN _alternate_phone VARCHAR(20), IN _fax VARCHAR(20), IN _principal_name VARCHAR(255), IN _principal_phone VARCHAR(20), IN _principal_email VARCHAR(255), IN _principal_mobile VARCHAR(10), IN _principal_alternate_mobile VARCHAR(10), IN _HOD_name VARCHAR(255), IN _HOD_phone VARCHAR(20), IN _HOD_email VARCHAR(255), IN _HOD_mobile VARCHAR(10), IN _HOD_alternate_mobile VARCHAR(10), IN _PO_name VARCHAR(255), IN _PO_phone VARCHAR(20), IN _PO_email VARCHAR(255), IN _PO_mobile VARCHAR(10), IN _PO_alternate_mobile VARCHAR(10), IN _management_name VARCHAR(255), IN _management_phone VARCHAR(20), IN _management_email VARCHAR(255), IN _management_mobile VARCHAR(10), IN _management_alternate_mobile VARCHAR(10), IN _VIP_name VARCHAR(255), IN _VIP_phone VARCHAR(20), IN _VIP_email VARCHAR(255), IN _VIP_mobile VARCHAR(10), IN _VIP_alternate_mobile VARCHAR(10), IN _student_strength INT(11), IN _staff_strength INT(11), IN _branch_of VARCHAR(255), IN _status ENUM('active','inactive'), IN _created_on DATETIME, IN _created_by VARCHAR(255), IN _modified_on DATETIME, IN _modified_by VARCHAR(255), IN _deactive_on DATETIME, IN _deactivate_by VARCHAR(255), IN _remarks VARCHAR(255), OUT insertCount INT) BEGIN INSERT INTO institution (name, institution_type, university_id, address1, address2, area, city, pincode, landmark, district, `state`, country, email, password, alternate_email, phone, alternate_phone, fax, principal_name, principal_phone, principal_email, principal_mobile, principal_alternate_mobile, HOD_name, HOD_phone, HOD_email, HOD_mobile, HOD_alternate_mobile, PO_name, PO_phone, PO_email, PO_mobile, PO_alternate_mobile, management_name, management_phone, management_email, management_mobile, management_alternate_mobile, VIP_name, VIP_phone, VIP_email, VIP_mobile, VIP_alternate_mobile, student_strength, staff_strength, branch_of, status, created_on, created_by, modified_on, modified_by, remarks) VALUES (_name, _institution_type, _university_id, _address1, _address2, _area, _city, _pincode, _landmark, _district, _state, _country, _email, _password, _alternate_email, _phone, _alternate_phone,_fax, _principal_name, _principal_phone, _principal_email, _principal_mobile, _principal_alternate_mobile, _HOD_name, _HOD_phone, _HOD_email, _HOD_mobile, _HOD_alternate_mobile, _PO_name, _PO_phone, _PO_email, _PO_mobile, _PO_alternate_mobile, _management_name, _management_phone, _management_email, _management_mobile, _management_alternate_mobile, _VIP_name, _VIP_phone, _VIP_email, _VIP_mobile, _VIP_alternate_mobile, _student_strength, _staff_strength, _branch_of, _status, _created_on, _created_by, _modified_on, _modified_by, _remarks); SET insertCount = ROW_COUNT(); END";
                DB::unprepared($insertProcedure);

                // Insert Procedure Done by College Professions
                $limitedInsertProcedure = "DROP PROCEDURE IF EXISTS `create_institution_doneby_college`; CREATE PROCEDURE `create_institution_doneby_college`(IN _name VARCHAR(255), IN _university_id INT(11), IN _city VARCHAR(255), IN _pincode VARCHAR(6), IN _email VARCHAR(255), IN _phone VARCHAR(20), IN _college_official_contact_person_name VARCHAR(255), IN _college_official_contact_person_designation VARCHAR(255), IN _college_official_contact_person_email VARCHAR(255), IN _college_official_contact_person_mobile VARCHAR(10), IN _created_on DATETIME, IN _created_by VARCHAR(255), IN _modified_on DATETIME, IN _modified_by VARCHAR(255), OUT insertCount INT) BEGIN INSERT INTO institution (name, university_id, city, pincode, email, phone, college_official_contact_person_name, college_official_contact_person_designation, college_official_contact_person_email, college_official_contact_person_mobile, created_on, created_by, modified_on, modified_by) VALUES (_name, _university_id, _city, _pincode, _email, _phone, _college_official_contact_person_name, _college_official_contact_person_designation, _college_official_contact_person_email, _college_official_contact_person_mobile, now(), _college_official_contact_person_name, now(), _college_official_contact_person_name); SET insertCount = ROW_COUNT(); END";
                DB::unprepared($limitedInsertProcedure);
                
                // Update Procedure
                $updateProcedure = "DROP PROCEDURE IF EXISTS update_institution; CREATE PROCEDURE update_institution (IN _id INT, IN _name VARCHAR(255), IN _institution_type INT(11), IN _university_id INT(11), IN _address1 TEXT, IN _address2 TEXT, IN _area VARCHAR(255), IN _city VARCHAR(255), IN _pincode VARCHAR(6), IN _landmark VARCHAR(255), IN _district VARCHAR(255), IN _state VARCHAR(255), IN _country VARCHAR(255), IN _email VARCHAR(255), IN _password VARCHAR(255), IN _alternate_email VARCHAR(255), IN _phone VARCHAR(20), IN _alternate_phone VARCHAR(20), IN _fax VARCHAR(20), IN _principal_name VARCHAR(255), IN _principal_phone VARCHAR(20), IN _principal_email VARCHAR(255), IN _principal_mobile VARCHAR(10), IN _principal_alternate_mobile VARCHAR(10), IN _HOD_name VARCHAR(255), IN _HOD_phone VARCHAR(20), IN _HOD_email VARCHAR(255), IN _HOD_mobile VARCHAR(10), IN _HOD_alternate_mobile VARCHAR(10), IN _PO_name VARCHAR(255), IN _PO_phone VARCHAR(20), IN _PO_email VARCHAR(255), IN _PO_mobile VARCHAR(10), IN _PO_alternate_mobile VARCHAR(10), IN _management_name VARCHAR(255), IN _management_phone VARCHAR(20), IN _management_email VARCHAR(255), IN _management_mobile VARCHAR(10), IN _management_alternate_mobile VARCHAR(10), IN _VIP_name VARCHAR(255), IN _VIP_phone VARCHAR(20), IN _VIP_email VARCHAR(255), IN _VIP_mobile VARCHAR(10), IN _VIP_alternate_mobile VARCHAR(10), IN _student_strength INT(11), IN _staff_strength INT(11), IN _branch_of VARCHAR(255), IN _status ENUM('active','inactive'), IN _created_on DATETIME, IN _created_by VARCHAR(255), IN _modified_on DATETIME, IN _modified_by VARCHAR(255), IN _deactive_on DATETIME, IN _deactivate_by VARCHAR(255), IN _remarks VARCHAR(255)) BEGIN UPDATE institution SET name = _name, institution_type = _institution_type, university_id = _university_id, address1 = _address1, address2 = _address2, area = _area, city = _city, pincode = _pincode, landmark = _landmark, district = _district, `state` = _state, country = _country, email = _email, password = _password, alternate_email = _alternate_email, phone = _phone, alternate_phone = _alternate_phone, fax = _fax, principal_name = _principal_name, principal_phone = _principal_phone, principal_email = _principal_email, principal_mobile = _principal_mobile, principal_alternate_mobile = _principal_alternate_mobile, HOD_name = _HOD_name, HOD_phone = _HOD_phone, HOD_email = _HOD_email, HOD_mobile = _HOD_mobile, HOD_alternate_mobile = _HOD_alternate_mobile, PO_name = _PO_name, PO_phone = _PO_phone, PO_email = _PO_email, PO_mobile = _PO_mobile, PO_alternate_mobile = _PO_alternate_mobile, management_name = _management_name, management_phone = _management_phone, management_email = _management_email, management_mobile = _management_mobile, management_alternate_mobile = _management_alternate_mobile, VIP_name = _VIP_name, VIP_phone = _VIP_phone, VIP_email = _VIP_email, VIP_mobile = _VIP_mobile, VIP_alternate_mobile = _VIP_alternate_mobile, student_strength = _student_strength, staff_strength = _staff_strength, branch_of = _branch_of, status = _status, created_on = _created_on, created_by = _created_by, modified_on = _modified_on, modified_by = _modified_by, deactive_on = _deactive_on, deactivate_by = _deactivate_by, remarks = _remarks WHERE id = _id; END";
                DB::unprepared($updateProcedure);

                //Delete Procedure
                $deleteProcedure = "DROP PROCEDURE IF EXISTS delete_institution; CREATE PROCEDURE delete_institution (IN _id INT, IN _modified_on DATETIME, IN _modified_by VARCHAR(255), IN _deactive_on DATETIME, IN _deactivate_by VARCHAR(255)) BEGIN UPDATE institution SET status = 'inactive', modified_on = _modified_on, modified_by = _modified_by, deactive_on = _deactive_on, deactivate_by = _deactivate_by  WHERE id = _id; END";
                DB::unprepared($deleteProcedure);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
                DB::unprepared("DROP PROCEDURE IF EXISTS create_institution");
                DB::unprepared("DROP PROCEDURE IF EXISTS create_institution_doneby_college");
                DB::unprepared("DROP PROCEDURE IF EXISTS update_institution");
                DB::unprepared("DROP PROCEDURE IF EXISTS delete_institution");
		Schema::drop('institution');
	}

}
