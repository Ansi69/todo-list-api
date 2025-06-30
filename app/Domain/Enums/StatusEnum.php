<?php

namespace App\Domain\Enums;

enum StatusEnum: int
{
    case archived = 1;
    case completed = 2;
    case planned = 3;
    case draft = 4;
}
