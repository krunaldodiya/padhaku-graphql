<?php

namespace App\Console\Commands;

use App\QuizInfo;
use Illuminate\Console\Command;

use App\Repositories\QuizRepository;

class CreateQuiz extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:quiz';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create quiz';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(QuizRepository $quizRepo)
    {
        $quizInfo = QuizInfo::find("a5b598af-8768-40a7-9974-8fa020de6e7c");

        return $quizRepo->generateQuiz(false, $quizInfo->id);
    }
}
