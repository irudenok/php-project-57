<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />

        <title>Менеджер задач</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-container">
                    <a href="{{ url('/') }}" class="nav-logo">
                        <span>Менеджер задач</span>
                    </a>

                    <div class="nav-links">
                        <ul>
                            <li>
                                <a href="{{ route('tasks.index') }}">Задачи</a>
                            </li>
                            <li>
                                <a href="{{ route('task_statuses.index') }}">Статусы</a>
                            </li>
                            <li>
                                <a href="{{ route('labels.index') }}">Метки</a>
                            </li>
                        </ul>
                    </div>

                    <div class="nav-actions">
                        @auth
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit">
                                    Выход
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}">
                                Вход
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    Регистрация
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <section class="hero-section">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Привет от Хекслета!
                    </h1>
                    <p class="hero-description">
                        Это простой менеджер задач на Laravel
                    </p>
                    <div class="button-group">
                        <a href="https://hexlet.io" class="hero-button" id="click-me-button" target="_blank">
                            Нажми меня
                        </a>
                    </div>
                </div>
            </section>
            </main>
    </body>
</html>
