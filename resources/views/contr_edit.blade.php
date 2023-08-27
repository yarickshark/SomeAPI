@extends('layout')

@section('title')Редагування збору@endsection

@section('main_content')
    @section('theme')Редагування збору:@endsection
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="alert alert-warning">
                <h3>Призначення: {{ $don->title }}</h3>
                <p1>Номер збору: {{ $don->id }}</p1><br>
                <p>Опис: {{ $don->description }}</p>
                <b>Необхідна сума: {{ $don->target_amount }} гривень</b><br><br>
                <b1>Зібрано: {{$totalAmount}}</b1><br><br>
                <b2>Дата створення: {{ $don->created_at }}</b2><br><br>
                <form method="get" action="{{ $don->link }}">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                        Посилання на збір
                    </button>
                </form><br>

                <form method="get" action="/donate/{{$don->id}}">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                        Приєднатися до збору
                    </button>
                </form><br>
                <form method="get" action="/collection_edit/{{$don->id}}">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                        Редагувати збір
                    </button>
                </form><br>
            </div>
        </div>
    </div><br>
    <div class="p-6 text-gray-900 dark:text-gray-100">
        Донатери:
    </div>
    @foreach($cont as $el)
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="alert alert-warning">
                    <h3>Ім`я: {{ $el->user_name }}</h3>
                    <p1>Сума донату: {{ $el->amount }}</p1><br>
                    <b2>Дата: {{ $el->created_at }}</b2><br><br>
                    <form method="get" action="/donate_edit/{{$el->id}}">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                            Редагувати внесок
                        </button>
                    </form><br>
                    <form action="/contr/{{$el->id}}/delete" method="DELETE">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                            Видалити
                        </button>
                    </form>
                </div>
            </div>
        </div><br>
    @endforeach
@endsection
