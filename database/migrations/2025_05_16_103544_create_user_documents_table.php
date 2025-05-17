<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');           // just a numeric id, no FK constraints
            $table->unsignedBigInteger('document_type_id');  // FK to document_types
            $table->string('file_url');                       // file URL in S3
            $table->string('file_name');                      // original filename
            $table->timestamps();

            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_documents');
    }
};
