<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable(false);
            $table->string('description', 255)->nullable(false);
            $table->integer('price')->unsigned();
            $table->string('training period', 255)->nullable(false);
            //создание поля для связывания с таблицей Teacher
            $table->integer('teacher_id')->unsigned();
            //создание внешнего ключа для поля 'teacher_id', который связан с полем id таблицы 'teachers'
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
