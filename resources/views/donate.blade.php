@extends('layout')

@section('title')Приєднатися до збору@endsection

@section('main_content')
    {{--<h1>Доєднатися до збору "{{ $don->title }}"</h1>--}}
    @section('theme')Доєднатися до збору "{{ $don->title }}"@endsection
    <br>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="alert alert-warning">
        <form method="post" action="/donated/{{ $don->id }}">
            @csrf
            {{--<input type="text" name="name" id="name" placeholder="Введіть ваше ім'я" class="form-control"><br>
            <input type="number" name="donate_amount" id="donate_amount" placeholder="Введіть суму донату" class="form-control"><br>
            <button type="submit" class="btn btn-success">Підтвердити</button>
            --}}
            <div>
                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">
                    Введіть ваше ім`я
                </label>
                <br>
                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" style="width: 100%;" id="name" type="text" name="name" autofocus="autofocus"> {{--required="required" autofocus="autofocus" autocomplete="username">--}}
            </div>
            <br>
            <div>
                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">
                    Введіть суму внеску
                </label>
                <br>
                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" style="width: 100%;" id="donate_amount" type="number" name="donate_amount" autofocus="autofocus"> {{--required="required" autofocus="autofocus" autocomplete="username">--}}
            </div>
            <br>
            <div class="flex items-center justify-start mt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                    Додати внесок
                </button>
            </div>
        </form>
    </div>
        </div>
    </div>
@endsection
