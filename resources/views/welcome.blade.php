<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.26/dist/css/uikit.min.css" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="">
        @if (Route::has('login'))
            <div class="">

            </div>
        @endif

        <div class="">
            <div class="">

            </div>

            <div class="">
                <div class="">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="uk-text-center uk-margin-large-top">
                                <h3>{{ config('app.name') }}</h3>
                            </div>
                        </div>

                        <div class="ml-12">
                            <div class="uk-text-center">
                                @auth
                                    <a href="{{ url('/home') }}"
                                        class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                                @else
                                    <a href="{{ route('login') }}" class="uk-button uk-button-primary">ログイン</a>
                                @endauth
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</body>

</html>
