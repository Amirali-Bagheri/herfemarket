<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('en_title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('description')->nullable();
//            $table->integer('price')->default(0);
            $table->string('code')->nullable();
//            $table->integer('discount')->default(0);
//            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');

            $table->unsignedBigInteger('business_id');

            $table->smallInteger('status')->default(1);
            $table->boolean('isService')->default(false);
            $table->boolean('comment_status')->default(1);
            $table->text('images')->nullable();
            // $table->json('property_json')->nullable();

            // $table->unique('title');
            // $table->unsignedBigInteger('crawled_id')->nullable();
            // $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();
        });

        // DB::statement('ALTER TABLE products ADD FULLTEXT fulltext_index (title, en_title, excerpt,code)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
