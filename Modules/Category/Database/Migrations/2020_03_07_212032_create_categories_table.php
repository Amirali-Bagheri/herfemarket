<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('en_title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->mediumInteger('priority')->default(0);
            $table->unsignedInteger('parent_id')->nullable()->default(0);
            $table->boolean('status')->default(1);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE categories ADD FULLTEXT fulltext_index (title, slug)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
