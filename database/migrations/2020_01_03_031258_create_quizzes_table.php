<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('host_id')->nullable();
            $table->foreign('host_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->uuid('quiz_info_id')->nullable();
            $table->foreign('quiz_info_id')->references('id')->on('quiz_infos')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('expired_at')->nullable();
            $table->enum('status', ['pending', 'finished', 'started', 'suspended', 'full'])->default('pending');

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
        Schema::dropIfExists('quizzes');
    }
}
