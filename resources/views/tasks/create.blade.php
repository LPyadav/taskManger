<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <h1 class="text-2xl font-bold mb-4">Add New Task</h1>
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="mt-1 block w-full" type="text" name="title"
                                :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea id="description" class="block mt-1 w-full" name="description"
                                required>{{ old('description') }}</x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status"
                                class="border-gray-300 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="status" required>
                                <option value="">Select status
                                </option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Add Task') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
