<x-layout title="Edit Todo">
    <h1 class="text-2xl font-bold mb-4 text-center">Edit Todo</h1>
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
    <form action="{{ route('todos.update', $todo) }}" method="POST"
        class="mb-4 flex justify-around items-center flex-row">
        @csrf
        @method('PUT')
        <input type="text" name="task" class="border p-2  w-[80%] mr-2" value="{{ $todo->task }}" required>
        <input type="date" name="deadline" value="{{ $todo->deadline }}" class="border p-2">
        <button type="submit" class="bg-blue-500 w-[100px] text-white p-2">Update</button>
    </form>
    <a href="{{ route('todos.index') }}" class="text-blue-500 mt-4 inline-block">Back to Todo List</a>
</x-layout>
