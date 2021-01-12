<?php


namespace App\Actions\Task;


use App\Contracts\Task\DeletesTask;

class deleteTask implements DeletesTask
{
 public function delete($task){

     $task->delete();
 }
}
