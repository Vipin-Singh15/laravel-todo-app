<x-layout title="Todo List">
    <h1 class="text-2xl font-bold mb-4 text-center">Todo List</h1>
    @if (session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div id="error-message" class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('todos.store') }}" method="POST" class="mb-4 flex justify-around items-center flex-row">
        @csrf
        <input type="text" name="task" class="border p-2 w-[80%] mr-2" placeholder="New task" required>
        <input type="date" name="deadline" class="border p-2 w-[40%] mr-2">
        <button type="submit" class="bg-blue-500 w-[100px] text-white p-2">Add</button>
    </form>
    @if ($todos->isEmpty())
        <p class="text-center text-gray-500">No tasks available.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200 text-center">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Task</th>
                    <th class="border border-gray-300 px-4 py-2">Deadline</th>
                    <th class="border border-gray-300 px-4 py-2">Completed</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todos as $todo)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">
                            <form action="{{ route('todos.update', $todo) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="task" value="{{ $todo->task }}">
                                <input type="checkbox" class="mr-2" name="completed" onchange="this.form.submit()"
                                    {{ $todo->completed ? 'checked' : '' }}>
                                <span class="{{ $todo->completed ? 'line-through' : '' }}">{{ $todo->task }}</span>
                            </form>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($todo->deadline)
                                {{ \Carbon\Carbon::parse($todo->deadline)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $todo->completed ? 'Yes' : 'No' }}
                        </td>
                        <td class="border border-gray-300 px-4">
                            <a href="{{ route('todos.edit', $todo) }}" class="text-blue-500 mr-2">Edit</a>
                            <span class="border-l border-gray-400 h-6 inline-block mx-2"></span>
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layout>
