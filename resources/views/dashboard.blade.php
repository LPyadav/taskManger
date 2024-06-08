<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">

                    <a href="/tasks" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Normal Crud</a> |
                    <a href="/api" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Add Task via
                        API</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
