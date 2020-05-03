<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_rankings', function (Blueprint $table) {
            $table->primary(['quiz_id', 'user_id']);

            $table->uuid('quiz_id');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('rank')->nullable();
            $table->integer('prize_amount')->nullable();
            $table->decimal('points', 8, 2)->default(0);
            $table->enum('quiz_status', ['joined', 'finished', 'canceled', 'left', 'missed', 'started', 'pending'])->default('joined');

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
        Schema::dropIfExists('quiz_rankings');
    }
}
