<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/hello", name="app_test_hello")
     */
    public function hello(): Response
    {
        return new Response('Hello');
    }

    /**
     * @Route("/hello", name="app_test_hello2")
     */
    public function hello2(): Response
    {
        return new Response('Hello');
    }
}
