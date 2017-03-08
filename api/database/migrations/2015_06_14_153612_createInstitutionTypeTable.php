<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institution_type', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
                        $table->enum('status', ['active','inactive'])->default('inactive');
                        $table->dateTime('created_on')->nullable();
                        $table->string('created_by')->nullable();
                        $table->dateTime('modified_on')->nullable();
                        $table->string('modified_by')->nullable();
                        $table->dateTime('deactive_on')->nullable();
                        $table->string('deactivate_by')->nullable();
                        $table->text('remarks')->nullable();
		});
                // Insert Procedure                
                $insertProcedure = "DROP PROCEDURE IF EXISTS create_institution_type; CREATE PROCEDURE create_institution_type (IN _name VARCHAR(255), IN _status ENUM('active','inactive'), IN _created_on DATETIME, IN _created_by VARCHAR(255), IN _modified_on DATETIME, IN _modified_by VARCHAR(255), IN _deactive_on DATETIME, IN _deactivate_by VARCHAR(255), IN _remarks VARCHAR(255), OUT insertCount INT) BEGIN INSERT INTO institution_type (name, status, created_on, created_by, modified_on, modified_by, deactive_on, deactivate_by, remarks) VALUES (_name, _status, _created_on,_created_by, _modified_on, _modified_by, _deactive_on,_deactivate_by, _remarks); SET insertCount = ROW_COUNT(); END";
                DB::unprepared($insertProcedure);

                // Update Procedure
                $updateProcedure = "DROP PROCEDURE IF EXISTS update_institution_type; CREATE PROCEDURE update_institution_type (IN _id INT, IN _name VARCHAR(255), IN _status ENUM('active','inactive'), IN _created_on DATETIME, IN _created_by VARCHAR(255), IN _modified_on DATETIME, IN _modified_by VARCHAR(255), IN _deactive_on DATETIME, IN _deactivate_by VARCHAR(255), IN _remarks VARCHAR(255)) BEGIN UPDATE institution_type SET name = _name, status = _status, created_on = _created_on, created_by = _created_by, modified_on = _modified_on, modified_by = _modified_by, deactive_on = _deactive_on, deactivate_by = _deactivate_by, remarks = _remarks WHERE id = _id; END";
                DB::unprepared($updateProcedure);

                //Delete Procedure
                $deleteProcedure = "DROP PROCEDURE IF EXISTS delete_institution_type; CREATE PROCEDURE delete_institution_type (IN _id INT) BEGIN UPDATE institution_type SET status = 'inactive' WHERE id = _id; END";
                DB::unprepared($deleteProcedure);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
                DB::unprepared("DROP PROCEDURE IF EXISTS create_institution_type");
                DB::unprepared("DROP PROCEDURE IF EXISTS update_institution_type");
                DB::unprepared("DROP PROCEDURE IF EXISTS delete_institution_type");
		Schema::drop('institution_type');
	}

}
