<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\CompleteTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CompleteTaskRequest $request, Task $task)
    {
        if ($request->user()->cannot('update', $task)) {
            abort(403);
        }

        $task->is_completed = $request->is_completed;
        $task->save();

        return $task->toResource();
    }
}
