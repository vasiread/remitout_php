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
        Schema::table('messageadminstudent', function (Blueprint $table) {
            // If the index exists but not as a foreign key, drop it first
            $table->dropIndex('messageadminstudent_conversation_id_foreign');

            // Then create the correct foreign key to the admin_student_conversation table
            $table->foreign('conversation_id')
            ->references('id')
                ->on('admin_student_conversation')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messageadminstudent', function (Blueprint $table) {
            $table->dropForeign(['conversation_id']);

            // Recreate the old index if needed
            $table->index('conversation_id', 'messageadminstudent_conversation_id_foreign');
        });
    }

};
