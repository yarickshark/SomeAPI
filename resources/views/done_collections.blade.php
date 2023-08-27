@extends('layout')

@section('title')Актуальні збори@endsection

@section('main_content')
    {{--<h1>Закриті збори</h1>--}}
    @section('theme')Закриті збори:@endsection
    @foreach($filteredCollections as $el)
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="alert alert-warning">
            <h3>Призначення: {{ $el['collection']->title }}</h3>
            <p1>Номер збору: {{ $el['collection']->id }}</p1><br>
            <p>Опис: {{ $el['collection']->description }}</p>
            <b>Необхідна сума: {{ $el['collection']->target_amount }} гривень</b><br><br>
            <b1>Зібрано: {{ $el['cont'] }}</b1><br><br>
            <b2>Дата створення: {{ $el['collection']->created_at }}</b2><br><br>
            <form method="get" action="{{ $el['collection']->link }}">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                    Посилання на збір
                </button>
            </form><br>
            <form method="get" action="/collection/{{$el['collection']->id}}">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                    Деталі
                </button>
            </form><br>
        </div>
            </div>
        </div><br>
    @endforeach
@endsection
