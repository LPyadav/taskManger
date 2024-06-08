<x-app-layout>
    <div class="container mx-auto px-4 ">
        <h1 class="text-2xl font-bold mb-4">Task List</h1>
        <button id="addTaskButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">Add
            Task</button>
            <button id="assignTaskButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Assign Task</button>

        <div class="grid grid-cols-1 md:grid-cols-1">

            {{-- <x-task-form /> --}}
            <div class="py-12">
                <div class="mt-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg overflow-x-hidden overflow-y-auto h-100">
                    <table id="taskTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    S.N</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody id="taskTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Table rows will be dynamically generated here -->
                        </tbody>

                    </table>
                    <div id="noRecordsMessage" class="text-center text-gray-500 mt-4 hidden">No records found</div>

                </div>
            </div>
        </div>
        <div id="editModal"
            class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-8 w-full max-w-4xl">
                <h2 class="text-lg font-bold mb-4">Edit Task</h2>
                <input type="hidden" id="editTaskId">
                <div class="mb-4">
                    <input type="text" id="editTitle" class="block w-full mb-2 border border-gray-300 rounded p-2"
                        placeholder="Title">
                    <p id="editTitleError" class="text-red-500 text-xs italic hidden">Title is required.</p>
                </div>
                <div class="mb-4">
                    <textarea id="editDescription" class="block w-full mb-2 border border-gray-300 rounded p-2" placeholder="Description"></textarea>
                    <p id="editDescriptionError" class="text-red-500 text-xs italic hidden">Description must be at least
                        10 characters.</p>
                </div>
                <div class="mb-4">
                    <select id="editStatus" class="block w-full mb-2 border border-gray-300 rounded p-2">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    <p id="editStatusError" class="text-red-500 text-xs italic hidden">Status is required.</p>
                </div>
                <div class="flex justify-end">
                    <button id="saveChanges"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save
                        Changes</button>
                    <button id="closeEditModal"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-4">Close</button>
                </div>
            </div>
        </div>

        <!-- Add Task Modal -->
        <div id="addModal"
            class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-8 w-full max-w-4xl">
                <h2 class="text-lg font-bold mb-4">Add Task</h2>
                <div class="flex justify-end">
                    <button id="closeAddModal"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-4">Close</button>
                </div>
                <x-task-form form-id="addTaskForm" save-button-id="saveAddTask" button-text="Add Task" />

            </div>
        </div>

        <div id="assignModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-8 w-full max-w-4xl">
                <h2 class="text-lg font-bold mb-4">Assign Task</h2>
                <form id="assignTaskForm">
                    <div class="mb-4">
                        <label for="user_ids" class="block text-gray-700 text-sm font-bold mb-2">Select User:</label>
                        <select id="user_ids" name="user_ids" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <!-- Options will be populated here -->
                            <option value="" disabled selected>Select User</option>

                        </select>
                        <p id="userError" class="text-red-500 text-xs italic hidden">User is required.</p>
                    </div>
                    <div class="mb-4">
                        <label for="task_id" class="block text-gray-700 text-sm font-bold mb-2">Select Task:</label>
                        <select id="task_id" name="task_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <!-- Options will be populated here -->
                            <option value="" disabled selected>Select Task</option>

                        </select>
                        <p id="taskError" class="text-red-500 text-xs italic hidden">Task is required.</p>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="closeAssignModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-4">Close</button>
                        <button type="submit" id="saveAssignTask" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">Assign</button>
                    </div>
                </form>
            </div>
        </div>
        

        <script>
            {!! Vite::content('resources/js/app.js') !!}
        </script>
        <script src="{{ asset('/js/script.js') }}"></script>


</x-app-layout>
