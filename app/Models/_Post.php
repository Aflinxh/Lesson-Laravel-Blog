<?php

namespace App\Models;

class Post
{
    private static $blog_posts = [
        [
            'title' => 'Blog',
            'slug' => 'blog',
            'author' => 'Julian',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.'
        ],
        [
            'title' => 'Blog 2',
            'slug' => 'blog-2',
            'author' => 'Julian',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.'
        ],
        [
            'title' => 'Blog 3',
            'slug' => 'blog-3',
            'author' => 'Julian',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.'
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        // foreach ($posts as $post) {
        //     if ($post['slug'] === $slug) {
        //         return $post;
        //     }
        // }
        return $posts->firstWhere('slug', $slug);
    }
}

