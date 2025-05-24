<?php
namespace App\Services;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Poll;
use App\Models\Question;
use App\Models\ShortLink;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

class getPollInfoService {
    private int $poll_id;
    public function __construct($poll_id) {
        $this->poll_id = $poll_id;
        $this->getPollInfo();
    }

    public function getPollInfo(): Model|Collection|Builder|array|RedirectResponse
    {
        $poll = Poll::query()->find($this->poll_id);
        if (!$poll) {
            return redirect()->back()->with('message', 'Опрос не найден');
        }
        $category = Category::query()->find($poll->category_id)->title;
        $poll['category'] = $category;

        $questionsFromDB = Question::query()->where('poll_id', $this->poll_id)->get();

        foreach ($questionsFromDB as $question) {
            $answersFromDb = Answer::query()->where('question_id', $question->id)->get();
            $question['answers'] = $answersFromDb;
        }

        $poll['questions'] = $questionsFromDB;

        $short_links = ShortLink::query()->where('poll_id', $this->poll_id)->get();
        $poll['short_links'] = $short_links;
        return $poll;
    }
}
