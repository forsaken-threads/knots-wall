<?php

use KnotsWall\BladeExtender;
use KnotsWall\Collector\Collector;

return [
    '_puzzle_pieces' => [
        BladeExtender::class,
        Collector::class,
    ],
    'production' => false,
];
