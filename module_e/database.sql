-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 25 2025 г., 14:08
-- Версия сервера: 9.2.0
-- Версия PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `wsk2_module_e`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$ruxz1JlH.YeHFcHTL0.IfO2/EkiYliJ1Ub.rWVVnAi8b6vo.ttzB6', '2025-05-25 01:40:44', '2025-05-25 01:40:44');

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `answer_text` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`) VALUES
(1, 1, 'Ежедневно'),
(2, 1, 'Несколько раз в неделю'),
(3, 1, 'Раз в неделю'),
(4, 1, 'Реже одного раза в неделю'),
(5, 2, 'Общение с друзьями и семьей'),
(6, 2, 'Чтение новостей'),
(7, 2, 'Развлечения'),
(8, 2, 'Работа и обучение'),
(9, 3, 'Instagram'),
(10, 3, 'Facebook'),
(11, 3, 'TikTok'),
(12, 3, 'Twitter'),
(13, 4, 'Менее 1 часа'),
(14, 4, '1-2 часа'),
(15, 4, '3-5 часов'),
(16, 4, 'Более 5 часов'),
(17, 5, 'Положительно'),
(18, 5, 'Нейтрально'),
(19, 5, 'Отрицательно'),
(20, 5, 'Не замечаю ее'),
(21, 6, 'Почти каждый день'),
(22, 6, 'Несколько раз в неделю'),
(23, 6, 'Раз в неделю'),
(24, 6, 'Очень редко'),
(25, 7, 'Итальянскую'),
(26, 7, 'Японскую'),
(27, 7, 'Мексиканскую'),
(28, 7, 'Домашнюю'),
(29, 8, 'Пицца'),
(30, 8, 'Суши'),
(31, 8, 'Салат'),
(32, 8, 'Стейк'),
(33, 9, 'Да, регулярно'),
(34, 9, 'Иногда'),
(35, 9, 'Редко'),
(36, 9, 'Никогда'),
(37, 10, 'Сладкое'),
(38, 10, 'Соленое'),
(39, 10, 'Оба'),
(40, 10, 'Ни одно из них'),
(41, 11, 'Активный'),
(42, 11, 'Пляжный'),
(43, 11, 'Экскурсионный'),
(44, 11, 'Уединенный'),
(45, 12, 'Несколько раз в год'),
(46, 12, 'Один раз в год'),
(47, 12, 'Реже одного раза в год'),
(48, 12, 'Почти не путешествую'),
(49, 13, 'Европа'),
(50, 13, 'Азия'),
(51, 13, 'Америка'),
(52, 13, 'Африка'),
(53, 14, 'В одиночку'),
(54, 14, 'С партнером'),
(55, 14, 'С семьей'),
(56, 14, 'С друзьями'),
(57, 15, 'Экономичный'),
(58, 15, 'Средний'),
(59, 15, 'Высокий'),
(60, 15, 'Не имеет значения');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Привычки использования социальных сетей'),
(2, 'Предпочтения в еде'),
(3, 'Путешествия и отдых'),
(4, 'Названи');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2025_05_25_061219_create_categories_table', 1),
(4, '2025_05_25_061300_create_polls_table', 1),
(5, '2025_05_25_061322_create_questions_table', 1),
(6, '2025_05_25_061512_create_answers_table', 1),
(7, '2025_05_25_061522_create_short_links_table', 1),
(8, '2025_05_25_061558_create_user_responses_table', 1),
(9, '2025_05_25_061821_create_response_answers_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `polls`
--

CREATE TABLE `polls` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `polls`
--

INSERT INTO `polls` (`id`, `category_id`, `title`, `description`) VALUES
(1, 1, 'Как часто вы пользуетесь социальными сетями?', 'Этот опрос направлен на изучение предпочтений в использовании социальных сетей: частоты использования, целей и любимых платформ. Результаты помогут узнать, как современные пользователи взаимодействуют с социальными платформами.'),
(2, 2, 'Ваши привычки в питании', 'Данный опрос предназначен для изучения предпочтений и привычек в питании. Ваши ответы помогут узнать больше о современных подходах к еде.'),
(3, 3, 'Ваши предпочтения в отдыхе', 'Этот опрос поможет выявить, какие виды отдыха предпочитают современные пользователи, а также понять, какие направления наиболее привлекательны для путешествий.');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `poll_id` bigint UNSIGNED NOT NULL,
  `type` enum('single','multiple') COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `poll_id`, `type`, `question_text`) VALUES
(1, 1, 'single', 'Как часто вы заходите в социальные сети?'),
(2, 1, 'multiple', 'Для чего вы чаще всего используете социальные сети?'),
(3, 1, 'multiple', 'Какие из социальных сетей вы используете?'),
(4, 1, 'single', 'Сколько времени в день вы проводите в социальных сетях?'),
(5, 1, 'single', 'Как вы относитесь к рекламе в социальных сетях?'),
(6, 2, 'single', 'Как часто вы едите вне дома?'),
(7, 2, 'multiple', 'Какие виды кухонь вы предпочитаете?'),
(8, 2, 'multiple', 'Какие из перечисленных блюд вы чаще всего выбираете?'),
(9, 2, 'single', 'Вы считаете калории?'),
(10, 2, 'single', 'Вы предпочитаете сладкое или соленое?'),
(11, 3, 'single', 'Какой отдых вы предпочитаете?'),
(12, 3, 'single', 'Как часто вы путешествуете?'),
(13, 3, 'multiple', 'Какие направления для отдыха вам больше всего интересны?'),
(14, 3, 'single', 'Вы предпочитаете путешествовать:'),
(15, 3, 'single', 'Какой бюджет на отдых для вас приемлем?');

-- --------------------------------------------------------

--
-- Структура таблицы `response_answers`
--

CREATE TABLE `response_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_response_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `answer_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `short_links`
--

CREATE TABLE `short_links` (
  `id` bigint UNSIGNED NOT NULL,
  `poll_id` bigint UNSIGNED NOT NULL,
  `short_code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `short_links`
--

INSERT INTO `short_links` (`id`, `poll_id`, `short_code`) VALUES
(2, 1, 'ph3QpPaP');

-- --------------------------------------------------------

--
-- Структура таблицы `user_responses`
--

CREATE TABLE `user_responses` (
  `id` bigint UNSIGNED NOT NULL,
  `short_link_id` bigint UNSIGNED NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed_at` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_name_unique` (`name`);

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polls_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_poll_id_foreign` (`poll_id`);

--
-- Индексы таблицы `response_answers`
--
ALTER TABLE `response_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_answers_user_response_id_foreign` (`user_response_id`),
  ADD KEY `response_answers_question_id_foreign` (`question_id`),
  ADD KEY `response_answers_answer_id_foreign` (`answer_id`);

--
-- Индексы таблицы `short_links`
--
ALTER TABLE `short_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `short_links_poll_id_foreign` (`poll_id`);

--
-- Индексы таблицы `user_responses`
--
ALTER TABLE `user_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_responses_short_link_id_foreign` (`short_link_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `response_answers`
--
ALTER TABLE `response_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `short_links`
--
ALTER TABLE `short_links`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user_responses`
--
ALTER TABLE `user_responses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Ограничения внешнего ключа таблицы `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`);

--
-- Ограничения внешнего ключа таблицы `response_answers`
--
ALTER TABLE `response_answers`
  ADD CONSTRAINT `response_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `response_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `response_answers_user_response_id_foreign` FOREIGN KEY (`user_response_id`) REFERENCES `user_responses` (`id`);

--
-- Ограничения внешнего ключа таблицы `short_links`
--
ALTER TABLE `short_links`
  ADD CONSTRAINT `short_links_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_responses`
--
ALTER TABLE `user_responses`
  ADD CONSTRAINT `user_responses_short_link_id_foreign` FOREIGN KEY (`short_link_id`) REFERENCES `short_links` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
