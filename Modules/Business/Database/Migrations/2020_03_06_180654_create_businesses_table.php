<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();

            $table->string('slug')->unique();

            $table->string('hash_id')->unique()->nullable();

            $table->text('description')->nullable();

            $table->string('phone')->nullable();

            $table->unsignedBigInteger('fax')->nullable();

            $table->float('latitude', 10, 6)->nullable();

            $table->float('longitude', 10, 6)->nullable();

            $table->text('address')->nullable();

            $table->string('postal_code')->nullable();

            $table->string('website')->nullable();

            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('business_types')->onDelete('cascade');

            $table->string('email')->nullable();

            $table->string('logo')->default('business.png');

            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states');

            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('manager_id');
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');

            $table->smallInteger('status')->default(1);

            $table->boolean('pricing_status')->default(false)->nullable();
            $table->boolean('invoice_request')->default(false);

            $table->string('social_linkedin')->nullable();
            $table->string('social_telegram')->nullable();
            $table->string('social_whatsapp')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_twitter')->nullable();

            $table->string('marketer_mobile')->nullable();
            $table->boolean('has_enamad')->nullable();

            $table->boolean('special_status')->nullable()->default(false);
            $table->string('special_type')->nullable();

//            $table->bigInteger('products_count')->nullable();

            $table->text('send_order_method')->nullable();
            $table->text('send_order_method_link')->nullable();

            $table->text('payment_method')->nullable();
            $table->text('payment_method_link')->nullable();

            $table->text('test_product_time')->nullable();
            $table->text('test_product_time_link')->nullable();

            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();

//            $table->string('enamad_email')->nullable();
//            $table->string('enamad_phone')->nullable();
//            $table->string('enamad_address')->nullable();
            $table->string('enamad_activity_history')->nullable();
            $table->integer('enamad_star')->nullable();
            $table->string('enamad_expiration')->nullable();
            $table->string('enamad_response_time')->nullable();
            $table->date('enamad_crawled_at')->nullable();


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
        Schema::dropIfExists('businesses');
    }
}
