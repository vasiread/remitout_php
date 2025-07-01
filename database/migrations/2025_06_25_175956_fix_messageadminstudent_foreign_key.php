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
        // Safe index drop (PostgreSQL-specific)
        DB::statement('DROP INDEX IF EXISTS messageadminstudent_conversation_id_foreign');

        Schema::table('messageadminstudent', function (Blueprint $table) {
            // Add the foreign key
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

        // Recreate index if needed
        DB::statement('CREATE INDEX IF NOT EXISTS messageadminstudent_conversation_id_foreign ON messageadminstudent(conversation_id)');
    }

};
