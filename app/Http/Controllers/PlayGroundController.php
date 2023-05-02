<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Defect;
use Illuminate\Http\Request;

class PlayGroundController extends Controller
{
    //

    public function index()
    {
        // dd(Defect::getDescriptionWhereByGroupAndTitle('重大缺失', '食材過期')->pluck('description', 'id'));
        dd(Task::find(1)->restaurant->restaurantWorkspaces->pluck('area', 'id')->toArray());
    }
}
