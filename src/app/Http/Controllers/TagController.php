<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tags::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255|unique:tags,name'
        ]);
        Tags::create([
            'name'=>$request->name,
        ]);
        return redirect()->route('tags.index')->with('success', 'Тег успішно створено');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tags $tag)
    {
        return view('tags.show', $tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $tag)
    {
        return view('tags.ed', $tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tags $tags )
    {
        $request->validate([
            'name'=>'required|string|max:255|unique:tags,name' . $tags->id,
        ]);
        $tags->update([
            'name'=>$request->name
        ]);
        return redirect()->route('tags.index')->with('success', 'Тег успішно оновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tags $tags)
    {
        $tags->delete();
        return redirect()->route('tags.index')->with('success', 'Таг успішно видалено');
    }
}
