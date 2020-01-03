<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Repositories\QuizRepository;
use App\User;
use App\Category;

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
        $now = Carbon::now();
        $expired_at = $now->addHour(1);

        $from = Carbon::parse('today 10am');
        $to = Carbon::parse('today 8pm');

        $host_id = User::first()->id;
        $category_id = Category::first()->id;
        $entry_fee = 0;

        if ($now->gte($from) && $now->lte($to)) {
            return $quizRepo->createQuiz([
                'host_id' => $host_id,
                'category_id' => $category_id,
                'entry_fee' => $entry_fee,
                'expired_at' => $expired_at,
            ]);
        }
    }
}
