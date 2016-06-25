<?php namespace KnotsWall;

use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Factory;
use TightenCo\Jigsaw\BuildDecorator;

class BlogMetaBuilder extends BuildDecorator
{
    public function boot()
    {
        /** @var BladeCompiler $blade */
        $blade = $this->container[BladeCompiler::class];
        $blade->directive('blogmeta', function($meta) {
            $meta = json_decode(substr($meta, 1, -1), true);
            $meta = $this->makeExtractable($meta);
            return "<?php extract($meta); ?>";
        });
    }

    public function decorate($source)
    {
        echo "source is $source\n";
    }

    public function register()
    {
        $this->container->registerPuzzlePiece(BladeReprocessor::class);
    }

    private function makeExtractable(array $array)
    {
        $symbols = [];
        foreach ($array as $key => $value) {
            $symbols[] = '"' . $key . '" => "' . addslashes($value) . '"';
        }
        return '[' . implode(', ', $symbols) . ']';
    }
}