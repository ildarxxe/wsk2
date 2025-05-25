<?php

namespace App\Http\Controllers\Poll;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\Question;
use App\Models\ResponseAnswer;
use App\Models\ShortLink;
use App\Models\UserResponse;
use App\Services\GetPollInfoService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    public function showPolls(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $polls = Poll::all();
        return view('admin.polls.polls')->with('polls', $polls);
    }

    public function showPollById($id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $getPollInfoService = new GetPollInfoService($id);
        $poll = $getPollInfoService->getPollInfo();
        return view('admin.polls.poll')->with('poll', $poll);
    }

    public function deletePoll($id): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $poll = Poll::query()->find($id);

        DB::beginTransaction();
        try {
            $questions = Question::query()->where('poll_id', $id)->get();
            foreach ($questions as $question) {
                $question->answers()->delete();
                $question->delete();

            }

            $links = ShortLink::query()->where('poll_id', $id)->get();
            foreach ($links as $link) {
                $link->userResponses()->delete();
                $link->delete();
            }
            $poll->delete();
            DB::commit();
            return redirect('/admin/polls')->with('message', 'Успешное удаление');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/admin/polls')->with('message', $e->getMessage());
//            return redirect('/admin/polls')->with('message', 'Произошла ошибка');
        }
    }

    public function showPublicPollByShortLink($shortLink): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $shortLink = ShortLink::query()->where('short_code', $shortLink)->first();
        $getPollInfoService = new GetPollInfoService($shortLink->poll_id);
        $poll = $getPollInfoService->getPollInfo();
        return view('poll')->with('poll', $poll);
    }

    public function sendPublicPoll(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $short_link = ShortLink::query()->where('short_code', $request['shortLink'])->first();
            $user_res = UserResponse::query()->create([
                'short_link_id' => $short_link->id,
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
                'completed_at' => now(),
            ]);
            dd($user_res->id);
            foreach ($request['answers'] as $answer) {
                foreach ($answer as $questionId => $answerId) {
                    ResponseAnswer::query()->create([
                        'user_response_id' => $user_res->id,
                        'question_id' => $questionId,
                        'answer_id' => $answerId,
                    ]);
                }
            }
            DB::commit();
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false]);
        }
    }
}
