<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Task\CreatesTaskInformation;

class CreateTaskInformation implements CreatesTaskInformation
{
    /**
     * Validate and Create the given region's information.
     *
     * @param  array  $input
     * @return void
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'description' => ['required', 'string', 'max:255'],
            'level_id'=>['required', 'integer'],

        ])->validateWithBag('createTaskInformation');

        $task = new Task();

        return $task->create([
            'description' => $input['description'],
            'level_id' => $input['level_id']
        ]);

    }
}
