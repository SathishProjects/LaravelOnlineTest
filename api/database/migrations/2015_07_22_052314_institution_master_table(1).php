<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstitutionMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
Schema::create('institution_master', function(Blueprint $table)
		{
$table->increments('id');	
$table->string('name')->nullable();
$table->string('institution_type_id',25)->nullable()->reference('id')->on('institution_type');
$table->integer('university_id',11)->nullable()->reference('id')->on('university_master');
$table->string('address1')->nullable();
$table->string('address2')->nullable();
$table->string('area',32)->nullable();
$table->integer('city',4)->nullable();
$table->integer('pincode',6)->nullable();
$table->string('landmark',100)->nullable();
$table->integer('district',3)->nullable();
$table->integer('state',4)->nullable();
$table->integer('country',4)->nullable();
$table->string('email',100)->nullable();
$table->string('password',64)->nullable();
$table->string('alternate_email',100)->nullable();
$table->string('phone',15)->nullable();
$table->string('alternate_phone',15)->nullable();
$table->string('fax',15)->nullable();
$table->string('management_name',150)->nullable();
$table->string('management_phone',15)->nullable();
$table->string('management_email',100)->nullable();
$table->string('management_mobile1',15)->nullable();
$table->string('management_mobile2',15)->nullable();
$table->string('head_name',150)->nullable();
$table->string('head_phone',15)->nullable();
$table->string('head_email',100)->nullable();
$table->string('head_mobile1',15)->nullable();
$table->string('head_mobile2',15)->nullable();
$table->string('dean_name',150)->nullable();
$table->string('dean_phone',15)->nullable();
$table->string('dean_email',100)->nullable();
$table->string('dean_mobile1',15)->nullable();
$table->string('dean_mobile2',15)->nullable();
$table->string('principal_name',150)->nullable();
$table->string('principal_phone',15)->nullable();
$table->string('principal_email',100)->nullable();
$table->string('principal_mobile1',15)->nullable();
$table->string('principal_mobile2',15)->nullable();
$table->string('HOD_name',150)->nullable();
$table->string('HOD_phone',15)->nullable();
$table->string('HOD_email',100)->nullable();
$table->string('HOD_mobile1',15)->nullable();
$table->string('HOD_mobile2',15)->nullable();
$table->string('PO1_name',150)->nullable();
$table->string('PO1_phone',15)->nullable();
$table->string('PO1_email',100)->nullable();
$table->string('PO1_mobile1',15)->nullable();
$table->string('PO1_mobile2',15)->nullable();
$table->string('PO2_name',150)->nullable();
$table->string('PO2_phone',15)->nullable();
$table->string('PO2_email',100)->nullable();
$table->string('PO2_mobile1',15)->nullable();
$table->string('PO2_mobile2',15)->nullable();
$table->string('PO3_name',150)->nullable();
$table->string('PO3_phone',15)->nullable();
$table->string('PO3_email',100)->nullable();
$table->string('PO3_mobile1',15)->nullable();
$table->string('PO3_mobile2',15)->nullable();
$table->integer('student_strength',5)->nullable();
$table->integer('staff_strength',5)->nullable();
$table->string('branch_of')->nullable();
$table->tinyInteger('status',1)->nullable();
$table->timestamp('created_on')->nullable();
$table->integer('created_by',11)->nullable();
$table->timestamp('modified_on')->nullable();
 $table->integer('modified_by',11)->nullable();
 $table->timestamp('deactive_on')->nullable();
$table->integer('deactivate_by',11)->nullable();
$table->string('remarks')->nullable();
  });

"DROP PROCEDURE IF EXISTS `create_institution_master`;
CREATE PROCEDURE `create_institution_master`
(IN _name VARCHAR(255),IN _institution_type_id VARCHAR(25),
IN _university_id INT(11),IN _address1 VARCHAR(255),
IN _address2 VARCHAR(255),IN _area VARCHAR(32),
IN _city INT(4),IN _pincode INT(6),IN _landmark VARCHAR(100),
IN _district INT(3),IN _state INT(4),IN _country INT(4),
IN _email VARCHAR(100),IN _password VARCHAR(64),IN _alternate_email VARCHAR(100),
IN _phone VARCHAR(64),IN _alternate_phone VARCHAR(64),IN _fax VARCHAR(15),IN _management_name VARCHAR(150),IN _management_phone VARCHAR(15),
IN _management_email VARCHAR(100),IN _management_mobile1 VARCHAR(15),
IN _management_mobile2 VARCHAR(15),
IN _head_name VARCHAR(150),IN _head_phone VARCHAR(15),
IN _head_email VARCHAR(100),IN _head_mobile1 VARCHAR(15),
IN _head_mobile2 VARCHAR(15),
IN _dean_name VARCHAR(150),IN _dean_phone VARCHAR(15),
IN _dean_email VARCHAR(100),IN _dean_mobile1 VARCHAR(15),
IN _dean_mobile2 VARCHAR(15),
IN _principal_name VARCHAR(150),IN _principal_phone VARCHAR(15),
IN _principal_email VARCHAR(100),IN _principal_mobile1 VARCHAR(15),
IN _principal_mobile2 VARCHAR(15),
IN _HOD_name VARCHAR(150),IN _HOD_phone VARCHAR(15),
IN _HOD_email VARCHAR(100),IN _HOD_mobile1 VARCHAR(15),
IN _HOD_mobile2 VARCHAR(15),
IN _PO1_name VARCHAR(150),IN _PO1_phone VARCHAR(15),
IN _PO1_email VARCHAR(100),IN _PO1_mobile1 VARCHAR(15),
IN _PO1_mobile2 VARCHAR(15),
IN _PO2_name VARCHAR(150),IN _PO2_phone VARCHAR(15),
IN _PO2_email VARCHAR(100),IN _PO2_mobile1 VARCHAR(15),
IN _PO2_mobile2 VARCHAR(15),
IN _PO3_name VARCHAR(150),IN _PO3_phone VARCHAR(15),
IN _PO3_email VARCHAR(100),IN _PO3_mobile1 VARCHAR(15),
IN _PO3_mobile2 VARCHAR(15),
IN _student_strength INT(5),IN _staff_strength INT(5),
IN _branch_of VARCHAR(255),IN _status TINYINT(1),
IN _created_on TIMESTAMP,IN _created_by INT(11),
IN _modified_on TIMESTAMP, 
IN _modified_by INT(11),
IN _deactive_on TIMESTAMP,
IN _deactivate_by INT(11),
 OUT insertCount INT(11))  
BEGIN INSERT INTO institution_master
(name,institution_type_id,university_id,address1,address2,area,city,pincode,landmark,district,state,country,email,password,alternate_email,
phone,alternate_phone,fax,management_name,management_phone,management_email,management_mobile1,management_mobile2,head_name,head_phone,head_email,head_mobile1,head_mobile2,dean_name,dean_phone,dean_email,dean_mobile1,dean_mobile2,principal_name,principal_phone,principal_email,principal_mobile1,principal_mobile2,HOD_name,HOD_phone,HOD_email,HOD_mobile1,
HOD_mobile2,PO1_name,PO1_phone,PO1_email,PO1_mobile1,
PO1_mobile2,PO2_name,PO2_phone,PO2_email,PO2_mobile1,
PO2_mobile2,PO3_name,PO3_phone,PO3_email,PO3_mobile1,
PO3_mobile2,student_strength,staff_strength,branch_of,status,
created_on,created_by,modified_on,modified_by,deactive_on,deactivate_by,remarks)
values(_name,_institution_type_id,_university_id,_address1,_address2,_area,_city,_pincode,_landmark,_district,_state,_country,_email,_password,_alternate_email,
_phone,_alternate_phone,_fax,_management_name,_management_phone,_management_email,_management_mobile1,_management_mobile2,_head_name,_head_phone,_head_email,_head_mobile1,_head_mobile2,_dean_name,_dean_phone,_dean_email,_dean_mobile1,_dean_mobile2,_principal_name,_principal_phone,_principal_email,_principal_mobile1,_principal_mobile2,_HOD_name,_HOD_phone,_HOD_email,_HOD_mobile1,
_HOD_mobile2,_PO1_name,_PO1_phone,_PO1_email,_PO1_mobile1,
_PO1_mobile2,_PO2_name,_PO2_phone,_PO2_email,_PO2_mobile1,
_PO2_mobile2,_PO3_name,_PO3_phone,_PO3_email,_PO3_mobile1,
_PO3_mobile2,_student_strength,_staff_strength,_branch_of,_status,
_created_on,_created_by,_remarks);
SET insertCount=ROW_COUNT();END";



//Update Procedure
"DROP PROCEDURE IF EXISTS update_institution_master;
CREATE PROCEDURE update_institution_master
(IN _name VARCHAR(255),IN _institution_type_id VARCHAR(25),
IN _university_id INT(11),IN _address1 VARCHAR(255),
IN _address2 VARCHAR(255),IN _area VARCHAR(32),
IN _city INT(4),IN _pincode INT(6),IN _landmark VARCHAR(100),
IN _district INT(3),IN _state INT(4),IN _country INT(4),
IN _email VARCHAR(100),IN _password VARCHAR(64),IN _alternate_email VARCHAR(100),
IN _phone VARCHAR(64),IN _alternate_phone VARCHAR(64),IN _fax VARCHAR(15),IN _management_name VARCHAR(150),IN _management_phone VARCHAR(15),
IN _management_email VARCHAR(100),IN _management_mobile1 VARCHAR(15),
IN _management_mobile2 VARCHAR(15),
IN _head_name VARCHAR(150),IN _head_phone VARCHAR(15),
IN _head_email VARCHAR(100),IN _head_mobile1 VARCHAR(15),
IN _head_mobile2 VARCHAR(15),
IN _dean_name VARCHAR(150),IN _dean_phone VARCHAR(15),
IN _dean_email VARCHAR(100),IN _dean_mobile1 VARCHAR(15),
IN _dean_mobile2 VARCHAR(15),
IN _principal_name VARCHAR(150),IN _principal_phone VARCHAR(15),
IN _principal_email VARCHAR(100),IN _principal_mobile1 VARCHAR(15),
IN _principal_mobile2 VARCHAR(15),
IN _HOD_name VARCHAR(150),IN _HOD_phone VARCHAR(15),
IN _HOD_email VARCHAR(100),IN _HOD_mobile1 VARCHAR(15),
IN _HOD_mobile2 VARCHAR(15),
IN _PO1_name VARCHAR(150),IN _PO1_phone VARCHAR(15),
IN _PO1_email VARCHAR(100),IN _PO1_mobile1 VARCHAR(15),
IN _PO1_mobile2 VARCHAR(15),
IN _PO2_name VARCHAR(150),IN _PO2_phone VARCHAR(15),
IN _PO2_email VARCHAR(100),IN _PO2_mobile1 VARCHAR(15),
IN _PO2_mobile2 VARCHAR(15),
IN _PO3_name VARCHAR(150),IN _PO3_phone VARCHAR(15),
IN _PO3_email VARCHAR(100),IN _PO3_mobile1 VARCHAR(15),
IN _PO3_mobile2 VARCHAR(15),
IN _student_strength INT(5),IN _staff_strength INT(5),
IN _branch_of VARCHAR(255),IN _status TINYINT(1),
IN _created_on TIMESTAMP,IN _created_by INT(11),
IN _modified_on TIMESTAMP, 
IN _modified_by INT(11),
IN _deactive_on TIMESTAMP,
IN _deactivate_by INT(11))
BEGIN UPDATE institution_master SET 
name=_name,institution_type_id=_institution_type_id,university_id=_university_id,address1=_address1,address2=_address2,area=_area,city=_city,
pincode=_pincode,landmark=_landmark,district=_district,state=_state,
country=_country,email=_email,password=_password,alternate_email=_alternate_email,phone=_phone,alternate_phone=_alternate_phone,fax=_fax,
management_name=_management_name,management_phone=_management_phone,
management_email=_management_email,management_mobile1=_management_mobile1,management_mobile2=_management_mobile2,head_name=_head_name,
head_phone=_head_phone,head_email=_head_email,head_mobile1=_head_mobile1,head_mobile2=_head_mobile2,
dean_name=_dean_name,
dean_phone=_dean_phone,dean_email=_dean_email,dean_mobile1=_dean_mobile1,dean_mobile2=_dean_mobile2,
principal_name=_principal_name,
principal_phone=_principal_phone,principal_email=_principal_email,principal_mobile1=_principal_mobile1,principal_mobile2=_principal_mobile2,
HOD_name=_HOD_name,
HOD_phone=_HOD_phone,HOD_email=_HOD_email,HOD_mobile1=_HOD_mobile1,HOD_mobile2=_HOD_mobile2,
PO1_name=_PO1_name,
PO1_phone=_PO1_phone,PO1_email=_PO1_email,PO1_mobile1=_PO1_mobile1,PO1_mobile2=_PO1_mobile2,
PO2_name=_PO2_name,
PO2_phone=_PO2_phone,PO2_email=_PO2_email,PO2_mobile1=_PO2_mobile1,PO2_mobile2=_PO2_mobile2,
PO3_name=_PO3_name,
PO3_phone=_PO3_phone,PO3_email=_PO3_email,PO3_mobile1=_PO3_mobile1,PO3_mobile2=_PO3_mobile2,
student_strength=_student_strength,staff_strength=_staff_strength,
branch_of=_branch_of,status=_status,created_on=_created_on,created_by=_created_by,
modified_on=_modified_on,modified_by=_modified_by,
deactive_on=_deactive_on,
deactivate_by=_deactivate_by,remarks=_remarks WHERE id=_id;END";


//Delete Procedure
      "DROP PROCEDURE IF EXISTS delete_institution_master;
 CREATE PROCEDURE delete_institution_master (IN _id INT(11), IN _modified_on TIMESTAMP, IN _modified_by INT(11), IN _deactive_on TIMESTAMP, IN _deactivate_by INT(11)) 
BEGIN UPDATE institution_master SET status = 'inactive', modified_on = _modified_on, modified_by = _modified_by, deactive_on = _deactive_on, deactivate_by = _deactivate_by  WHERE id = _id; END";
           
}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared("DROP PROCEDURE IF EXISTS create_institution_master");
               DB::unprepared("DROP PROCEDURE IF EXISTS delete_institution_master");
               DB::unprepared("DROP PROCEDURE IF EXISTS update_institution_master");
		Schema::drop('institution_master');	
	}

}
