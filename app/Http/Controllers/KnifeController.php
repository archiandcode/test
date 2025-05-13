<?php

namespace App\Http\Controllers;

use App\Http\Requests\KnifeRequest;
use App\Models\Knife;
use App\Models\KnifeType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class KnifeController extends Controller
{
    public function index(): View
    {
        Gate::authorize('menu-admin');

        $knives = Knife::with('knifeType')->get();
        return view('admin.knives.index', compact('knives'));
    }

    public function show(Knife $knife): View
    {
        Gate::authorize('menu-admin');

        $knife->load('knifeType');
        return view('admin.knives.show', compact('knife'));
    }

    public function create(): View
    {
        Gate::authorize('menu-admin');

        $types = KnifeType::all();
        return view('admin.knives.create', compact('types'));
    }

    public function store(KnifeRequest $request): RedirectResponse
    {
        Gate::authorize('menu-admin');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('knives', 'public');
        }

        Knife::create($data);

        return redirect()->route('knives.index')->with('success', 'Нож добавлен');
    }

    public function edit(Knife $knife): View
    {
        Gate::authorize('menu-admin');

        $types = KnifeType::all();
        return view('admin.knives.edit', compact('knife', 'types'));
    }

    public function update(KnifeRequest $request, Knife $knife): RedirectResponse
    {
        Gate::authorize('menu-admin');

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($knife->image) {
                Storage::disk('public')->delete($knife->image);
            }

            $data['image'] = $request->file('image')->store('knives', 'public');
        }

        $knife->update($data);

        return redirect()->route('knives.index')->with('success', 'Нож обновлён');
    }

    public function destroy(Knife $knife): RedirectResponse
    {
        Gate::authorize('menu-admin');

        if ($knife->image) {
            Storage::disk('public')->delete($knife->image);
        }

        $knife->delete();
        return back()->with('success', 'Нож удалён');
    }
}
