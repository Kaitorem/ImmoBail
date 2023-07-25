<?php

namespace App\Contante;

class LocataireConstant
{
    // TYPE DE LOCATAIRE
    public const ETUDIANT = 'etudiant';
    public const SALARIE = 'salarié';
    public const CHOMEUR = 'chomeur';
    public const AUTRE = 'autres';

    public const STATUS = [
        self::ETUDIANT => self::ETUDIANT,
        self::SALARIE => self::SALARIE,
        self::CHOMEUR => self::CHOMEUR,
        self::AUTRE => self::AUTRE,
    ];
}
