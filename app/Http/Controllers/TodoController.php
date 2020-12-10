<?php

namespace App\Http\Controllers;

use App\Enums\TodoStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        Todo::firstOrCreate($request->all() + [
            'user_id' => $user->id,
            'status' => TodoStatus::NEW()
        ]);
        return Redirect::route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Todo::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->all());

        return Redirect::route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Todo::findOrFail($id)->delete();
        return Redirect::route('home');
    }

    /**
     * Renders home page
     *
     * @return InertiaResponse
     */
    public function home(): InertiaResponse
    {
        $user = Auth::user();
        return Inertia::render('Home', ['todos' => $user->todos]);
    }

    /**
     * Renders home page
     *
     * @return InertiaResponse
     */
    public function burndown(): InertiaResponse
    {
        $user = Auth::user();
        return Inertia::render('Burndown', ['burndownData' => Todo::burndownData($user)]);
    }
}
