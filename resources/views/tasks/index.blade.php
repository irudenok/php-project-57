<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Задачи
            </h2>
            @auth
            <a href="{{ route('tasks.create') }}">
                <x-primary-button>Создать задачу</x-primary-button>
            </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('tasks.index') }}" class="mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-x-10 gap-y-6">
                            <div class="space-y-3 mb-4">
                                <x-input-label for="filter[status_id]" value="Статус" />
                                <select name="filter[status_id]" id="filter[status_id]" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                    <option value="">Все статусы</option>
                                    @foreach($statuses as $id => $name)
                                        <option value="{{ $id }}" @selected(request('filter.status_id') == $id)>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-3 mb-4">
                                <x-input-label for="filter[created_by_id]" value="Автор" />
                                <select name="filter[created_by_id]" id="filter[created_by_id]" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                    <option value="">Все авторы</option>
                                    @foreach($users as $id => $name)
                                        <option value="{{ $id }}" @selected(request('filter.created_by_id') == $id)>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-3 mb-4">
                                <x-input-label for="filter[assigned_to_id]" value="Исполнитель" />
                                <select name="filter[assigned_to_id]" id="filter[assigned_to_id]" class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                    <option value="">Все исполнители</option>
                                    @foreach($users as $id => $name)
                                        <option value="{{ $id }}" @selected(request('filter.assigned_to_id') == $id)>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-end gap-3 pb-1">
                                <x-primary-button type="submit" class="normal-case">Применить</x-primary-button>
                                <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">Очистить</a>
                            </div>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Имя</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Статус</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Автор</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Исполнитель</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Дата создания</th>
                                    @auth
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Действия</th>
                                    @endauth
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($tasks as $task)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $task->id }}</td>
                                    <td class="px-6 py-4 text-sm text-center text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('tasks.show', $task) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">{{ $task->name }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $task->status->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $task->creator->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $task->assignee->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">{{ $task->created_at->format('d.m.Y H:i') }}</td>
                                    @auth
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium space-x-3">
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Изменить</a>
                                        @if($task->creator && $task->creator->is(auth()->user()))
                                            <form id="delete-task-form-{{ $task->id }}" method="POST" action="{{ route('tasks.destroy', $task) }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="{{ route('tasks.destroy', $task) }}"
                                               onclick="event.preventDefault(); if(confirm('Вы уверены, что хотите удалить эту задачу?')) { document.getElementById('delete-task-form-{{ $task->id }}').submit(); }"
                                               class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                Удалить
                                            </a>
                                        @endif
                                    </td>
                                    @endauth
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">Задачи не найдены</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>