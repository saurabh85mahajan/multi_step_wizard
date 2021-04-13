<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="my-8 text-2xl flex justify-between">
         <div>
            Projects
         </div>
          <div class="mr-6">
              <x-button class="bg-blue-500 hover:bg-blue-800">Add New</x-button>
          </div>
    </div>

    <x-table>
        <x-slot name="header">
            <x-table-column>ID</x-table-column>
            <x-table-column>Name</x-table-column>
            <x-table-column>Action</x-table-column>
        </x-slot>
        @foreach( $projects as $project)
            <tr>
                <x-table-column>{{ $project->id}}</x-table-column>
                <x-table-column>{{ $project->name}}</x-table-column>
                <x-table-column>
                    <x-button class="bg-indigo-500 hover:bg-indigo-800">Edit</x-button>
                </x-table-column>
            </tr>
        @endforeach
    </x-table>

      <div class="mt-4">
        {{ $projects->links() }}
      </div>
    </div>
</div> 