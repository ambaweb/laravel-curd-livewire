<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        User Management
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="py-4 grid grid-cols-2 gap-2 justify-evenly">
                <div>
                    <button wire:click="create()"
                    class="bg-indigo-500 text-white font-bold py-2 px-4 rounded">Create New
                    User</button>
                </div>
            </div>
            @if($isModalOpen)
                @include('livewire.users.form')
            @endif
            <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                <thead class="text-gray-500 uppercase bg-gray-50 dark:text-gray-400">
                    <tr class="bg-gray-100 border">
                        <th class="px-4 py-2 w-20 text-left">ID</th>
                        <th class="px-4 py-2 text-left">First Name</th>
                        <th class="px-4 py-2 text-left">Last Name</th>
                        <th class="px-4 py-2 text-left">Username</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Created At</th>
                        <th class="px-4 py-2 w-60">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="border px-4 py-1">{{ $user->id }}</td>
                            <td class="border px-4 py-1">{{ $user->first_name }}</td>
                            <td class="border px-4 py-1">{{ $user->last_name }}</td>
                            <td class="border px-4 py-1">{{ $user->username }}</td>
                            <td class="border px-4 py-1">{{ $user->email }}</td>
                            <td class="border px-4 py-1">{{ $user->created_at }}</td>
                            <td class="border px-4 py-1 text-center">
                                <button wire:click="edit({{$user->id}})"
                                class="bg-emerald-800 text-white font-bold py-1 px-3 rounded my-1">Edit</button>
                                <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete({{$user->id}})"
                                class="bg-red-700 text-white font-bold py-1 px-3 rounded my-1">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-3 mt-4">{{ $users->links() }}</div>
    </div>
</div>