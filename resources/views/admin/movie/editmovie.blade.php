<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Movies') }}
        </h2>
    </x-slot>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block"><strong>{{ $message }}</strong></div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="row justify-content-center">
                        <h1 class="text-muted">Editing #{{ $movie->title }}</h1>
                        <div class="col-sm-8">
                            <div class="card mt-3 p-3">
                                <form method="POST" action="/{{$movie->id}}/updatemovie" enctype="multipart/form-data">
                                    @csrf
                                    {{-- @method('PUT') --}}
                                    <div class="form-group">
                                        <label>Movie Name</label>
                                        <input type="text" name="title" value="{{ old('title', $movie->title) }}"
                                            class="form-control">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Movie Type</label>
                                        <select class="form-control" name="movie_categories_id">
                                            <option>Select Category</option>

                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id== $movie->movie_categories_id? 'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('movie_categories_id'))
                                            <span class="text-danger">{{ $errors->first('movie_categories_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" rows="4" name="description">{{ old('description', $movie->description) }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>IMDB Rate</label>
                                        <input type="text" name="imdb" value="{{ old('imdb', $movie->imdb) }}"
                                            class="form-control">
                                        @if ($errors->has('imdb'))
                                            <span class="text-danger">{{ $errors->first('imdb') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Runtime</label>
                                        <input type="text" name="runtime"
                                            value="{{ old('runtime', $movie->runtime) }}" class="form-control">
                                        @if ($errors->has('runtime'))
                                            <span class="text-danger">{{ $errors->first('runtime') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Published Date</label>
                                        <input type="date" name="publish_at"
                                            value="{{ old('publish_at', $movie->publish_at) }}" class="form-control">
                                        @if ($errors->has('publish_at'))
                                            <span class="text-danger">{{ $errors->first('publish_at') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" value="{{ old('image') }}"
                                            class="form-control">
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




</x-app-layout>
