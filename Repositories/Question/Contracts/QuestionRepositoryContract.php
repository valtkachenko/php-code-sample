<?php

namespace App\Repositories\Question\Contracts;

use App\Models\AnswerPlaceholder;
use App\Models\Question;
use App\Models\Evaluation;

/**
 * Interface QuestionRepositoryContract
 *
 * @package App\Repositories\Question\Contracts
 */
interface QuestionRepositoryContract
{
    /**
     * Find all questions
     *
     * @return Question[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll();

    /**
     * Find question by id
     *
     * @param int $questionId
     * @return \App\Models\Question
     */
    public function findById(int $questionId): Question;

    /**
     * Find question by evaluation relation
     *
     * @param Evaluation $evaluation
     * @return \App\Models\Question
     */
    public function findByEvaluation(Evaluation $evaluation): Question;
}