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
    public $set_schema_table = 'positions_has_departments';

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
            $table->unsignedInteger('positions_id');
            $table->unsignedInteger('department_id');

            $table->index(["department_id"]);

            $table->index(["positions_id"]);


            $table->foreign('positions_id')
                ->references('id')->on('staff_positions')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('department_id')
                ->references('id')->on('departments')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->primary(['positions_id', 'department_id']);
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
