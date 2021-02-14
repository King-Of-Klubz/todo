<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateTaskInformation;
use App\Actions\Task\UpdateTaskInformation;
use App\Actions\Task\DeleteTaskInformation;
use App\Http\Resources\LevelResource;
use App\Http\Resources\TaskResource;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;

class TasksController extends Controller
{

    public function index():Response
    {
        return Inertia::render('Tasks/Index', [
            'tasks' => TaskResource::collection( Task::all()),
            'levels' => LevelResource::collection(Level::all()),
        ]);

    }

    public function create():Response
    {
        //
        return Inertia::render('Tasks/Create', [
            'task' => null,

        ]);
    }

    public function store(Request $request)
    {
        app(CreateTaskInformation::class)->create($request->all());

        return back(303);
    }

    public function show(Task $task):Response
    {
        return Inertia::render('Tasks/Show', [
            'task' => $task->toResource(),
        ]);
    }



    public function update(Request $request, Task $task)
    {
        app(UpdateTaskInformation::class)->update($task, $request->all());

        return back(303);
    }


    public function destroy(Request $request, Task $task)
    {
        app(DeleteTaskInformation::class)->delete($task);

        return back(303);
    }
}
