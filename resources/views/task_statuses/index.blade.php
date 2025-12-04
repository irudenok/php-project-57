<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Статусы
            </h2>
            @auth
            <a href="{{ route('task_statuses.create') }}">
                <x-primary-button>Создать статус</x-primary-button>
            </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Имя</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Дата создания</th>
                                @auth
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Действия</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($taskStatuses as $status)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $status->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $status->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $status->created_at->format('d.m.Y') }}</td>
                                @auth
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium space-x-3">
                                    <a href="{{ route('task_statuses.edit', $status) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Изменить</a>
                                    {!! html()->form('DELETE', route('task_statuses.destroy', $status))->class('inline')->open() !!}
                                        {!! html()->button('Удалить')
                                            ->type('submit')
                                            ->class('text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300')
                                            ->attribute('dusk', 'delete-button')
                                            ->attribute('onclick', "return confirm('Вы уверены, что хотите удалить этот статус?')") !!}
                                    {!! html()->form()->close() !!}
                                </td>
                                @endauth
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Статусы не найдены</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $taskStatuses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

