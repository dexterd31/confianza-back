<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('identificacion', 50);
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('email')->unique();
            $table->string('password', 200);
            $table->dateTime('cambio_password', $precision = 0);            
            $table->text('token');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('estado_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
