<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/hello", name="app_test_hello")
     */
    public function hello(Request $request): Response
    {
        $taille = $request->query->get('taille');

        return new Response('Vous avez demandé la taille ' . $taille);
    }

    /**
     * @Route("/hello", name="app_test_hello2")
     */
    public function hello2(): Response
    {
        return new Response('Hello');
    }
}
