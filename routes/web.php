<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts = Post::all();
    // ddd($posts);
    return view('posts', ["posts" => $posts]);
});

Route::get("/post/{post}", function ($slug) {
    // $path = "$slug.html";
    // if (!file_exists($path)) {
    //     ddd("better luck next time");
    //     // dd("for text")
    //     // abort(503);
    //     // return redirect("/");
    // }
    // $post = file_get_contents($path);
    // $post = cache()->remember("posts.{$slug}", 10, function () use ($path) {
    //     var_dump("I'm new for cache");
    //     return file_get_contents($path);
    // });
    // $post = cache()->remember("posts.{$slug}", now()->addSeconds(10), function () use ($path) {
    //     var_dump("I'm from cache");
    //     return file_get_contents($path);
    // });
    // $post = cache()->remember("posts.post", 10, fn () => file_get_contents($path));
    $post = Post::find($slug);

    return view("post", ["post" =>  $post]);
})->whereAlphaNumeric("post");
