<?php


namespace App\Actions\Level;


use App\Contracts\Level\UpdatesLevel;
use Illuminate\Support\Facades\Validator;

class UpdateLevel implements UpdatesLevel
{

    public function update($level, array $input)
    {
        Validator::make($input, [
            'title' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateTaskInformation');

        $level->fill([
            'title' => $input['title'],
        ])->save();
    }
}
