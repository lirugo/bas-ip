<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffPositionsHasEmployeesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'staff_positions_has_employees';

    /**
     * Run the migrations.
     * @table staff_positions_has_employees
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('staff_positions_id');
            $table->unsignedInteger('employees_id');
            $table->unsignedInteger('salary');

            $table->index(["staff_positions_id"], 'fk_staff_positions_has_employees_staff_positions1_idx');

            $table->index(["employees_id"], 'fk_staff_positions_has_employees_employees1_idx');


            $table->foreign('staff_positions_id', 'fk_staff_positions_has_employees_staff_positions1_idx')
                ->references('id')->on('staff_positions')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('employees_id', 'fk_staff_positions_has_employees_employees1_idx')
                ->references('id')->on('employees')
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
