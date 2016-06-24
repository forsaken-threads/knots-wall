<?php

use KnotsWall\BladeExtender;
use KnotsWall\BlogMetaBuilder;

return [
    '_puzzle_pieces' => [
        BladeExtender::class,
        BlogMetaBuilder::class,
    ],
    'production' => false,
];
