<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List of Movies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Publised-Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie )
                      <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$movie->title}}</td>
                        <td><img src="/movieImage/{{$movie->image}}" class="rounded-circle" width="50" height="50"></td>
                        <td>{{$movie->publish_at}}</td>
                        <td><a href="/{{$movie->id}}/editmovie" class="btn btn-dark btn-sm">Edit</a>
                        <a  href="/{{$movie->id}}/deletemovie" class="btn btn-danger btn-sm">Delete</a></tb>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
