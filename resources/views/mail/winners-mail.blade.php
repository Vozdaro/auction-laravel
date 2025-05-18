@php

/** @var Collection $lots */

use Illuminate\Database\Eloquent\Collection;

@endphp
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поздравляем с победой!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .lot-details {
            margin: 15px 0;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Поздравляем с победой в аукционе!</h1>
</div>
<div class="content">
    <p>Здравствуйте!</p>
    <p>Вы стали победителем в торгах по следующим лотам:</p>

    @foreach($lots as $lot)
        <div class="lot-details">
            <h3>{{ $lot->title }}</h3>
            <p>Описание: {{ $lot->description }}</p>
            <p>Финальная цена: {{ $lot->bets->last()->amount }} ₽</p>
        </div>
    @endforeach

    <p>Для получения дополнительной информации о получении выигранных лотов, пожалуйста, свяжитесь с нами.</p>
    <p>С уважением,<br>Команда аукциона</p>
</div>
</body>
</html>
