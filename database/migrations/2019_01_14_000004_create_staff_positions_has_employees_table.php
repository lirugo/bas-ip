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
    public $set_schema_table = 'positions_has_employees';

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
            $table->unsignedInteger('positions_id');
            $table->unsignedInteger('employees_id');
            $table->unsignedInteger('salary');

            $table->index(["positions_id"]);

            $table->index(["employees_id"]);


            $table->foreign('positions_id')
                ->references('id')->on('staff_positions')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('employees_id')
                ->references('id')->on('employees')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->primary(['positions_id', 'employees_id']);
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
