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
        Schema::enableForeignKeyConstraints();
        Schema::create('survey_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('survey_id')->references('id')->on('surveys')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->float('skorv')->default(0);
            $table->float('skori')->default(0);
            $table->float('skorp')->default(0);
            $table->float('skors')->default(0);
            $table->float('maks_skorv')->default(0);
            $table->float('maks_skori')->default(0);
            $table->float('maks_skorp')->default(0);
            $table->float('maks_skors')->default(0);
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
        Schema::dropIfExists('survey-users');
    }
};
