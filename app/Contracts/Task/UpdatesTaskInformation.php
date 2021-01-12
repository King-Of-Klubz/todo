<?php

namespace App\Contracts\Task;

interface UpdatesTaskInformation
{
    /**
     * Validate and update the given region's information.
     *
     * @param  mixed  $task
     * @param  array  $input
     * @return void
     */
    public function update($task, array $input);
}
