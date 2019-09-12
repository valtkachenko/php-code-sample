<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Organization\Exceptions\OrganizationNotFoundException;
use App\Repositories\Branch\Exceptions\BranchNotFoundException;
use App\Repositories\Question\Exceptions\QuestionNotFoundException;
use App\Services\Question\Validation\QuestionServiceDestroyRequestValidator;
use App\Services\Question\Validation\QuestionServiceShowRequestValidator;
use App\Services\Question\Contracts\QuestionServiceContract;
use Illuminate\Validation\ValidationException;
use Throwable;

/**
 * Class QuestionController
 *
 * @package App\Http\Controllers\API
 */
class QuestionController extends Controller
{
    /**
     * @var QuestionServiceContract
     */
    public $questionService;

    /**
     * QuestionController constructor.
     *
     * @param QuestionServiceContract $questionService
     */
    public function __construct(QuestionServiceContract $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Show topic question by id
     *
     * METHOD: GET
     * URL: /api/questions/{questionId}
     *
     * @param Request $request
     * @param int $questionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, int $questionId)
    {
        try {
            $data = app(QuestionServiceShowRequestValidator::class)->attempt($request, $questionId);
            $question = $this->questionService->show(
                $data['question']
            );
        } catch (
        OrganizationNotFoundException | BranchNotFoundException |  QuestionNotFoundException $e
        ) {
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage(),
            ], 404);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Can not get question',
            ], 400);
        }

        return response()->json($question, 200);
    }

    /**
     * Destroy question by id
     *
     * METHOD: DELETE
     * URL: /api/questions/{questionId}
     *
     * @param Request $request
     * @param int $questionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int $questionId)
    {
        try {
            $data = app(QuestionServiceDestroyRequestValidator::class)->attempt($request, $questionId);
            $question = $this->questionService->destroy(
                $data['question']
            );
        } catch (
        OrganizationNotFoundException | BranchNotFoundException | QuestionNotFoundException $e
        ) {
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage(),
            ], 404);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Can not destroy question',
            ], 400);
        }

        return response()->json($question, 200);
    }
}
