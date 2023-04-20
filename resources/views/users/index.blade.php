<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200">

                    <div class="mt-4 overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300 uppercase">
                                        {{ __('Name') }}</th>
                                    <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300 uppercase">
                                        {{ __('Email') }}</th>
                                    <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300 uppercase">
                                        {{ __('Role') }}</th>
                                    <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300 uppercase">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-3 whitespace-nowrap dark:text-gray-200">{{ $user->name }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap dark:text-gray-200">{{ $user->email }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap dark:text-gray-200">
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        <td class="px-4 py-3 whitespace-nowrap dark:text-gray-200">

                                            @if ($user->getRoleNames()->first() == 'user')
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Delete') }}</button>
                                                </form>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
