<?php

namespace App\Services\Question\Contracts;

use App\Models\Question;
use Illuminate\Support\Collection;

/**
 * Interface QuestionServiceContract
 *
 * @package App\Services\Question\Contracts
 */
interface QuestionServiceContract
{
    /**
     * Show question
     *
     * @param Question $question
     * @return Question | \Illuminate\Database\Eloquent\Model
     */
    public function show(Question $question): Question;

    /**
     * Destroy question
     *
     * @param Question $question
     * @return Question
     */
    public function destroy(Question $question): Question;
}