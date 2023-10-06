<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::paginate(10);
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
        $data = $request->all();
        Task::create($data);
        return response()->json(['message' => 'Task created successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Task::where('id', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
        //return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if($id) {
            $task = Task::findOrFail($id);
            $data = $request->all();
            $task->update($data);
            return response()->json(['message' => 'Task updated successfully'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Task::where('id', $id)->delete();
    }
}
