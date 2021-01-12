<?php

namespace App\Contracts\Task;

interface CreatesTaskInformation
{
    /**
     * Validate and update the given region's information.
     *
     * @param  array  $input
     * @return void
     */
    public function create(array $input);
}
