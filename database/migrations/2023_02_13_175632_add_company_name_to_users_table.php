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
            $table->string('company_name')->after('profession')->nullable();
            $table->string('date_of_joining')->after('company_name')->nullable();
            $table->string('business_name')->after('date_of_joining')->nullable();
            $table->string('location')->after('business_name')->nullable();
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
            $table->dropColumn('company_name');
            $table->dropColumn('date_of_joining');
            $table->dropColumn('business_name');
            $table->dropColumn('location');

        });
    }
};
