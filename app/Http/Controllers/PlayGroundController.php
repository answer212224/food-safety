<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class PlayGroundController extends Controller
{
    //

    public function index()
    {
        $record = request()->route()->parameter('record');

        $task = Task::find($record)->load('restaurant.restaurant_workspaces');

        dd($task->restaurant->restaurant_workspaces->pluck('area'));
    }
}
