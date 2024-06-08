<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Edit Task</h1>
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Task Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" value="{{ $task->title }}" class="w-full px-3 py-2 border rounded-md">
            </div>
            
            <!-- Task Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-bold mb-2">Description:</label>
                <textarea id="description" name="description" class="w-full px-3 py-2 border rounded-md">{{ $task->description }}</textarea>
            </div>
            
            <!-- Task Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-bold mb-2">Status:</label>
                <select id="status" name="status" class="w-full px-3 py-2 border rounded-md">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            
            <!-- Submit Button -->
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Task</button>
            </div>
        </form>
    </div>
</x-app-layout>
