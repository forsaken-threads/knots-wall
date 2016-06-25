<?php namespace KnotsWall;

use Illuminate\View\Factory;
use TightenCo\Jigsaw\Handlers\BladeHandler;
use TightenCo\Jigsaw\ProcessedFile;

class BladeReprocessor extends BladeHandler
{

    protected $reprocess = true;
    protected $viewFactory;

    public function boot(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
        $this->viewFactory->addExtension('blade.reprocess.php', 'blade');
    }

    public function canHandle($file)
    {
        return ends_with($file->getFilename(), '.blade.reprocess.php');
    }

    public function handle($file, $data)
    {
        $filename = $this->reprocess() ? $file->getFilename() : ($file->getBasename('.blade.reprocess.php') . '.html');
        $this->reprocess = false;
        return new ProcessedFile($filename, $file->getRelativePath(), $this->render($file, $data));
    }

    private function reprocess()
    {
        return $this->reprocess;
    }
}