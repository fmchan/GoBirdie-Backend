<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHotKeywordArticlesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hot_keyword_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keyword');
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
        Schema::drop('hot_keyword_articles');
    }
}
