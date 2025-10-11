<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltySchemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_scheme', function (Blueprint $table) {
            $table->id();
            $table->integer("business_id");
            $table->string("name");
            $table->string("description");
            $table->string("img");
            $table->integer("is_logo")->default("1");
            $table->integer("number_stamps");
            $table->string("offer_expiry");
            $table->integer("stamps_per_day")->default("1");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loyalty_scheme');
    }
}
