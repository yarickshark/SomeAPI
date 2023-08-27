<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Керування') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-black-100">
                    <form action="{{ url('/') }}" method="GET">
                        <div class="p-1 text-gray-900 dark:text-gray-100">
                            <label for="sort_by">Сортування за зібраною сумою:</label>
                        </div><br>
                        <select name="sort_by" id="sort_by">
                            <option value="asc">По зростанню</option>
                            <option value="desc">По зменшенню</option>
                        </select><br><br>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                            Сортувати
                        </button>
                    </form>
                </div>
            </div><br>
            @foreach($coll as $el)
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

                            <form method="get" action="/collection_edit/{{$el['collection']->id}}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                                    Редагувати збір
                                </button>
                            </form><br>
                            <form method="get" action="/contr_edit/{{$el['collection']->id}}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                                    Редагувати внески
                                </button>
                            </form><br>
                            <form action="/collection/{{$el['collection']->id}}/delete" method="DELETE">
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
        </div>
    </div>
</x-app-layout>
