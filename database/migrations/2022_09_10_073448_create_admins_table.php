<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string("profile_image")->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->unique();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('twitter')->nullable();;
            $table->string('facebook')->nullable();;
            $table->string('linkedin')->nullable();;
            $table->string('instagram')->nullable();;
            $table->text('about')->nullable();;
            $table->string('phone')->unique();
            $table->string('wp_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('admins');
    }
};