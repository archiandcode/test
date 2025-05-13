<?php

namespace App\Http\Controllers;

use App\Http\Requests\KnifeTypeRequest;
use App\Models\KnifeType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class KnifeTypeController extends Controller
{
    public function index(): View
    {
        Gate::authorize('menu-admin');

        $types = KnifeType::all();
        return view('admin.knifeTypes.index', compact('types'));
    }

    public function create(): View
    {
        Gate::authorize('menu-admin');

        return view('admin.knifeTypes.create');
    }

    public function store(KnifeTypeRequest $request): RedirectResponse
    {
        Gate::authorize('menu-admin');

        KnifeType::create($request->validated());
        return redirect()->route('knife-types.index')->with('success', 'Тип добавлен');
    }

    public function edit(KnifeType $knifeType): View
    {
        Gate::authorize('menu-admin');

        return view('admin.knifeTypes.edit', compact('knifeType'));
    }

    public function update(KnifeTypeRequest $request, KnifeType $knifeType): RedirectResponse
    {
        Gate::authorize('menu-admin');

        $knifeType->update($request->validated());
        return redirect()->route('knife-types.index')->with('success', 'Тип обновлён');
    }

    public function destroy(KnifeType $knifeType): RedirectResponse
    {
        Gate::authorize('menu-admin');

        $knifeType->delete();
        return back()->with('success', 'Тип удалён');
    }
}
