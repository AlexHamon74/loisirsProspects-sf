<?php

namespace App\Enum;

enum Position: string
{
    case DEFENSEUR = 'Défenseur';
    case ATTAQUANT = 'Attaquant';
    case GARDIEN = 'Gardien';
}