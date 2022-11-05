<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mongodb")->create('add_spots', function (Blueprint $table) {
            $table->id("_id");
            $table->string("title");
       
            $table->integer("old_id");
            $table->text("link_type");
            $table->text("link_value");
            $table->string("image");
            $table->integer("sequence");
            $table->string("status");
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
        Schema::dropIfExists('add_spots');
    }
};
