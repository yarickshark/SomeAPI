@extends('layout')

@section('title')Змінити збір@endsection

@section('main_content')
    @section('theme')Редагування збору@endsection
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="post" action="{{ route('collection.update', $collection->id) }}">
            @csrf
                @method('PATCH')
                <div>
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">
                        Заголовок зараз: "{{ $collection->title }}"
                    </label>
                    <br>
                    <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" style="width: 100%;" id="title" type="text" name="title" autofocus="autofocus"> {{--required="required" autofocus="autofocus" autocomplete="username">--}}
                </div>
                <br>
                <div>
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">
                        Опис зараз: "{{ $collection->description }}"
                    </label>
                    <br>
                    <textarea class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" style="width: 100%; height: 150px;" id="description" name="description" autofocus="autofocus"{{-- autocomplete="username"--}}></textarea>
                </div>
                <br>
                <div>
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">
                        Кінцева сума зараз: "{{ $collection->target_amount }}"
                    </label>
                    <br>
                    <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" style="width: 100%;" id="target_amount" type="number" name="target_amount" autofocus="autofocus"{{-- autocomplete="username"--}}>
                </div>
                <br>
                <div>
                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">
                        Посилання зараз: "{{ $collection->link }}"
                    </label>
                    <br>
                    <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" style="width: 100%;" id="link" type="url" name="link" autofocus="autofocus"{{-- autocomplete="username"--}}>
                </div>
                <br>
                <div class="flex items-center justify-start mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3 bg-dark">
                        Додати
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
