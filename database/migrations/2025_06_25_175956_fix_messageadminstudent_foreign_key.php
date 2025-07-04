<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // Drop the existing foreign key (MySQL syntax)
        Schema::table('messageadminstudent', function (Blueprint $table) {
            $table->dropForeign(['conversation_id']); // Only works if it exists
        });

        // Re-add the foreign key properly
        Schema::table('messageadminstudent', function (Blueprint $table) {
            $table->foreign('conversation_id')
            ->references('id')
                ->on('admin_student_conversation')
                ->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('messageadminstudent', function (Blueprint $table) {
            $table->dropForeign(['conversation_id']);
        });
    }

};
