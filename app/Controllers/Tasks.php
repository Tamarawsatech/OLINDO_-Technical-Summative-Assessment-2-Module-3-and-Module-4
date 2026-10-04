<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tasks extends BaseController
{
    public function index(): string
    {
        return view('tasks/index', ['tasks' => (new TaskModel())->getAllTasks()]);
    }

    private function taskRules(): array
    {
        return [
            'title'     => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status'    => 'permit_empty|in_list[pending,in_progress,completed]',
        ];
    }

    private function formData(?array $task = null): array
    {
        return [
            'title'     => old('title', $task['title'] ?? ''),
            'status'    => old('status', $task['status'] ?? 'pending'),
            'task_date' => old('task_date', $task['task_date'] ?? ''),
        ];
    }

    public function newTask(): string
    {
        return view('tasks/form', [
            'pageTitle' => 'New Task',
            'heading'   => 'Create New Task',
            'action'    => site_url('tasks/create'),
            'task'      => $this->formData(),
            'errors'    => [],
        ]);
    }

    public function create(): RedirectResponse|string
    {
        $validation = service('validation');
        if (! $this->validate($this->taskRules())) {
            return view('tasks/form', [
                'pageTitle' => 'New Task',
                'heading'   => 'Create New Task',
                'action'    => site_url('tasks/create'),
                'task'      => $this->formData(),
                'errors'    => $validation->getErrors(),
            ]);
        }

        (new TaskModel())->insert([
            'title'       => trim((string) $this->request->getPost('title')),
            'status'      => $this->request->getPost('status') ?: 'pending',
            'task_date'   => $this->request->getPost('task_date'),
            'created_at'  => date('Y-m-d H:i:s'),
            'is_archived' => 0,
        ]);

        return redirect()->to(site_url('tasks'))->with('success', 'Task created successfully.');
    }

    public function edit(int $id): string
    {
        $task = (new TaskModel())->getActiveTask($id);
        if ($task === null) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        return view('tasks/form', [
            'pageTitle' => 'Edit Task',
            'heading'   => 'Edit Task',
            'action'    => site_url('tasks/update/' . $id),
            'task'      => $this->formData($task),
            'errors'    => [],
        ]);
    }

    public function update(int $id): RedirectResponse|string
    {
        $model = new TaskModel();
        $existing = $model->getActiveTask($id);
        if ($existing === null) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        $validation = service('validation');
        if (! $this->validate($this->taskRules())) {
            return view('tasks/form', [
                'pageTitle' => 'Edit Task',
                'heading'   => 'Edit Task',
                'action'    => site_url('tasks/update/' . $id),
                'task'      => $this->formData($existing),
                'errors'    => $validation->getErrors(),
            ]);
        }

        $model->update($id, [
            'title'     => trim((string) $this->request->getPost('title')),
            'status'    => $this->request->getPost('status') ?: 'pending',
            'task_date' => $this->request->getPost('task_date'),
        ]);

        return redirect()->to(site_url('tasks'))->with('success', 'Task updated successfully.');
    }

    public function archive(int $id): RedirectResponse
    {
        $model = new TaskModel();
        if ($model->getActiveTask($id) === null) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        $model->archive($id);
        return redirect()->to(site_url('tasks'))->with('success', 'Task archived successfully.');
    }
}
