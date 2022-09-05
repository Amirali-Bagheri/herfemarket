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

            $table->string('md5')->nullable();

            $table->string('name')->nullable();

            $table->string('first_name')->nullable();

            $table->string('last_name')->nullable();

            $table->string('email')->unique()->nullable();

            $table->boolean('newsletter_subscribe')->default(1);

            $table->string('avatar')->default('avatar.png');

            $table->string('mobile')->unique()->nullable();

            $table->string('phone')->unique()->nullable();

            $table->string('verification_code')->unique()->nullable();

            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->boolean('status')->default(1);

            $table->string('password')->nullable();

            $table->string('affiliate')->nullable();
            $table->string('referer')->nullable();

            $table->string('google_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('microsoft_id')->nullable();

            $table->string('job')->nullable();
            $table->string('national_code')->nullable();
            $table->date('birth')->nullable();

            $table->string('bank_card')->nullable();
            $table->string('bank_sheba')->nullable();

            $table->boolean('google2fa_enable')->default(false);
            $table->string('google2fa_secret')->nullable();

            $table->string('two_factor_recovery_codes')->nullable();
            $table->string('two_factor_secret')->nullable();

            $table->timestamp('last_login_at')->nullable();

            $table->string('last_login_ip')->nullable();

            $table->string('company_name')->nullable();
            $table->string('economic_code')->nullable();
            $table->string('economic_national_code')->nullable();
            $table->string('company_id')->nullable();

            $table->string('marketing_code')->nullable();

            $table->rememberToken();
            $table->softDeletes();
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
