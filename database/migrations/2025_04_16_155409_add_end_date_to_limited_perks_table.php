<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEndDateToLimitedPerksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('limited_perks', function (Blueprint $table) {
            $table->dateTime('end_date')->nullable()->after('status'); // adjust 'after' to suit your table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('limited_perks', function (Blueprint $table) {
            $table->dropColumn('end_date');
        });
    }
}
