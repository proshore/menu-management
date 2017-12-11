<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->integer('menu_item_id')->unsigned()->nullable();
            $table->string('name', 100);
            $table->tinyInteger('type')->comment('0=>Internal Link, 1=>CMS Pages, 2=>External Link');
            $table->string('value', 250)->comment('link/url to the named resource');
            $table->tinyInteger('target_group')->comment('Visibility based upon user group');
            $table->tinyInteger('status')->default(1)->comment('0=>Inactive, 1=>Active');
            $table->integer('display_order');
            $table->timestamps();

            $table->foreign('menu_id')
                     ->references('id')->on('menus');
            $table->foreign('menu_item_id')
                     ->references('id')->on('menu_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
