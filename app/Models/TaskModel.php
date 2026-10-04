<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['title', 'status', 'task_date', 'created_at', 'is_archived'];

    public function getTodayTasks(): array
    {
        return $this->where('task_date', Time::now('Asia/Manila')->toDateString())
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')->orderBy('id', 'ASC')->findAll();
    }

    public function getAllTasks(): array
    {
        return $this->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')->orderBy('id', 'ASC')->findAll();
    }

    public function getActiveTask(int $id): ?array
    {
        return $this->where('is_archived', 0)->find($id);
    }

    public function archive(int $id): bool
    {
        return $this->update($id, ['is_archived' => 1]);
    }
}
