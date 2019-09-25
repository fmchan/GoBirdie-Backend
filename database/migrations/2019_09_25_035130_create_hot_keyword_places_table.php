<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHotKeywordPlacesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hot_keyword_places', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keyword');
            $table->integer('rank')->default(0);
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
        Schema::drop('hot_keyword_places');
    }
}
