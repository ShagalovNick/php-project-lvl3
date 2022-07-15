<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //id, url_id, status_code, h1, title, description, created_at
    public function up()
    {
        Schema::create('url_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('url_id');
            $table->foreign('url_id')->references('id')->on('urls');
            $table->integer('status_code')->nullable();
            $table->string('h1')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        /*Schema::create('url_checks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('url_id')->index();
            $table->string('status_code', 5)->nullable();
            $table->string('h1', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamp('created_at');
        });

        Schema::table('url_checks', function (Blueprint $table) {
            $table->foreign('url_id')
            ->references('id')
            ->on('urls')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_checks');
    }
}
