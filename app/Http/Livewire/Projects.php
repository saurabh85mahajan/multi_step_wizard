<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;

class Projects extends Component
{
    use WithPagination;

    public function render()
    {
        $projects = Project::where('user_id', auth()->user()->id)->paginate();
        return view('livewire.projects.index', [
            'projects' => $projects,
        ]);
    }
}
