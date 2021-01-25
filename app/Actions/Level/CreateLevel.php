<?php


namespace App\Actions\Level;


use App\Contracts\Level\CreatesLevel;
use App\Models\Level;
use Illuminate\Support\Facades\Validator;

class CreateLevel implements CreatesLevel
{

    public function create(array $input)
    {
        Validator::make($input, [
            'title' => ['required', 'string', 'max:255'],



        ])->validateWithBag('createLevel');

        $level = new Level();

        return $level->create([
            'title' => $input['title'],
        ]);
    }
}
