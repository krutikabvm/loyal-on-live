<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->text("business_name");
            $table->text("business_email");
            $table->text("business_number");
            $table->text("description");
            $table->text("plan")->nullable();
            $table->text("facebook_link")->nullable();
            $table->text("instagram_link")->nullable();
            $table->text("twitter_link")->nullable();
            $table->text("verify")->nullable();
            $table->text("image");
            $table->text("business_address")->nullable();
            $table->text("lat")->nullable();
            $table->text("lon")->nullable();
            $table->text("cover_img")->nullable();
            $table->text('extra_info')->nullable();
              $table->text('paid')->default(0);
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
        Schema::dropIfExists('business');
    }
}
