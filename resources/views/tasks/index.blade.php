<x-app-layout>
    <div class="container mx-auto px-4">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 flex px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" class="absolute top-0 right-0 px-2 py-1 text-xl text-green-700 hover:text-green-900" onclick="closeMessage('successMessage')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <button type="button" class="absolute top-0 right-0 px-2 py-1 text-xl text-green-700 hover:text-green-900" onclick="closeMessage('successMessage')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-4 text-center">Tasks</h1>
        <div class="mx-auto px-4 flex justify-end">
            <x-anchor-tag href="{{ route('tasks.create') }}" text="Add Task"
                class="bg-blue-500 hover:bg-blue-700 text-right text-white font-bold py-2 px-4 rounded mb-4" />
        </div>
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
    </div>

</x-app-layout>
<script>
    // Function to close message
    function closeMessage(elementId) {
        
        var element = document.getElementById(elementId);
        if (element) {
            element.remove();
        }
    }

    // Auto dismiss after 5 seconds
    setTimeout(function() {
        closeMessage('successMessage');
    }, 5000);
    setTimeout(function() {
        closeMessage('errorMessage');
    }, 5000);
</script>


