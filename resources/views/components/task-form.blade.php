{{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl"> --}}

                <div class="mt-4 mx-auto">
                    <form id="createForm" class="w-full">
                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->id() }}">

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 md:mb-0">
                                <label for="title"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Title</label>
                                <input type="text" name="title" id="title" placeholder="Enter task title"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                    <p id="titleError" class="text-red-500 text-xs italic hidden">Title is required.</p>

                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="description"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Description</label>
                                <textarea name="description" id="description" placeholder="Enter task description"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-32 resize-none"></textarea>
                                    <p id="descriptionError" class="text-red-500 text-xs italic hidden">Description is required.</p>

                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label for="status"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Status</label>
                                <div class="relative">
                                    <select name="status" id="status"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.707a1 1 0 0 0 1.414 0L12 11.414l3.293 3.293a1 1 0 1 0 1.414-1.414L13.414 10l3.293-3.293a1 1 0 1 0-1.414-1.414L12 8.586 8.707 5.293a1 1 0 0 0-1.414 1.414L10.586 10l-3.293 3.293a1 1 0 0 0 0 1.414z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" id="saveAddTask"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
                                Task</button>
                        </div>
                    </form>
                </div>

            {{-- </div> --}}
{{-- 
        </div>
    </div>
</div> --}}
