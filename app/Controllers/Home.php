<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome', [
            'tasks' => (new TaskModel())->getTodayTasks(),
            'today' => Time::now('Asia/Manila')->toDateString(),
        ]);
    }
}
