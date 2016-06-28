<?php namespace KnotsWall\Blog;

use Illuminate\View\Compilers\BladeCompiler;
use TightenCo\Jigsaw\BuildDecorator;

class Blogger extends BuildDecorator
{
    public function boot()
    {
        /** @var BladeCompiler $blade */
        $blade = $this->container[BladeCompiler::class];
        $blade->directive('blogger', function($instructions) {
            $instructions = json_decode(substr($instructions, 1, -1), true);
            return $this->processInstructions($instructions);
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

    protected function post($meta)
    {

    }

    private function makeExtractable(array $array)
    {
        $symbols = [];
        foreach ($array as $key => $value) {
            $symbols[] = '"' . $key . '" => "' . addslashes($value) . '"';
        }
        return '[' . implode(', ', $symbols) . ']';
    }

    private function processInstructions(array $instructions)
    {
        $return = '';
        foreach ($instructions as $instruction => $options) {
            $result = call_user_func([$this, $instruction], $options);
            if ($result) {
                $return .= $result;
            }
        }
        return $return ? "<?php $return ?>" : '';
    }
}