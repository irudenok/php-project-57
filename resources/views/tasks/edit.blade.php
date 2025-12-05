<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Изменить задачу
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {!! html()->form('PATCH', route('tasks.update', $task))->open() !!}
                        <div class="mb-4">
                            <x-input-label for="name" value="Имя" />
                            {!! html()->text('name')
                                ->id('name')
                                ->class('block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600')
                                ->value(old('name', $task->name))
                                ->autofocus() !!}
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="description" value="Описание" />
                            {!! html()->textarea('description')
                                ->id('description')
                                ->class('block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600')
                                ->rows(4)
                                ->value(old('description', $task->description)) !!}
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="status_id" value="Статус" />
                            {!! html()->select('status_id', ['' => 'Выберите статус'] + $statuses->pluck('name', 'id')->toArray())
                                ->id('status_id')
                                ->class('block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600')
                                ->value(old('status_id', $task->status_id)) !!}
                            <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="assigned_to_id" value="Исполнитель" />
                            {!! html()->select('assigned_to_id', ['' => 'Не назначен'] + $users->pluck('name', 'id')->toArray())
                                ->id('assigned_to_id')
                                ->class('block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600')
                                ->value(old('assigned_to_id', $task->assigned_to_id)) !!}
                            <x-input-error :messages="$errors->get('assigned_to_id')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="label_ids" value="Метки" />
                            {!! html()->select('label_ids[]', $labels->pluck('name', 'id')->toArray())
                                ->id('label_ids')
                                ->class('block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600')
                                ->multiple()
                                ->value(old('label_ids', $task->labels->pluck('id')->toArray())) !!}
                            <x-input-error :messages="$errors->get('label_ids')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 mr-4">Отмена</a>
                            <x-primary-button type="submit" dusk="update-button" class="normal-case">Обновить</x-primary-button>
                        </div>
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

