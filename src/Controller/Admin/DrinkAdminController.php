<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Drink;
use App\Form\DrinkType;
use App\Repository\DrinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DrinkAdminController extends AdminController
{
    /**
     * @Route("/admin/drinks/list", name="app_admin_drinkAdmin_list")
     */
    public function list(DrinkRepository $repository): Response
    {
        return $this->entityList($repository, 'drinks');
    }

    /**
     * @Route("/admin/drinks/create", name="app_admin_drinkAdmin_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        return $this->createEntity(
            $request,
            $manager,
            DrinkType::class,
            'app_admin_drinkAdmin_list',
            'DrinkAdmin',
        );
    }

    /**
     * @Route("/admin/drinks/{id}/modifier", name="app_admin_drinkAdmin_update")
     */
    public function update(
        Drink $drink,
        EntityManagerInterface $manager,
        Request $request,
    ): Response {
        return $this->updateEntity(
            $request,
            $manager,
            $drink,
            DrinkType::class,
            'app_admin_drinkAdmin_list',
            'DrinkAdmin',
        );
    }

    /**
     * @Route("/admin/drinks/{id}/supprimer", name="app_admin_drinkAdmin_remove")
     */
    public function remove(Drink $drink, EntityManagerInterface $manager): Response
    {
        return $this->removeEntity(
            $manager,
            $drink,
            'app_admin_drinkAdmin_list',
        );
    }
}
