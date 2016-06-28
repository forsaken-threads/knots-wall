<?php namespace KnotsWall\Blog;


class Posts implements Collection
{
    protected $posts;

    public function add($post)
    {
        $this->posts[] = $post;
    }
}