<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesNameTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'employees_name';

    /**
     * Run the migrations.
     * @table employees_name
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->string('first', 45);
            $table->string('middle', 45)->nullable();
            $table->string('last', 45);
            $table->enum('language', ['en']);

            $table->index(["employee_id"], 'fk_employees_name_employees1_idx');


            $table->foreign('employee_id', 'fk_employees_name_employees1_idx')
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
