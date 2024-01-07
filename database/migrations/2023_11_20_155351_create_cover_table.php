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
        Schema::create('cover', function (Blueprint $table) {
            $table->id();
            $table->string('Cover_id')->unique();
            $table->string('Name');
            $table->string('FileName');
            $table->string('EXT');
            $table->string('Path');
            $table->string('Overide')->nullable();;
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
        Schema::dropIfExists('cover');
    }
};
