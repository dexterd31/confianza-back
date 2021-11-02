<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ips', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->bigInteger('keyform');
            $table->foreignId('user_id')->constrained();
            $table->string('ip', 20);
            $table->foreignId('estado_id')->constrained();
            $table->timestamps();
            $table->index(['ip']);
            $table->index(['created_at']);
            $table->index(['keyform']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ips');
    }
}
