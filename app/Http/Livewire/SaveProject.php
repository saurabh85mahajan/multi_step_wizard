<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class SaveProject extends Component
{

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
            $this->isEdit = true;
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
        $this->resetErrorBag();
    }

    public function deleteTask($i)
    {
        unset($this->tasks[$i]);
    }

    public function canAddMoreTasks()
    {
        return count($this->tasks) < 5;
    }

    public function saveProject()
    {
        $this->validate();
        auth()->user()->projects()->save($this->project);

        // if ($this->isEdit) {
        //     $allIds = $this->project->tasks->pluck('id')->all();
        //     if (!empty($allIds)) {
        //         $passedIds = Arr::pluck($this->tasks, 'id');
        //         $toDelete = array_diff($allIds, $passedIds);
        //         if (!empty($toDelete)) {
        //             Task::destroy($toDelete);
        //         }
        //     }
        // }

        // foreach ($this->tasks as $t) {
        //     if (isset($t['id']) && $t['id'] > 0) {
        //         $task = Task::find($t['id']);
        //         $task->title = $t['title'];
        //         $task->priority = $t['priority'];
        //         $task->save();
        //     } else {
        //         $task = new Task(['title' => $t['title'], 'priority' => $t['priority']]);
        //         $this->project->tasks()->save($task);
        //     }
        // }
        // // $this->project->tasks()->saveMany($this->tasks);
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
