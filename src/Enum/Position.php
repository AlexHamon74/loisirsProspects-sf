<?php

namespace App\Enum;

enum Position: string
{
    case DEFENSEUR = 'Défenseur';
    case CENTRE = 'Centre';
    case AILIER_DROIT = 'Ailier droit';
    case AILIER_GAUCHE = 'Ailier gauche';
    case GARDIEN = 'Gardien';
}