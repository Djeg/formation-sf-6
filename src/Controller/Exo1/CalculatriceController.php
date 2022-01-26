<?php

declare(strict_types=1);

namespace App\Controller\Exo1;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatriceController
{
    /**
     * @Route("/additionner/{x}/{y}", name="app_exo1_calculatrice_additionner")
     */
    public function additionner(int $x, int $y): Response
    {
        $total = $x + $y;

        return new Response("Résultat $total");
    }

    /**
     * @Route("/soustraire/{x}/{y}", name="app_exo1_calculatrice_soustraire")
     */
    public function soustraire(int $x, int $y): Response
    {
        $total = $x - $y;

        return new Response("Résultat $total");
    }

    /**
     * @Route("/multiplier/{x}/{y}", name="app_exo1_calculatrice_multiplier")
     */
    public function multiplier(int $x, int $y): Response
    {
        $total = $x * $y;

        return new Response("Résultat $total");
    }

    /**
     * @Route("/diviser/{x}/{y}", name="app_exo1_calculatrice_diviser")
     */
    public function diviser(int $x, int $y): Response
    {
        if ($y === 0) {
            return new Response("Impossible de diviser par 0", 400);
        }

        $total = $x / $y;

        return new Response("Résultat $total");
    }

    /**
     * @Route("/modulo/{x}/{y}", name="app_exo1_calculatrice_modulo")
     */
    public function modulo(int $x, int $y): Response
    {
        if ($y === 0) {
            return new Response("Impossible de modulo par 0");
        }

        $total = $x % $y;

        return new Response("Résultat $total");
    }
}
