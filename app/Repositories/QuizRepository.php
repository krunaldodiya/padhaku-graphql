<?php

namespace App\Repositories;

use App\Quiz;
use App\Question;

use App\Repositories\Contracts\QuizRepositoryInterface;

class QuizRepository implements QuizRepositoryInterface
{
    public function createQuiz($payload)
    {
        $total_questions = Question::inRandomOrder()->limit(50)->get();
        $answerable_question_ids = array_rand($total_questions->toArray(), 10);

        $payload['question_meta'] = json_encode([
            'total_questions' => $total_questions->toArray(),
            'answerable_question_ids' => $answerable_question_ids,
        ]);

        return Quiz::create($payload);
    }
}
