<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);
        Todo::create([
            'task' => $request->task,
            'deadline' => $request->deadline,
            'completed' => false,
        ]);
        return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'task' => 'required|string|max:255',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);
        $todo->update($request->only('task', 'deadline') + ['completed' => $request->has('completed')]);
        return redirect()->route('todos.index')->with('success', 'Todo updated successfully!');
    }
}
