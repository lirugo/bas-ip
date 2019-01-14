<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffPositionsHasDepartmentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'staff_positions_has_departments';

    /**
     * Run the migrations.
     * @table staff_positions_has_departments
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('staff_positions_id');
            $table->unsignedInteger('department_id');

            $table->index(["department_id"], 'fk_staff_positions_has_departments_departments1_idx');

            $table->index(["staff_positions_id"], 'fk_staff_positions_has_departments_staff_positions_idx');


            $table->foreign('staff_positions_id', 'fk_staff_positions_has_departments_staff_positions_idx')
                ->references('id')->on('staff_positions')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('department_id', 'fk_staff_positions_has_departments_departments1_idx')
                ->references('id')->on('departments')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
