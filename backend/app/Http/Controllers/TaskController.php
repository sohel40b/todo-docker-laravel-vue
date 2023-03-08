<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $data = Task::join('todos','todos.id','=','tasks.todo_id')->get();
        if ($data->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'Data found',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
            ], 200);
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            Task::create($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Task Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(TaskRequest $request,Task $task)
    {
        try {
            $task->update($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Task Updated Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(Task $task)
    {
        if ($task->delete() == true) {
            return response()->json([
                'status' => true,
                'message' => 'Task Deleted Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
            ], 200);
        }
    }
}
