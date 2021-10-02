<?php

namespace App\Observers;

use App\Models\Todo;
use Illuminate\Support\Str;

class TodoObserver
{
    /**
     * Handle the Todo "creating" event.
     *
     * @param  \App\Models\Todo  $todo
     */
    public function creating(Todo $todo)
    {
        $this->slugOperation($todo);
    }

    /**
     * Handle the Todo "updating" event.
     *
     * @param  \App\Models\Todo  $todo
     */
    public function updating(Todo $todo)
    {
        if ($todo->isDirty('title')) {
            $this->slugOperation($todo);
        }
    }

    /**
     * @param Todo $todo
     */
    protected function slugOperation(Todo $todo): void
    {
        $slug = Str::of($todo->title)->slug();
        $count = 2;
        $updatedSlug = $slug;
        while (Todo::whereSlug($updatedSlug)->exists()) {
            $updatedSlug = "{$slug}-" . $count++;
        }
        $todo->slug = $updatedSlug;
    }
}
