<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('country_id');
            $table->bigInteger('city_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('timeline');
            $table->string('constructor');
            $table->string('manager');
            $table->string('consultant');
            $table->string('owner');
            $table->char('payment_method', 1);
            $table->char('supply_method', 1);
            $table->char('ppn', 1);
            $table->integer('progress')->default(0);
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
        Schema::dropIfExists('projects');
    }
}
