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
            $table->increments('id');
            $table->unsignedInteger('url_id')->index();
            $table->integer('status_code');
            $table->char('h1', 255);
            $table->char('title', 510);
            $table->char('description', 510);
            $table->timestamp('created_at');
        });

        Schema::table('url_checks', function (Blueprint $table) {
            $table->foreign('url_id')
            ->references('id')
            ->on('urls')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
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
