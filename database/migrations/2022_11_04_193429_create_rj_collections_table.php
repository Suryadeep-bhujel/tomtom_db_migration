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
        Schema::connection("mongodb")->create('rj_collections', function (Blueprint $table) {
            $table->id();
            $table->integer("old_id");
            $table->string("from");
            $table->string("podcaster_type");
            $table->string("podcaster_value");
            $table->string("profile_image");
            $table->string("user_id");
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
        Schema::dropIfExists('rj_collections');
    }
};
