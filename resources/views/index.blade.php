<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/index/index.js'])
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <title>Document</title>

    <style>
        .icon-container {
            display: flex;
            gap: 8%;
        }

        .icon {
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .pencil-icon {
            margin-left: auto;
            background-color: rgb(20, 184, 166);
        }

        .trash-icon {
            background-color: rgb(224, 2, 2);
        }

        #list-data {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-16">
        {{-- start succes alert message --}}
        <x-success-alert></x-success-alert>
        {{-- end succes alert message --}}

        {{-- start error alert message --}}
        <x-error-alert></x-error-alert>
        {{-- end error alert message --}}
        <div class="px-4 py-2">
            <h1 class="text-gray-800 font-bold text-2xl uppercase">To-Do List</h1>
        </div>
        <form class="w-full max-w-sm mx-auto px-4 py-2"  id="form-input-data" method="POST">
            @csrf
            <div class="flex items-center border-b-2 border-teal-500 py-2">
                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text" name="todo_tasks" placeholder="Add a task" id="input-data">
                <button title="Submit"
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                    type="submit">
                    Add
                </button>
            </div>
        </form>
        <ul class="divide-y divide-gray-200 px-4">
            @foreach ($tasks as $item)
                <li class="py-4">
                    <div id="list-data" class="flex items-center">
                        <h2 class="ml-3 block text-gray-900">
                            <span class="text-lg font-medium">{{ $loop->iteration }}. {{ $item->todo_tasks }}</span>
                        </h2>
                        <div class="icon-container">
                            <div class="icon pencil-icon">
                                <a href="{{ route('tasks.edit', ['task' => $item->id]) }}"><i class="bi bi-pencil-fill"></i></a>
                            </div>
                            <div class="icon trash-icon">
                                <button type="button" title="Delete" onclick="deleteTask({{ $item->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
