<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserIdInAcademicsDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('academic_details', function (Blueprint $table) {
            $table->string('user_id')->nullable()->change();  // Make the user_id column nullable
        });
    }

    public function down()
    {
        Schema::table('academic_details', function (Blueprint $table) {
            $table->string('user_id')->nullable(false)->change();  // Revert to non-nullable if rolled back
        });
    }
}

