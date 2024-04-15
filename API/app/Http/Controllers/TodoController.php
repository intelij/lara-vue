<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\TodoValidationRequest;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(Todo $todoService)
    {
        $this->todoService = $todoService;
    }

    public function all()
    {
        $todos = $this->todoService->getAllTodos();
        return response()->json(['todos' => $todos], Response::HTTP_OK);
    }

    public function index()
    {
        $user = Auth::user();
        $todos = $user->todos;
        return response()->json(['todos' => $todos], Response::HTTP_OK);
    }

    public function show($id)
    {
        $todo = $this->todoService->findTodoById($id);

        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($todo);
    }

    public function store(TodoValidationRequest $request)
    {
        $user = Auth::user();
        $todo = $user->todos()->create($request->validated());

        return response()->json(['message' => 'Todo created successfully', 'todo' => $todo], Response::HTTP_CREATED);
    }

    public function update(TodoValidationRequest $request, $id)
    {
        $todo = $this->todoService->findTodoById($id);

        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], Response::HTTP_NOT_FOUND);
        }

        $todo->update($request->validated());
        return response()->json($todo, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $todo = $this->todoService->findTodoById($id);

        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], Response::HTTP_NOT_FOUND);
        }

        $todo->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
