<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTitleAndDescriptionFromSpecialistsTable extends Migration
{
    public function up()
    {
        Schema::table('specialists', function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
        });
    }

    public function down()
    {
        Schema::table('specialists', function (Blueprint $table) {
            $table->string('title')->nullable(); // Restore the title column
            $table->text('description')->nullable(); // Restore the description column
        });
    }
}
