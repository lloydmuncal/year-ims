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
        Schema::create('yearbooks', function (Blueprint $table) {
            $table->id();
            $table->string('Yearbook_id');
            $table->string('Title')->nullable();;
            $table->string('Batch')->nullable();;
            $table->string('Name')->nullable();;
            $table->string('FileName')->nullable();;
            $table->string('EXT')->nullable();;
            $table->string('Overide')->nullable();;
            $table->string('SelectedCover')->nullable();;
            $table->string('SelectedBackground')->nullable();;
            $table->string('Section')->nullable();;
            $table->integer('Page');
            $table->integer('Gallery');
            $table->integer('pic');
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
        Schema::dropIfExists('yearbooks');
    }
};
