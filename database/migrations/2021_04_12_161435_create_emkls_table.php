<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmklsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emkls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->bigInteger('import_id');
            $table->bigInteger('country_id');
            $table->bigInteger('city_id');
            $table->char('container', 1);
            $table->double('cost');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emkls');
    }
}
