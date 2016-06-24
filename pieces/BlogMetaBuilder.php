<?php namespace KnotsWall;

use TightenCo\Jigsaw\BuildModifier;
use TightenCo\Jigsaw\PuzzlePiece;

class BlogMetaBuilder extends PuzzlePiece implements BuildModifier
{
    public function boot()
    {

    }

    public function modify()
    {
        echo "here\n";
    }

    public function register()
    {
        $this->container->tag(get_class($this), 'jigsaw.build_modifier.pass.1');
    }
}