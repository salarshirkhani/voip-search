<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numbers', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->index();
            $table->bigInteger('user')->unsigned()->index();
            $table->bigInteger('number');
            $table->bigInteger('benum');
            $table->string('city');
            $table->boolean('pick')->nullable();
            $table->timestamps();
        });  
        Schema::table('numbers', function (Blueprint $table) {
            $table->foreign('user')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ;
        });     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
