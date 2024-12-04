<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-16">
        <div class="px-4 py-2">
            <h1 class="text-gray-800 font-bold text-2xl uppercase">To-Do List</h1>
        </div>
        <form class="w-full max-w-sm mx-auto px-4 py-2">
            @csrf
            <div class="flex items-center border-b-2 border-teal-500 py-2">
                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text" placeholder="Add a task">
                <button
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                    type="button">
                    Add
                </button>
            </div>
        </form>
        <ul class="divide-y divide-gray-200 px-4">
            <li class="py-4">
                <div class="flex items-center">
                    @foreach ($tasks as $item)
                        <label for="todo1" class="ml-3 block text-gray-900">
                            <span class="text-lg font-medium">{{ $item->todo_tasks }}</span>
                        </label>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</body>

</html>
