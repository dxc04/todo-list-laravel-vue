<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Todo;
use App\Enums\TodoStatus;

class TodoTest extends TestCase
{
    /**
     * Test if todo NEW status is saved correctly.
     *
     * @return void
     */
    public function testTodoNewStatusWasSavedCorrectly()
    {
        $user = User::factory();
        // NEW status
        $todo_new = Todo::factory()
            ->for($user)
            ->create([
                'status' => TodoStatus::NEW()
            ]);
        $this->assertEquals('NEW', $todo_new->status);
    }

    /**
     * Test if todo DONE status is saved correctly.
     *
     * @return void
     */
    public function testTodoDoneStatusWasSavedCorrectly()
    {
        $user = User::factory();
        // NEW status
        $todo_new = Todo::factory()
            ->for($user)
            ->create([
                'status' => TodoStatus::NEW()
            ]);
        $this->assertEquals('NEW', $todo_new->status);
    }

    /**
     * Test if todo UNDONE status is saved correctly.
     *
     * @return void
     */
    public function testTodoUndoneStatusWasSavedCorrectly()
    {
        $user = User::factory();
        // UNDONE status
        $todo_undone = Todo::factory()
            ->for($user)
            ->create([
                'status' => TodoStatus::UNDONE()
            ]);
        $this->assertEquals('UNDONE', $todo_undone->status);
    }
}
