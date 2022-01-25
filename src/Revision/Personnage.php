<?php

declare(strict_types=1);

namespace App\Revision;

class Personnage
{
    private string $name;

    private int $life;

    private int $attack;

    public function __construct(string $name, int $life = 100, int $attack = 40)
    {
        $this->name = $name;
        $this->life = $life;
        $this->attack = $attack;
    }

    public function attaque(Personnage $cible): void
    {
        // $this === merlin
        // $cible === arthur
        $cible->life = $cible->life - $this->attack;
    }
}

$arthur = new Personnage("Arthur");
$merlin = new Personnage("Merlin l'enchanteur", 80, 60);

$arthur->attaque($merlin); // merlin vas perdre le nombre d'attaque d'arthur
$merlin->attaque($arthur);
