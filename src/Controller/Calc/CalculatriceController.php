<?php

declare(strict_types=1);

namespace App\Controller\Calc;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatriceController
{
    /**
     * @Route("/calc/additionner/{x}/{y}", name="app_calc_calculatrice_additionner")
     */
    public function additionner(int $x, int $y): Response
    {
        return new Response('Resultat : ' . ($x + $y));
    }
}
