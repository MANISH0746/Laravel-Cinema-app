<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Category;


class HomeController extends Controller
{
    public function indexPage()
    {
        return view('index', ['movies' => Movie::get()]);
    }
    public function singlemovie()
    {
        return view('singlemovie', ['movies' => Movie::get()]);
    }
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            if ($usertype == 'user') {
                return view('dashboard');
            } else if ($usertype == 'admin') {
                return view('admin.admindashboard');
            } else {
                return redirect()->back();
            }
        }
    }

    public function addmovie()
    {
        return view('admin.movie.addmovie', ['categories' => Category::all()]);
    }
    public function movieslist()
    {

        return view('admin.movie.movieslist', ['movies' => Movie::get()]);
    }

    public function createmovie(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'imdb' => 'required',
            'runtime' => 'required',
            'publish_at' => 'required',
            'image' => 'required|mimes:webp,jpeg,jpg,png,gif|max:10000',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('movieImage'), $imageName);

        $movie = Movie::create($request->all());

        // $movie = new Movie;
        // $movie->title = $request->title;
        // $movie->description = $request->description;
        // $movie->imdb = $request->imdb;
        // $movie->runtime = $request->runtime;
        // $movie->publish_at = $request->publish_at;
        // $movie->image = $imageName;
        // $movie->movie_categories_id = $request->movie_categories_id;

        // $movie = Movie::find(1);
        // $year = $movie->publish_at->format('Y');

        $movie->save();
        return back();
        // MovieCreate::create($request->all());

        return view('admin.movie.addmovie')->with('New Movie Added !!!');
    }

    public function editmovie($id)
    {
        $movie = Movie::with('category')->where('id', $id)->first();

        return view('admin.movie.editmovie', ['movie' => $movie],['categories' => Category::all()]);
    }
    public function updatemovie(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'imdb' => 'required',
            'runtime' => 'required',
            'publish_at' => 'required',
            'image' => 'nullable|mimes:webp,jpeg,jpg,png,gif|max:10000',
        ]);
        $movie = Movie::where('id', $id)->first();

        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('movieImage'), $imageName);
            $movie->image = $imageName;
        }
        $movie->update($request->all());

        // $movie->title = $request->title;
        // $movie->description = $request->description;
        // $movie->imdb = $request->imdb;
        // $movie->runtime = $request->runtime;
        // $movie->publish_at = $request->publish_at;

        $movie->save();
        return back();
        // MovieCreate::create($request->all());

        return back()->withSuccess('Movie Updated !!!');
    }
    public function destroy($id)
    {
        $movie = Movie::where('id', $id)->first();
        $movie->delete();
        return back()->withSuccess('Movie Deleted !!!');
    }

}
