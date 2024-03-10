<?php

namespace App\Enums;

enum TypeOfDocuments: int
{
    case CURP = 1;
    case RFC = 2;
    case ID = 3;
}