<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Pizza;
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormInterface;

class PizzaAdminController extends AdminController
{
    /**
     * @Route("/admin/pizza/list", name="app_admin_pizzaAdmin_list")
     */
    public function list(PizzaRepository $repository): Response
    {
        return $this->entityList($repository, 'pizzas');
    }

    /**
     * @Route("/admin/pizza/nouvelle", name="app_admin_pizzaAdmin_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        return $this->createEntity(
            $request,
            $manager,
            PizzaType::class,
            'app_admin_pizzaAdmin_list',
            'PizzaAdmin',
        );
    }

    /**
     * @Route("/admin/pizza/{id}/supprimer", name="app_admin_pizzaAdmin_remove")
     */
    public function remove(
        Pizza $pizza,
        EntityManagerInterface $manager,
    ): Response {
        return $this->removeEntity(
            $manager,
            $pizza,
            'app_admin_pizzaAdmin_list',
        );
    }

    /**
     * @Route("/admin/pizza/{id}/modifier", name="app_admin_pizzaAdmin_update")
     */
    public function update(
        Pizza $pizza,
        EntityManagerInterface $manager,
        Request $request,
    ): Response {
        return $this->updateEntity(
            $request,
            $manager,
            $pizza,
            PizzaType::class,
            'app_admin_pizzaAdmin_list',
            'PizzaAdmin',
        );
    }
}
