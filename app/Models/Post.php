<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{

    public $title;
    public $body;

    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }


    public static function all()
    {
        $posts = File::files(public_path("/posts"));
        $documents = [];
        foreach ($posts as $file) {

            $documents = YamlFrontMatter::parse(file_get_contents($file));
            $files = new Post($documents->title, $documents->body());
        }
        ddd($files);

        return array_map(function ($post) {
            return $post->getContents();
        }, $posts);
    }



    public static function find($slug)
    {

        $path = "posts/$slug.html";
        if (!file_exists($path)) {
            // ddd("better luck next time");
            throw new ModelNotFoundException("not found");
        }
        $post = cache()->remember("posts.{$slug}", now()->addSeconds(10), function () use ($path) {
            // var_dump("I'm from cache");
            return file_get_contents($path);
        });
        return $post;
    }
}
