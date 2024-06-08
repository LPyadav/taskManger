@if (isset($tasks) && $tasks->isNotEmpty())
<table class="table-auto w-full mb-4">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td class="border px-4 py-2">{{ $task->title }}</td>
                <td class="border px-4 py-2">{{ $task->description }}</td>
                <td class="border px-4 py-2">
                    @if ($task->status == 'completed')
                        <x-tag type="success" text="Completed" />
                    @else
                        <x-tag type="warning" text="Pending" />
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <x-anchor-tag href="{{ route('tasks.edit', $task) }}" text="Edit"
                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2.5 px-5 rounded" />
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-info">
    No tasks available. Please add a new task.
</div>
@endif