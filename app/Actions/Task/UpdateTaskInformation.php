<?php

namespace App\Actions\Task;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Contracts\Task\UpdatesTaskInformation;

class UpdateTaskInformation implements UpdatesTaskInformation
{
    /**
     * Validate and update the given region's information.
     *
     * @param  mixed  $task
     * @param  array  $input
     * @return void
     */
    public function update($task, array $input)
    {
        Validator::make($input, [
            'description' => ['required', 'string', 'max:255'],
            'level_id'=>['required', 'integer'],

        ])->validateWithBag('updateTaskInformation');

        $task->fill([
            'description' => $input['description'],
            'level_id' => $input['level_id'],
        ])->save();
    }
}
