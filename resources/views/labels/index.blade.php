<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Метки
            </h2>
            @auth
            <a href="{{ route('labels.create') }}">
                <x-primary-button>Создать метку</x-primary-button>
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
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Описание</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Дата создания</th>
                                @auth
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Действия</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($labels as $label)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $label->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $label->name }}</td>
                                <td class="px-6 py-4 text-sm text-center text-gray-900 dark:text-gray-100">{{ $label->description ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900 dark:text-gray-100">{{ $label->created_at->format('d.m.Y') }}</td>
                                @auth
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium space-x-3">
                                    <a href="{{ route('labels.edit', $label) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Изменить</a>
                                    <form id="delete-label-form-{{ $label->id }}" method="POST" action="{{ route('labels.destroy', $label) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="{{ route('labels.destroy', $label) }}"
                                       onclick="event.preventDefault(); if(confirm('Вы уверены, что хотите удалить эту метку?')) { document.getElementById('delete-label-form-{{ $label->id }}').submit(); }"
                                       class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        Удалить
                                    </a>
                                </td>
                                @endauth
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Метки не найдены</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $labels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

