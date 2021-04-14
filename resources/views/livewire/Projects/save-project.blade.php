<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-2 text-2xl flex justify-between">
            <div>
                {{$this->isEdit ? 'Edit Project' : 'Add Project'}}
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <form wire:submit.prevent="saveProject">
            
                <div>
                    <x-label for="project_name" value="Project Name" class="mt-4" />
                    <x-input class="block mt-1 w-1/4" type="text" name="project_name" wire:model.defer="project.name" required />
                    <x-wizard-validation-error for="project.name" />
                </div>

                @foreach( $this->tasks as $i => $task)
                    <div class="mt-8">
                        <hr />
                        
                        <div class="mt-4">
                            <x-input type="text" class="mt-1 block w-1/2" wire:model.defer="tasks.{{$i}}.title" placeholder="Task" />
                            <x-wizard-validation-error for="tasks.{{$i}}.title" class="mt-2" />
                            <x-input type="hidden" wire:model.defer="tasks.{{$i}}.id" />
                         </div>

                        <div class="flex justify-between mt-4">

                            <div>
                                <select wire:model.defer="tasks.{{$i}}.priority" class="form-select rounded-md shadow-sm">
                                    <option value="">-Select Priority-</option>
                                    <option value="low">Low</option>
                                    <option value="high">High</option>
                                </select>
                                <x-wizard-validation-error for="tasks.{{$i}}.priority" class="mt-2" />
                            </div>

                            <x-button wire:click.prevent="deleteTask({{$i}})" class="bg-red-500 hover:bg-red-800 mr-8">
                                Delete
                            </x-button>
                        </div>
                    </div>
                @endforeach

                @if ($this->canAddMoreTasks())
                    <div class="mt-8">
                        <x-button class="bg-blue-500 hover:bg-blue-800" wire:click.prevent="addTask">
                            Add Task
                        </x-button>
                    </div>
                @endif

                <div>
                    <x-button class="bg-indigo-500 hover:bg-indigo-800 mt-4">Save</x-button>
                </div>
            </form>
        </div>
    </div>
</div> 