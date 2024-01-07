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
        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            $table->string('LRN_No')->unique();
            $table->string('SurName');
            $table->string('Mi')->nullable();
            $table->string('FirstName');
            $table->string('Suffix')->nullable();
            $table->string('Email');
            $table->string('Password');
            $table->string('PinCode')->nullable();
            $table->string('Path')->nullable();
            $table->string('Phone_No');
            $table->string('Gender');
            $table->string('Track');
            $table->string('Section');
            $table->string('Year');
            $table->string('UserType')->nullable();
            $table->boolean('Status');
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
        Schema::dropIfExists('login');
    }
};
