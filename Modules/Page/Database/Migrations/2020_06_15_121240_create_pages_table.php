<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('type')->nullable();
            $table->string('language')->default('fa');
            $table->boolean('status')->default(1);
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->date('date')->nullable();
            $table->longText('images')->nullable();
            $table->string('background')->nullable();
            $table->string('html_title', 65)->nullable();
            $table->string('keywords')->nullable();
            $table->string('head')->nullable();
            $table->boolean('menuitem')->default(1);
            $table->boolean('home')->default(0);

            $table->text('og_data')->nullable();
            $table->text('params')->nullable();
            $table->text('mapping')->nullable();

            $table->boolean('isCrawled')->default(false);
            $table->integer('view_count')->default(0);
            $table->integer('sort')->default(0)->unsigned();
            $table->integer('parent_id')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();

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
        Schema::dropIfExists('pages');
    }
}
