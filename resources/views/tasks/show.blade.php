<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Просмотр задачи
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <strong>Имя:</strong> {{ $task->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Описание:</strong> {{ $task->description ?? '-' }}
                    </div>
                    <div class="mb-4">
                        <strong>Статус:</strong> {{ $task->status->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Автор:</strong> {{ $task->creator->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Исполнитель:</strong> {{ $task->assignee->name ?? '-' }}
                    </div>
                    <div class="mb-4">
                        <strong>Метки:</strong>
                        @if($task->labels->count() > 0)
                            @foreach($task->labels as $label)
                                <span class="inline-block bg-gray-200 dark:bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 dark:text-gray-300 mr-2">{{ $label->name }}</span>
                            @endforeach
                        @else
                            -
                        @endif
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 mr-4">Назад</a>
                        @auth
                        <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Изменить</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

