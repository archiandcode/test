<?php

namespace App\Http\Controllers;

use App\Http\Requests\KnifeTypeRequest;
use App\Models\KnifeType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KnifeTypeController extends Controller
{
    public function index(): View
    {
        $types = KnifeType::all();
        return view('admin.knifeTypes.index', compact('types'));
    }

    public function create(): View
    {
        return view('admin.knifeTypes.create');
    }

    public function store(KnifeTypeRequest $request): RedirectResponse
    {
        KnifeType::create($request->validated());
        return redirect()->route('knife-types.index')->with('success', 'Тип добавлен');
    }

    public function edit(KnifeType $knifeType): View
    {
        return view('admin.knifeTypes.edit', compact('knifeType'));
    }

    public function update(KnifeTypeRequest $request, KnifeType $knifeType): RedirectResponse
    {
        $knifeType->update($request->validated());
        return redirect()->route('knife-types.index')->with('success', 'Тип обновлён');
    }

    public function destroy(KnifeType $knifeType): RedirectResponse
    {
        $knifeType->delete();
        return back()->with('success', 'Тип удалён');
    }
}
