<?php

// namespace Modules\Menu\Database\Migrations;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration
{
    public function up()
    {
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();

            $table->text('link')->nullable();

            $table->text('icon')->nullable();

            $table->string('route')->nullable();

            $table->text('parameters')->nullable();

            $table->string('target')->default('_self');

            $table->string('color')->nullable();

            $table->string('type')->nullable();

            $table->unsignedBigInteger('menu_id')->nullable();
            // $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('parent_id')->nullable();

            $table->unsignedBigInteger('sort_id')->nullable();

            $table->boolean('status')->default(1);
            $table->string('role')->nullable();
            $table->string('permission')->nullable();
            $table->string('function_name')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_menus');
    }
}
