<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('start');
            $table->date('end');
            $table->date('display');
            $table->integer('city')->unsigned();
            $table->integer('district')->unsigned();
            $table->string('categories');
            $table->integer('heart')->unsigned()->default(0);
            $table->integer('bookmark')->unsigned()->default(0);
            $table->text('address')->nullable();
            $table->string('gps')->nullable();
            $table->text('transport_short')->nullable();
            $table->text('transport_long')->nullable();
            $table->text('telephone')->nullable();
            $table->boolean('book');
            $table->text('opening')->nullable();
            $table->text('fee')->nullable();
            $table->string('tags_public')->nullable();
            $table->string('tags_private')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->longText('content')->nullable();
            $table->string('facilities')->nullable();
            $table->string('photos')->nullable();
            $table->string('related_articles')->nullable();
            $table->string('related_places')->nullable();
            $table->integer('rank')->default(0);
            $table->char('status', 1)->default('A');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('city')->references('id')->on('cities');
            $table->foreign('district')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
