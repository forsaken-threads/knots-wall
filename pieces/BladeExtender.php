<?php namespace KnotsWall;

use Illuminate\View\Compilers\BladeCompiler;
use TightenCo\Jigsaw\PuzzlePiece;

class BladeExtender extends PuzzlePiece {

    public function boot()
    {
        /** @var BladeCompiler $blade */
        $blade = $this->container[BladeCompiler::class];
        $blade->directive('doofus', function($expression) {
            return "<?php echo 'Yes! ' . $expression; ?>";
        });
    }

}