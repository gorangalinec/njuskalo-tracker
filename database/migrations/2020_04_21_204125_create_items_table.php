<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->integer('external_id')->unsigned();
            $table->string('title', 255);
            $table->string('link', 1024);
            $table->string('prices', 1024);
            $table->float('price');
            $table->string('image', 1024);
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('items');
    }
}
