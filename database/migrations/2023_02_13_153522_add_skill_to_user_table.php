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
        Schema::table('users', function (Blueprint $table) {
            $table->string('have_skills')->after('email')->nullable();
            $table->string('education')->after('have_skills')->nullable();
            $table->string('have_certificates')->after('education')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('have_skills');
            $table->dropColumn('education');
            $table->dropColumn('have_certificates');
        });
    }
};
