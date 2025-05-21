
<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeysFromUserAdditionalFieldValuesAgain extends Migration
{
    public function up()
    {
        Schema::table('user_additional_field_values', function (Blueprint $table) {
            $table->dropForeign(['field_id']);
            $table->dropForeign(['user_id']);
        });
    }

    public function down()
    {
        Schema::table('user_additional_field_values', function (Blueprint $table) {
            $table->foreign('field_id')->references('id')->on('additional_fields');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
