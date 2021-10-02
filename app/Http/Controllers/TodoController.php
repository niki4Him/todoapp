<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $todo_lists = auth()->user()->todos()->latest()->get();
        return response()->json(['todo_lists' => $todo_lists], 201);
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $todo = new Todo();
        return view('todos.create', compact('todo'));
    }


    /**
     * @param TodoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TodoRequest $request)
    {
        auth()->user()->todos()->create($request->all());
        flash('Successfully created to do list!')->success();
        return redirect()->route('home');
    }


    /**
     * @param Todo $todo
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function show(Todo $todo, Request $request)
    {
        $user_id = auth()->check() ? auth()->id() : 0;
        if ($request->wantsJson()) {
            $items = $todo->items()->latest()->get();
            return response()->json(['items' => $items], 201);
        }
        return view('todos.show', compact('todo', 'user_id'));
    }
}
