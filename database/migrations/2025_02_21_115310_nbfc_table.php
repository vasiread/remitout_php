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
        Schema::create('nbfc', function (Blueprint $table) {
            $table->id();
            $table->string('nbfc_id')->nullable()->unique();
            $table->string('nbfc_name');
            $table->string('nbfc_represent');
            $table->string('nbfc_type');
            
            $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nbfcdata');
    }
};
