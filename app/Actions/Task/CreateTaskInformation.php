<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        ])->validateWithBag('createTaskInformation');

        $task = new Task();

        return $task->create([
            'description' => $input['description'],
        ]);

    }
}
