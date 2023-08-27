<?php

namespace App\Http\Controllers;

use App\Models\collections;
use App\Models\contributors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function __construct()
    {
        // Этот middleware будет применяться только к методу, требующему аутентификации
        $this->middleware('auth')->only('about');

    }

    public function dashboard(Request $request)
    {
        $collections = Collections::all();
        $coll = [];

        foreach ($collections as $collection) {
            $cont = Contributors::where('collection_id', $collection->id)->sum('amount');
            $coll[] = [
                'collection' => $collection,
                'cont' => $cont,
            ];
        }

        // Преобразование массива в коллекцию
        $collCollection = collect($coll);

        // Фильтрация
        $filterValue = $request->input('filter_value', null);

        if (!is_null($filterValue)) {
            $collCollection = $collCollection->where('cont', $filterValue);
        }

        // Сортировка
        $sortBy = $request->input('sort_by', 'asc');

        $collCollection = $collCollection->sortBy('cont', SORT_REGULAR, $sortBy === 'desc');

        // Преобразование коллекции обратно в массив
        $coll = $collCollection->all();

        return view('dashboard', ['coll' => $coll]);
        }

    public function main(Request $request)
    {
        $collections = Collections::all();
        $coll = [];

        foreach ($collections as $collection) {
            $cont = Contributors::where('collection_id', $collection->id)->sum('amount');
            $coll[] = [
                'collection' => $collection,
                'cont' => $cont,
            ];
        }

        // Преобразование массива в коллекцию
        $collCollection = collect($coll);

        // Фильтрация
        $filterValue = $request->input('filter_value', null);

        if (!is_null($filterValue)) {
            $collCollection = $collCollection->where('cont', $filterValue);
        }

        // Сортировка
        $sortBy = $request->input('sort_by', 'asc');

        $collCollection = $collCollection->sortBy('cont', SORT_REGULAR, $sortBy === 'desc');

        // Преобразование коллекции обратно в массив
        $coll = $collCollection->all();

        return view('main', ['coll' => $coll]);
    }

    public function about() {
        return view('about');
    }
    public function current_collections(Request $request) {
        $collections = Collections::all();
        $filteredCollections = [];
        foreach ($collections as $collection) {
            $cont = Contributors::where('collection_id', $collection->id)->sum('amount');
            if ($collection->target_amount > $cont) {
                $filteredCollections[] = [
                    'collection' => $collection,
                    'cont' => $cont,
                ];
            }
        }

        // Преобразование массива в коллекцию
        $collCollection = collect($filteredCollections);

        // Фильтрация
        $filterValue = $request->input('filter_value', null);

        if (!is_null($filterValue)) {
            $collCollection = $collCollection->where('cont', $filterValue);
        }

        // Сортировка
        $sortBy = $request->input('sort_by', 'asc');

        $collCollection = $collCollection->sortBy('cont', SORT_REGULAR, $sortBy === 'desc');

        // Преобразование коллекции обратно в массив
        $filteredCollections = $collCollection->all();

        return view('current_collections', ['filteredCollections' => $filteredCollections]);
    }

    public function done_collections() {
        $collections = Collections::all();
        $filteredCollections = [];
        foreach ($collections as $collection) {
            $cont = Contributors::where('collection_id', $collection->id)->sum('amount');
            if ($collection->target_amount <= $cont) {
                $filteredCollections[] = [
                    'collection' => $collection,
                    'cont' => $cont,
                ];
            }
        }

        return view('done_collections', ['filteredCollections' => $filteredCollections]);

    }

    public function current_collection_check(Request $request) {
        $valid = $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:10|max:500',
            'target_amount' => 'required|min:3|max:20',
            'link' => 'required|min:10|max:500'
        ]);

        $current_collections = new collections();
        $current_collections->title = $request->input('title');
        $current_collections->description = $request->input('description');
        $current_collections->target_amount = $request->input('target_amount');
        $current_collections->link = $request->input('link');

        $current_collections->save();

        return redirect()->route('current_collections');
    }

    public function collection($id) {
        //$cont = contributors::where('collection_id', $id)->sum('amount');
        $cont = contributors::where('collection_id', $id)->get();
        $don = collections::find($id);
        if (!$don) {
            abort(404);
        }
        $totalAmount = $cont->sum('amount');
        return view('collection', compact('don', 'cont', 'totalAmount'));
    }

    public function donate_edit($id) {
        $contributor = contributors::where('id', $id)->first();
        return view('donate_edit', compact( 'contributor'));
    }

    public function donate_update(Request $request, $id)
    {
        $dataToUpdate = [];

        $name = $request->input('user_name');
        $amount = $request->input('amount');

        if (!is_null($name)) {
            $dataToUpdate['user_name'] = $name;
        }

        if (!is_null($amount)) {
            $dataToUpdate['amount'] = $amount;
        }

        if (!empty($dataToUpdate)) {
            DB::table('contributors')
                ->where('id', $id)
                ->update($dataToUpdate);
        }

        return redirect()->route('donate_edit', ['id' => $id])
            ->with('success', 'Внесок відредаговано');
    }
    public function collection_edit($id) {
        $cont = contributors::where('collection_id', $id)->get();
        $collection = collections::find($id);
        if (!$collection) {
            abort(404);
        }
        $totalAmount = $cont->sum('amount');
        return view('collection_edit', compact('collection', 'cont', 'totalAmount'));
    }
    public function edit($id)
    {
        $collection = collections::find($id);
        return view('collection_edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $dataToUpdate = [];

        $title = $request->input('title');
        $description = $request->input('description');
        $targetAmount = $request->input('target_amount');
        $link = $request->input('link');

        if (!is_null($title)) {
            $dataToUpdate['title'] = $title;
        }

        if (!is_null($description)) {
            $dataToUpdate['description'] = $description;
        }

        if (!is_null($targetAmount)) {
            $dataToUpdate['target_amount'] = $targetAmount;
        }

        if (!is_null($link)) {
            $dataToUpdate['link'] = $link;
        }

        if (!empty($dataToUpdate)) {
            DB::table('collections')
                ->where('id', $id)
                ->update($dataToUpdate);
        }
        return redirect()->route('collection.edit', ['id' => $id])
            ->with('success', 'Збір відредаговано');
    }

    public function contr_edit($id)
    {
        $cont = contributors::where('collection_id', $id)->get();
        $don = collections::find($id);
        if (!$don) {
            abort(404);
        }
        $totalAmount = $cont->sum('amount');
        return view('contr_edit', compact('don', 'cont', 'totalAmount'));
    }

    public function donate($id) {
        $don = collections::find($id);
        if (!$don) {
            abort(404);
        }
        return view('donate', compact('don'));
    }

    public function donated($id, Request $request) {
        $cont = contributors::where('collection_id', $id)->get();

        $don = collections::find($id);
        if (!$don) {
            abort(404);
        }
        $valid = $request->validate([
            'name' => 'required|min:3|max:100',
            'donate_amount' => 'required|min:1|max:20',
        ]);

        $donate = new contributors();
        $donate->collection_id = $don->id;
        $donate->user_name = $request->input('name');
        $donate->amount = $request->input('donate_amount');

        $donate->save();

        $totalAmount = contributors::where('collection_id', $id)->sum('amount');
        return view('collection', compact('don', 'cont', 'totalAmount'));
    }
    public function delete($id)
    {
        // Удаление из таблицы 'contributors'
        contributors::where('collection_id', $id)->delete();

        // Удаление из таблицы 'collections'
        collections::find($id)->delete();

        return redirect()->route('dashboard')->with('success', 'Записи успешно удалены.');
    }
    public function delete_contr($id)
    {
        $cont = contributors::where('id', $id)->value('collection_id');
        // Удаление из таблицы 'contributors'
        contributors::where('id', $id)->delete();

        return redirect()->route('contr_edit', ['id' => $cont])->with('success', 'Запис видалено');
    }
}
