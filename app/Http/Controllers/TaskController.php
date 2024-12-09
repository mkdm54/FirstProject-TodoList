<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'todo_tasks' => 'required|string|min:3|max:255',
        ]);

        Task::create([
            'todo_tasks' => $request->todo_tasks,
        ]);

        return redirect()->route('index.index')->with('success', 'Tasks berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Task::find($id);
        if(!$data){
            return redirect()->route('index.index')->with('error', 'tugas tidak ditemukan');
        }
        return view('editData.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'todo_tasks' => 'required|string|min:5|max:255',
        ]);

        $task->update([
            'todo_tasks' => $request->todo_tasks,
        ]);

        return redirect()->route('index.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            // Jika terjadi kesalahan, mengirimkan response JSON dengan status error
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus tugas.']);
        }
    }
}
