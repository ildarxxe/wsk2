<?php

namespace App\Http\Controllers\Poll;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Poll;
use App\Models\Question;
use App\Models\ResponseAnswer;
use App\Models\ShortLink;
use App\Models\UserResponse;
use App\Services\getPollInfoService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    public function showPolls(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $polls = Poll::all();
        if (!$polls) {
            return view('admin.polls.polls')->with('message', 'Опросы не найдены');
        }
        return view('admin.polls.polls')->with('polls', $polls);
    }

    public function showPollById($id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $pollService = new getPollInfoService($id);
        $poll = $pollService->getPollInfo();
        return view('admin.polls.poll')->with('poll', $poll);
    }

    public function showPollByShortLink($short_link): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $short_link = ShortLink::query()->where('short_code', $short_link)->first();
        if (!$short_link) {
            abort(404, 'Опрос не найден');
        }
        $poll_id = $short_link->poll_id;

        $pollService = new getPollInfoService($poll_id);
        $poll = $pollService->getPollInfo();
        $poll['short_link'] = $short_link;

        return view('polls')->with('poll', $poll);
    }

    public function sendPoll(Request $request, $short_link): JsonResponse
    {
        $answers = $request->answers;
        DB::beginTransaction();
        try {
            $user_response = UserResponse::query()->create([
                'short_link_id' => ShortLink::query()->where('short_code', $short_link)->first()->id,
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
                'completed_at' => now()
            ]);
            // qId - question id, aId - answer id
            foreach ($answers as $qId => $aIds) {
                foreach ($aIds as $aId) {
                    ResponseAnswer::query()->create([
                        'user_response_id' => $user_response->id,
                        'question_id' => $qId,
                        'answer_id' => $aId
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true]);
    }
}
