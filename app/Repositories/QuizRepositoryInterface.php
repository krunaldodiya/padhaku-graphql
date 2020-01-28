<?php

namespace App\Repositories\Contracts;

interface QuizRepositoryInterface
{
    public function generateQuiz();
    public function cancelQuiz($quiz);
}
