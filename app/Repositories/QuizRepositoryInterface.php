<?php

namespace App\Repositories\Contracts;

interface QuizRepositoryInterface
{
    public function generateQuiz($forceGenerate, $quizInfoId);
    public function cancelQuiz($quiz);
    public function notify($topic, $data);
}
