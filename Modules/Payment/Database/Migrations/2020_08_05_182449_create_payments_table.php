<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('price')->nullable();

            $table->string('transaction_id')->unique()->nullable();

            $table->string('currency')->nullable();

            $table->string('order_id')->nullable();

            $table->string('provider')->nullable();

            $table->string('tracking_code')->nullable();

            $table->string('ref_id')->nullable();

            $table->string('card_number')->nullable();

            $table->string('ip')->nullable();

            $table->json('extra')->nullable();

            $table->text('token')->nullable();

            // $table->morphs('paymentable')->nullable();

            $table->unsignedSmallInteger('status')->default(0)->nullable();

            // $table->timestamp('paid_at')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
