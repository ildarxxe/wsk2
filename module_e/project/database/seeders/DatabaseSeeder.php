<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::query()->create([
            'name' => 'admin',
            'password' => Hash::make('toor'),
        ]);

        Category::query()->create([
            'title' => 'Привычки использования социальных сетей'
        ]);
        Category::query()->create([
            'title' => 'Предпочтения в еде'
        ]);
        Category::query()->create([
            'title' => 'Путешествия и отдых'
        ]);

        Poll::query()->create([
            'title' => 'Как часто вы пользуетесь социальными сетями?',
            'description' => 'Этот опрос направлен на изучение предпочтений в использовании социальных сетей: частоты использования, целей и любимых платформ. Результаты помогут узнать, как современные пользователи взаимодействуют с социальными платформами.',
            'category_id' => 1,
        ]);
        Poll::query()->create([
            'title' => 'Ваши привычки в питании',
            'description' => 'Данный опрос предназначен для изучения предпочтений и привычек в питании. Ваши ответы помогут узнать больше о современных подходах к еде.',
            'category_id' => 2,
        ]);
        Poll::query()->create([
            'title' => 'Ваши предпочтения в отдыхе',
            'description' => 'Этот опрос поможет выявить, какие виды отдыха предпочитают современные пользователи, а также понять, какие направления наиболее привлекательны для путешествий.',
            'category_id' => 1,
        ]);

        Question::query()->create([
            'poll_id' => 1,
            'question_text' => 'Как часто вы заходите в социальные сети?',
            'type' => 'single'
        ]);
        Question::query()->create([
            'poll_id' => 1,
            'question_text' => 'Для чего вы чаще всего используете социальные сети?',
            'type' => 'multiple'
        ]);
        Question::query()->create([
            'poll_id' => 1,
            'question_text' => 'Какие из социальных сетей вы используете?',
            'type' => 'multiple'
        ]);
        Question::query()->create([
            'poll_id' => 1,
            'question_text' => 'Сколько времени в день вы проводите в социальных сетях?',
            'type' => 'single'
        ]);
        Question::query()->create([
            'poll_id' => 1,
            'question_text' => 'Как вы относитесь к рекламе в социальных сетях?',
            'type' => 'single'
        ]);

        Question::query()->create([
            'poll_id' => 2,
            'question_text' => 'Как часто вы едите вне дома?',
            'type' => 'single'
        ]);
        Question::query()->create([
            'poll_id' => 2,
            'question_text' => 'Какие виды кухонь вы предпочитаете?',
            'type' => 'multiple'
        ]);
        Question::query()->create([
            'poll_id' => 2,
            'question_text' => 'Какие из перечисленных блюд вы чаще всего выбираете?',
            'type' => 'multiple'
        ]);
        Question::query()->create([
            'poll_id' => 2,
            'question_text' => 'Вы считаете калории?',
            'type' => 'single'
        ]);
        Question::query()->create([
            'poll_id' => 2,
            'question_text' => 'Вы предпочитаете сладкое или соленое?',
            'type' => 'single'
        ]);

        Question::query()->create([
            'poll_id' => 3,
            'question_text' => 'Какой отдых вы предпочитаете?',
            'type' => 'single'
        ]);
        Question::query()->create([
            'poll_id' => 3,
            'question_text' => 'Как часто вы путешествуете?',
            'type' => 'single'
        ]);
        Question::query()->create([
            'poll_id' => 3,
            'question_text' => 'Какие направления для отдыха вам больше всего интересны?',
            'type' => 'multiple'
        ]);
        Question::query()->create([
            'poll_id' => 3,
            'question_text' => 'Вы предпочитаете путешествовать:',
            'type' => 'multiple'
        ]);
        Question::query()->create([
            'poll_id' => 3,
            'question_text' => 'Какой бюджет на отдых для вас приемлем?',
            'type' => 'single'
        ]);

        Answer::query()->create([
            'question_id' => 1,
            'answer_text' => 'Ежедневно'
        ]);
        Answer::query()->create([
            'question_id' => 1,
            'answer_text' => 'Несколько раз в неделю'
        ]);
        Answer::query()->create([
            'question_id' => 1,
            'answer_text' => 'Раз в неделю'
        ]);
        Answer::query()->create([
            'question_id' => 1,
            'answer_text' => 'Реже одного раза в неделю'
        ]);

        Answer::query()->create([
            'question_id' => 2,
            'answer_text' => 'Общение с друзьями и семьей'
        ]);
        Answer::query()->create([
            'question_id' => 2,
            'answer_text' => 'Чтение новостей'
        ]);
        Answer::query()->create([
            'question_id' => 2,
            'answer_text' => 'Развлечения'
        ]);
        Answer::query()->create([
            'question_id' => 2,
            'answer_text' => 'Работа и обучение'
        ]);

        Answer::query()->create([
            'question_id' => 3,
            'answer_text' => 'Instagram'
        ]);
        Answer::query()->create([
            'question_id' => 3,
            'answer_text' => 'Facebook'
        ]);
        Answer::query()->create([
            'question_id' => 3,
            'answer_text' => 'TikTok'
        ]);
        Answer::query()->create([
            'question_id' => 3,
            'answer_text' => 'Twitter'
        ]);

        Answer::query()->create([
            'question_id' => 4,
            'answer_text' => 'Менее 1 часа'
        ]);
        Answer::query()->create([
            'question_id' => 4,
            'answer_text' => '1-2 часа'
        ]);
        Answer::query()->create([
            'question_id' => 4,
            'answer_text' => '3-5 часов'
        ]);
        Answer::query()->create([
            'question_id' => 4,
            'answer_text' => 'Более 5 часов'
        ]);

        Answer::query()->create([
            'question_id' => 5,
            'answer_text' => 'Положительно'
        ]);
        Answer::query()->create([
            'question_id' => 5,
            'answer_text' => 'Нейтрально'
        ]);
        Answer::query()->create([
            'question_id' => 5,
            'answer_text' => 'Отрицательно'
        ]);
        Answer::query()->create([
            'question_id' => 5,
            'answer_text' => 'Не замечаю ее'
        ]);


        Answer::query()->create([
            'question_id' => 6,
            'answer_text' => 'Почти каждый день'
        ]);
        Answer::query()->create([
            'question_id' => 6,
            'answer_text' => 'Несколько раз в неделю'
        ]);
        Answer::query()->create([
            'question_id' => 6,
            'answer_text' => 'Раз в неделю'
        ]);
        Answer::query()->create([
            'question_id' => 6,
            'answer_text' => 'Очень редко'
        ]);

        Answer::query()->create([
            'question_id' => 7,
            'answer_text' => 'Итальянскую'
        ]);
        Answer::query()->create([
            'question_id' => 7,
            'answer_text' => 'Японскую'
        ]);
        Answer::query()->create([
            'question_id' => 7,
            'answer_text' => 'Мексиканскую'
        ]);
        Answer::query()->create([
            'question_id' => 7,
            'answer_text' => 'Домашнюю'
        ]);

        Answer::query()->create([
            'question_id' => 8,
            'answer_text' => 'Пицца'
        ]);
        Answer::query()->create([
            'question_id' => 8,
            'answer_text' => 'Суши'
        ]);
        Answer::query()->create([
            'question_id' => 8,
            'answer_text' => 'Салат'
        ]);
        Answer::query()->create([
            'question_id' => 8,
            'answer_text' => 'Стейк'
        ]);

        Answer::query()->create([
            'question_id' => 9,
            'answer_text' => 'Да, регулярно'
        ]);
        Answer::query()->create([
            'question_id' => 9,
            'answer_text' => 'Иногда'
        ]);
        Answer::query()->create([
            'question_id' => 9,
            'answer_text' => 'Редко'
        ]);
        Answer::query()->create([
            'question_id' => 9,
            'answer_text' => 'Никогда'
        ]);

        Answer::query()->create([
            'question_id' => 10,
            'answer_text' => 'Сладкое'
        ]);
        Answer::query()->create([
            'question_id' => 10,
            'answer_text' => 'Соленое'
        ]);
        Answer::query()->create([
            'question_id' => 10,
            'answer_text' => 'Оба'
        ]);
        Answer::query()->create([
            'question_id' => 10,
            'answer_text' => 'Ни одно из них'
        ]);

        Answer::query()->create([
            'question_id' => 11,
            'answer_text' => 'Активный'
        ]);
        Answer::query()->create([
            'question_id' => 11,
            'answer_text' => 'Пляжный'
        ]);
        Answer::query()->create([
            'question_id' => 11,
            'answer_text' => 'Экскурсионный'
        ]);
        Answer::query()->create([
            'question_id' => 11,
            'answer_text' => 'Уединенный'
        ]);

        Answer::query()->create([
            'question_id' => 12,
            'answer_text' => 'Несколько раз в год'
        ]);
        Answer::query()->create([
            'question_id' => 12,
            'answer_text' => 'Один раз в год'
        ]);
        Answer::query()->create([
            'question_id' => 12,
            'answer_text' => 'Реже одного раза в год'
        ]);
        Answer::query()->create([
            'question_id' => 12,
            'answer_text' => 'Почти не путешествую'
        ]);

        Answer::query()->create([
            'question_id' => 13,
            'answer_text' => 'Европа'
        ]);
        Answer::query()->create([
            'question_id' => 13,
            'answer_text' => 'Азия'
        ]);
        Answer::query()->create([
            'question_id' => 13,
            'answer_text' => 'Америка'
        ]);
        Answer::query()->create([
            'question_id' => 13,
            'answer_text' => 'Африка'
        ]);

        Answer::query()->create([
            'question_id' => 14,
            'answer_text' => 'В одиночку'
        ]);
        Answer::query()->create([
            'question_id' => 14,
            'answer_text' => 'С партнером'
        ]);
        Answer::query()->create([
            'question_id' => 14,
            'answer_text' => 'С семьей'
        ]);
        Answer::query()->create([
            'question_id' => 14,
            'answer_text' => 'С друзьями'
        ]);

        Answer::query()->create([
            'question_id' => 15,
            'answer_text' => 'Экономичный'
        ]);
        Answer::query()->create([
            'question_id' => 15,
            'answer_text' => 'Средний'
        ]);
        Answer::query()->create([
            'question_id' => 15,
            'answer_text' => 'Высокий'
        ]);
        Answer::query()->create([
            'question_id' => 15,
            'answer_text' => 'Не имеет значения'
        ]);
    }
}
