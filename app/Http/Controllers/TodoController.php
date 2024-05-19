<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Todo::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->update([
            'is_completed' => $request->is_completed ? true : false,
        ]);

        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->back();
    }
}
