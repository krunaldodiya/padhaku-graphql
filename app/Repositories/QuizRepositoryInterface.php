<?php

namespace App\Repositories\Contracts;

interface QuizRepositoryInterface
{
    public function generateQuiz($forceGenerate);
    public function cancelQuiz($quiz);
    public function notify($topic, $data);
}
