<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTwittersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps_twitters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->text('usuario')->nullable();
            $table->text('pass')->nullable();
            $table->text('db')->nullable();
            $table->string('server')->nullable();
            $table->text('token');
            $table->text('secret');
            $table->string('activa',1);
            $table->date('fecha_baja')->nullable();
            $table->text('comentario');
            $table->date('fecha_alta')->nullable();
            $table->tinyInteger('idcategoria')->default('0');
            $table->integer('idusuproxy')->default('0');
            $table->string('idioma',3)->default('ES');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps_twitters');
    }
}
