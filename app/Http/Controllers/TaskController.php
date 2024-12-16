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
        // Validasi input
        $request->validate([
            'todo_tasks' => 'required|string|min:3|max:255|unique:tasks,todo_tasks',
        ]);

        try {
            // Proses penyimpanan data
            Task::create([
                'todo_tasks' => $request->todo_tasks,
            ]);

            // Jika berhasil, kembalikan respons sukses dalam format JSON
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan respons dengan error
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan, gagal menambahkan data.'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Task $task) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'Tugas tidak ditemukan');
        }
        return view('editData.edit', compact('task'));
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

        return redirect()->route('tasks.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return response()->json(['success' => true, 'message' => 'Tugas berhasil dihapus.'], 200);
        } catch (\Throwable $th) {
            // Jika terjadi kesalahan, mengirimkan response JSON dengan status error
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus tugas.'], 500);
        }
    }
}
