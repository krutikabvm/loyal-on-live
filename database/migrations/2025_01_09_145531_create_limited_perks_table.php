<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLimitedPerksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limited_perks', function (Blueprint $table) {
            $table->id();
            $table->integer("business_id");
            $table->integer("user_id");
            $table->string('description', 255);
            $table->integer('limit')->nullable();
            $table->string('setTime', 100);
            $table->string('week_days', 50)->nullable();
            $table->string('uses_per_month', 50)->nullable();
            $table->string('date_range', 255)->nullable();
            $table->decimal('minimum_spend', 10, 2)->nullable();
            $table->decimal('estimated_savings', 10, 2)->nullable();
            $table->text('terms')->nullable();
            $table->string('type');
            $table->string('pin')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('limited_perks');
    }
}
