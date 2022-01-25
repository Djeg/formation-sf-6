<?php

declare(strict_types=1);

namespace App\Revision;

/**
 * 1. La class doit avoir le même nom que le fichier PHP
 * 2. Une seule class par fichier PHP
 * 3. Le nom de la class doit commencer par une majuscule
 * (4. Les class sont généralement au singulier)
 * 5. Chaque class doit possèder un namespace (correspond à l'arborescence)
 * 6. ça doit êre au début du fichier (au dessus des uses et de la class)
 * 7. Le répertoire "src" correspond au namespace "App"
 * 8. Ça doit être nommé avec les même conventions que les classes (commence
 *    par une majuscule, au singulier)
 */
class Personnage
{
    protected string $name;

    protected int $life;

    protected int $attack;

    protected int $defense;

    public function __construct(string $name, int $life = 100, int $attack = 40)
    {
        $this->name = $name;
        $this->life = $life;
        $this->attack = $attack;
        $this->defense = 78;
    }

    public function attaque(Personnage $cible): void
    {
        // $this === merlin
        // $cible === arthur
        $cible->life = $cible->life - $this->attack;
    }
}

class Magicien extends Personnage
{
    public function __construct(string $name, int $life = 100, int $attack = 40)
    {
        parent::__construct($name, 80, 60);
    }
}
