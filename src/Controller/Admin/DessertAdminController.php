<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Dessert;
use App\Form\DessertType;
use App\Repository\DessertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DessertAdminController extends AdminController
{
    /**
     * @Route("/admin/desserts/list", name="app_admin_dessertAdmin_list")
     */
    public function list(DessertRepository $repository): Response
    {
        return $this->entityList($repository, 'desserts');
    }

    /**
     * @Route("/admin/desserts/create", name="app_admin_dessertAdmin_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        return $this->createEntity(
            $request,
            $manager,
            DessertType::class,
            'app_admin_dessertAdmin_list',
            'DessertAdmin',
        );
    }

    /**
     * @Route("/admin/desserts/{id}/modifier", name="app_admin_dessertAdmin_update")
     */
    public function update(
        Dessert $dessert,
        EntityManagerInterface $manager,
        Request $request,
    ): Response {
        return $this->updateEntity(
            $request,
            $manager,
            $dessert,
            DessertType::class,
            'app_admin_dessertAdmin_list',
            'DessertAdmin',
        );
    }

    /**
     * @Route("/admin/desserts/{id}/supprimer", name="app_admin_dessertAdmin_remove")
     */
    public function remove(Dessert $dessert, EntityManagerInterface $manager): Response
    {
        return $this->removeEntity(
            $manager,
            $dessert,
            'app_admin_dessertAdmin_list',
        );
    }
}
