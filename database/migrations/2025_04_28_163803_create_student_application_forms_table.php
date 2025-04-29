<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentApplicationFormsTable extends Migration
{
    public function up()
    {
        Schema::create('student_application_forms', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->string('section_slug')->unique();
            $table->json('data'); // Stores questions, fields, and options as JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_application_forms');
    }
}
