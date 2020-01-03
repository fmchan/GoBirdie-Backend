<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePushesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pushes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('body');
            $table->string('json')->nullable();
            $table->integer('ttl')->nullable();
            $table->string('image')->nullable();
            $table->string('channel');
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
        Schema::drop('pushes');
    }
}
