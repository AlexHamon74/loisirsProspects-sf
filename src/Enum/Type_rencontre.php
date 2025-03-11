<?php

namespace App\Enum;

enum Type_rencontre: string
{
    case CHAMPIONNAT = 'Championnat';
    case AMICAL = 'Amical';
    case COUPE = 'Coupe';
    case PLAYOFFS = 'Playoffs';
    case PLAYDOWNS = 'Playdowns';
}