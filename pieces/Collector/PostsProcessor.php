<?php namespace KnotsWall\Collector;

use Illuminate\View\Factory;
use Symfony\Component\Finder\SplFileInfo;
use TightenCo\Jigsaw\Handlers\BladeHandler;
use TightenCo\Jigsaw\ProcessedFile;

class PostsProcessor extends BladeHandler
{

    protected $viewFactory;

    public function boot(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
        $this->viewFactory->addExtension('posts.process.php', 'blade');
    }

    public function canHandle($file)
    {
        return ends_with($file->getFilename(), '.posts.process.php');
    }

    public function handle($file, $data, $pass = 0)
    {
        $contents = $this->render($file, $data);
        // Let's see if this is a collection item
        if ($this->container->bound('collector.item.path.' . $file->getFilename())) {
            $filename = 'index.html';
            $path = $file->getRelativePath() . '/' . $this->container['collector.item.path.' . $file->getFilename()];
        } else {
            $filename = $pass > 0 ? $file->getBasename('.posts.process.php') . '.html' : $file->getBasename();
            $path = $file->getRelativePath();
        }
        return new ProcessedFile($filename, $path, $contents);
    }

    /**
     * @param SplFileInfo $file
     * @param $data
     * @return string
     */
    public function render($file, $data)
    {
        return $this->viewFactory->file($file->getRealPath(), $data)->render();
    }

}