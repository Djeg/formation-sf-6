<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    protected function entityList(
        ServiceEntityRepository $repository,
        string $controllerName,
        string $dataKey = "data",
    ): Response {
        return $this->render("Admin/$controllerName/list.html.twig", [
            "$dataKey" => $repository->findAll(),
        ]);
    }
}
