<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilesTwittersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles_twitters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('screen_name');
            $table->text('oauth_token');
            $table->text('oauth_secret');
            $table->integer('friends')->nullable();
            $table->string('twitter_id');
            $table->integer('seguidores')->nullable();
            $table->tinyInteger('protected')->default(0);
            $table->integer('statuses_count')->nullable();
            $table->tinyInteger('activa')->default(0);
            $table->text('log')->nullable();
            $table->string('dir_ip',50);
            $table->string('cdpais',3)->nullable();
            $table->string('pais',20)->nullable();
            $table->text('origen'); // TELEFONO, TABLET,ORDENADOR
            $table->text('fhupdate')->nullable();
            $table->date('fhalta')->nullable();
            $table->date('fhbaja')->nullable();
            $table->unsignedBigInteger('apps_twitter_id');

            $table->foreign('apps_twitter_id')->references('id')->on('apps_twitters')->onDelete("cascade"); //clave foranea
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfiles_twitters');
    }
}
