<?php

namespace App\Http\Controllers;

use App\Http\Requests\KnifeRequest;
use App\Models\Knife;
use App\Models\KnifeType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class KnifeController extends Controller
{
    public function index(): View
    {
        $knives = Knife::with('knifeType')->get();
        return view('admin.knives.index', compact('knives'));
    }

    public function show(Knife $knife): View
    {
        $knife->load('knifeType');
        return view('admin.knives.show', compact('knife'));
    }

    public function create(): View
    {
        $types = KnifeType::all();
        return view('admin.knives.create', compact('types'));
    }

    public function store(KnifeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('knives', 'public');
        }

        Knife::create($data);

        return redirect()->route('knives.index')->with('success', 'Нож добавлен');
    }

    public function edit(Knife $knife): View
    {
        $types = KnifeType::all();
        return view('admin.knives.edit', compact('knife', 'types'));
    }

    public function update(KnifeRequest $request, Knife $knife): RedirectResponse
    {
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
        if ($knife->image) {
            Storage::disk('public')->delete($knife->image);
        }

        $knife->delete();
        return back()->with('success', 'Нож удалён');
    }
}
