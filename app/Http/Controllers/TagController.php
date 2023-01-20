<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tag;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{
    public function index()
    {
        return Inertia::render('Tags/Index', [
            'tags' => Tag::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Tags/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);

        $validated = new Tag();
        $validated->name = $request->name;

        $validated->save();

        return Redirect::Route('dashboard');
    }

    public function show($id)
    {
        return Inertia::render('Tags/Show', [
            'tag' => Tag::FindOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Tags/Edit', [
            'id' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);

        $validated = Tag::FindOrFail($id);
        $validated->name = $request->name;

        $validated->update();

        return Redirect::Route('dashboard');
    }

    public function destroy(Request $request, $id)
    {
        $request->validate([

        ]);

        $tag = Tag::FindOrFail($id);
        $tag->destroy($id);

        return Redirect::Route('tag.index');
    }
}
