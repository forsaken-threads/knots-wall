<?php namespace KnotsWall\Collector;

class Posts implements Collection
{
    protected $posts;

    public function collect($post)
    {
        return $this->posts[] = $this->setDefaults($post);
    }

    public function getPosts()
    {
        return $this->posts;
    }

    protected function setDefaults($post)
    {
        if (empty($post['slug'])) {
            $post['slug'] = str_slug($post['title']);
        }
        return $post;
    }
}