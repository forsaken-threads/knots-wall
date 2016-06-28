<?php

use KnotsWall\BladeExtender;
use KnotsWall\BLog\Blogger;

return [
    '_puzzle_pieces' => [
        BladeExtender::class,
        Blogger::class,
    ],
    'production' => false,
];
