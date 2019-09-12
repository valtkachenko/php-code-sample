<?php

namespace App\Repositories\Question;

use App\Models\Question;
use App\Models\Evaluation;
use App\Repositories\Question\Contracts\QuestionRepositoryContract;
use App\Repositories\Question\Exceptions\QuestionNotFoundException;

/**
 * Class QuestionRepository
 *
 * @package App\Repositories\Question
 */
class QuestionRepository implements QuestionRepositoryContract
{
    /**
     * @var Question
     */
    public $model;

    /**
     * Messages
     */
    public const MESSAGE_QUESTION_NOT_FOUND = 'Question is not found';

    /**
     * QuestionRepository constructor.
     * @param Question $model
     */
    public function __construct(Question $model)
    {
        $this->model = $model;
    }

    /**
     * Find all questions
     *
     * @return Question[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->model->all();
    }

    /**
     * Find question by id
     *
     * @param int $questionId
     * @throws \App\Repositories\Question\Exceptions\QuestionNotFoundException
     * @return \App\Models\Question
     */
    public function findById(int $questionId): Question
    {
        $question = $this->model->find($questionId);

        if ($question === null) {
            throw new QuestionNotFoundException(self::MESSAGE_QUESTION_NOT_FOUND);
        }

        return $question;
    }

    /**
     * Find question by evaluation relation
     *
     * @param Evaluation $evaluation
     * @return \App\Models\Question
     * @throws \App\Repositories\Question\Exceptions\QuestionNotFoundException
     */
    public function findByEvaluation(Evaluation $evaluation): Question
    {
        $question = $evaluation->question;

        if ($question === null) {
            throw new QuestionNotFoundException(self::MESSAGE_QUESTION_NOT_FOUND);
        }

        return $question;
    }
}