<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();

            $table->string('slug')->nullable()->unique();

            $table->text('icon')->nullable();

            $table->unsignedBigInteger('sort_id')->nullable();

            $table->text('description')->nullable();

            $table->boolean('status')->default(1);

            $table->string('language')->nullable()->default('fa');

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
        Schema::dropIfExists('menus');
    }
}
