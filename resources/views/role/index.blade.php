<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-4">Roles</h1>
                    <a href="{{ route('role.create') }}"
                        class=" bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create
                        Role</a>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Guard Name</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="border px-4 py-2">{{ $role->name }}</td>
                                    <td class="border px-4 py-2">{{ $role->guard_name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('role.edit', $role->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
