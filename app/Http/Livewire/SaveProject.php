<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SaveProject extends Component
{

    use AuthorizesRequests;
    public $project;
    public $tasks = [];
    public $isEdit = false;

    protected $rules = [
        'project.name' => 'required|string|min:4',
        'tasks.*.title' => 'required|min:10',
        'tasks.*.priority' => 'required'
    ];

    protected $messages = [
        'tasks.*.title.required' => 'Task cannot be empty.',
        'tasks.*.title.min' => 'Task must be at least 10 chars.',
        'tasks.*.priority.required' => 'Please select Priority.',
    ];

    public function mount( $id = null) 
    {
        if( !is_null ($id)) {
            $this->project = Project::find($id);
            $this->authorize('update', $this->project);
            $this->isEdit = true;
            $this->tasks = array_map(function ($t) {
                return Arr::only($t, ['id', 'priority', 'title']);
            }, $this->project->tasks->toArray());
        } else {
            $this->project = new Project();
        }
    }

    public function addTask()
    {
        if (!$this->canAddMoreTasks()) {
            return;
        }
        $this->tasks[] = ['title' => '', 'priority' => '', 'id' => ''];
    }

    public function deleteTask($i)
    {
        unset($this->tasks[$i]);
        $this->resetValidation('tasks.'. $i . '.title');
        $this->resetValidation('tasks.'. $i . '.priority');
        $this->tasks = array_values($this->tasks);
    }

    public function canAddMoreTasks()
    {
        return count($this->tasks) < 5;
    }

    public function saveProjectAndTasks()
    {
        $this->validate();
        auth()->user()->projects()->save($this->project);

        if ($this->isEdit) {
            $allIds = $this->project->tasks->pluck('id')->all();
            if (!empty($allIds)) {
                $passedIds = Arr::pluck($this->tasks, 'id');
                $toDelete = array_diff($allIds, $passedIds);
                if (!empty($toDelete)) {
                    Task::destroy($toDelete);
                }
            }
        }

        foreach ($this->tasks as $t) {
            if (isset($t['id']) && $t['id'] > 0) {
                $task = Task::find($t['id']);
                $task->title = $t['title'];
                $task->priority = $t['priority'];
                $task->save();
            } else {
                $task = new Task(['title' => $t['title'], 'priority' => $t['priority']]);
                $this->project->tasks()->save($task);
            }
        }
        return redirect()->route('projects');
    }

    public function render()
    {
        return view('livewire.projects.save-project')
            ->layout('layouts.app', [
                'header' => $this->isEdit ? 'Edit Project' : 'Add Project'
            ]);;
    }
}
