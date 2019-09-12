<?php

namespace App\Services\Question;

use App\Models\Question;
use App\Services\Question\Contracts\QuestionServiceContract;
use Illuminate\Support\Collection;

/**
 * Class QuestionService
 *
 * @package App\Services\Question
 */
class QuestionService implements QuestionServiceContract
{
    /**
     * Show question
     *
     * @param Question $question
     * @return Question | \Illuminate\Database\Eloquent\Model
     */
    public function show(Question $question): Question
    {
        return $question->load([
            'evaluation.type',
            'answerPlaceholder',
            'evaluation.options'
        ]);
    }

    /**
     * Destroy question
     *
     * @param Question $question
     * @return Question
     * @throws \Exception
     */
    public function destroy(Question $question): Question
    {
        // Destroy related data
        $question->answerPlaceholder()->delete();
        if ($question->evaluation !== null) {
            $question->evaluation->options()->delete();
        }
        $question->evaluation()->delete();

        // Destroy question itself
        $question->delete();

        return $question;
    }
}