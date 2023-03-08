<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $data = Todo::get();
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

    public function store(TodoRequest $request)
    {
        try {
            Todo::create($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Todo Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(TodoRequest $request,Todo $todo)
    {
        try {
            $todo->update($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Todo Updated Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(Todo $todo)
    {
        if ($todo->delete() == true) {
            return response()->json([
                'status' => true,
                'message' => 'Todo Deleted Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
            ], 200);
        }
    }
}
