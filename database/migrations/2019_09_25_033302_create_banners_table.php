<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('photo');
            $table->char('type', 1)->default('N');
            $table->string('link')->nullable();
            $table->integer('rank')->default(0);
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->char('status', 1)->default('A');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banners');
    }
}
