<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Записная книга</title>
    <link rel="stylesheet" href="https://netology-code.github.io/mq-simulator/fluid-images/phone-book/css/phone-book-common.css">
</head>
<body>
<div class="container">
    @foreach($notebooks as $notebook)
    <div class="card">
        <img  class="card__avatar" src={{ $notebook->photo }} alt="Фотография {{ $notebook->last_name}} {{ $notebook->first_name }} {{ $notebook->father_name }} ">
        <div class="card__content">
            <h3 class="card__name">{{ $notebook->last_name}} {{ $notebook->first_name }} {{ $notebook->father_name }}</h3>
            <a class="card__contact">{{ $notebook->phone }}</a>
            <a class="card__contact">{{ $notebook->email }}</a>
            <a class="card__contact">{{ $notebook->company_name }}</a>
            <a class="card__contact">{{ $notebook->birth_date }}</a>
        </div>
    </div>
    @endforeach
    {{ $notebooks->links() }}
</div>
</body>
</html>

<style>
    .card__contact {
        text-decoration: none;
        color: #000000;
    }

    .card__contact {
        display: flex;
    }

    .pagination li {
        list-style: none;
        display: inline-block;
        margin-right: 5px;
    }

    .pagination li a {
        padding: 5px 8px;
        font-size: 14px;
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        border-radius: 4px;
        color: #000;
        text-decoration: none;
    }

    .pagination li a:hover {
        background-color: #ddd;
    }
</style>
