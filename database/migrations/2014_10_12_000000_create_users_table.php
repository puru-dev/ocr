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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('office_location');
            $table->string('contact_number');
            $table->string('salary');
            $table->string('ip');
            $table->string('cordinate_country');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('role')->default(2);
            $table->integer('status')->default(0);
            $table->string('role_name')->default('Employee');
            $table->rememberToken();
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
