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
        Schema::table('messageadminnbfc', function (Blueprint $table) {
            // Drop the existing (wrong) foreign key constraint first
            $table->dropForeign(['conversation_id']);

            // Now add the correct foreign key constraint
            $table->foreign('conversation_id')
            ->references('id')
                ->on('admin_nbfc_conversation')
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
        Schema::table('messageadminnbfc', function (Blueprint $table) {
            // Drop the corrected foreign key
            $table->dropForeign(['conversation_id']);

            // Optionally: re-add old FK to `conversations` if needed, or just an index
            $table->index('conversation_id', 'messageadminnbfc_conversation_id_foreign');
        });
    }

};
