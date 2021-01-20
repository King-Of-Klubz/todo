<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateTaskInformation;
use App\Actions\Task\UpdateTaskInformation;
use App\Actions\Task\DeleteTask;
use App\Http\Resources\LevelResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use phpDocumentor\Reflection\Types\Collection;

class TasksController extends Controller
{

    public function index()
    {
        $task = DB::table('tasks')
            ->join('levels','levels.id','=','tasks.level_id')
            ->select('*')->get();

        return Inertia::render('Tasks/Index', [
            'tasks' => TaskResource::collection($task),
            'levels' => LevelResource::collection(Level::all()),
        ]);

    }

    public function create()
    {
        //
        return Inertia::render('Tasks/Create', [
            'task' => null,

        ]);
    }

    public function store(Request $request)
    {
        //
        app(CreateTaskInformation::class)->create($request->all());

        return back(303);
    }

    public function mDone(Task $item)
    {
        $item->status = true;
        $item->save();
    }

    public function mToDo(Task $item)
    {
        $item->status = false;
        $item->save();
    }
    public function show(Task $task)
    {
        //
        return Inertia::render('Tasks/Show', [
            'task' => $task->toResource(),
        ]);
    }


    public function edit(Task $task)
    {
        //
    }


    public function update(Request $request, Task $task)
    {
        app(UpdateTaskInformation::class)->update($task, $request->all());

        return back(303);
    }


    public function destroy(Request $request, Task $task)
    {
        //
        app(DeleteTask::class)->delete($task);

        return back(303);
    }
}
