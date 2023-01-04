<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoicable_id')->unsigned()->nullable();
            $table->string('invoicable_type')->nullable();
            $table->string('invoice_number')->nullable();
            $table->unsignedBigInteger('tax')->default(0)->description('in irt');
            $table->unsignedBigInteger('total')->default(0)->description('in irt');
            $table->char('currency', 3)->default('IRT');
            $table->char('reference', 17)->nullable();
            $table->unsignedSmallInteger('status')->default(0);
            $table->boolean('isPaymentable')->default(true);
            $table->text('receiver_info')->nullable();
            $table->text('sender_info')->nullable();
            $table->text('payment_info')->nullable();
            $table->text('note')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();

            $table->float('amount')->default(0)->description('in irt, including tax');

            $table->float('tax')->default(0)->description('in irt');

            $table->float('tax_percentage')->default(0);

            $table->boolean('is_discount')->default(false);

            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');

            $table->text('description')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
