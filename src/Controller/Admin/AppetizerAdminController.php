<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Appetizer;
use App\Form\AppetizerType;
use App\Repository\AppetizerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppetizerAdminController extends AdminController
{
    /**
     * @Route("/admin/appetizers/list", name="app_admin_appetizerAdmin_list")
     */
    public function list(AppetizerRepository $repository): Response
    {
        return $this->entityList($repository, 'appetizers');
    }

    /**
     * @Route("/admin/appetizers/create", name="app_admin_appetizerAdmin_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        return $this->createEntity(
            $request,
            $manager,
            AppetizerType::class,
            'app_admin_appetizerAdmin_list',
            'AppetizerAdmin',
        );
    }

    /**
     * @Route("/admin/appetizers/{id}/modifier", name="app_admin_appetizerAdmin_update")
     */
    public function update(
        Appetizer $appetizer,
        EntityManagerInterface $manager,
        Request $request,
    ): Response {
        return $this->updateEntity(
            $request,
            $manager,
            $appetizer,
            AppetizerType::class,
            'app_admin_appetizerAdmin_list',
            'AppetizerAdmin',
        );
    }

    /**
     * @Route("/admin/appetizers/{id}/supprimer", name="app_admin_appetizerAdmin_remove")
     */
    public function remove(Appetizer $appetizer, EntityManagerInterface $manager): Response
    {
        return $this->removeEntity(
            $manager,
            $appetizer,
            'app_admin_appetizerAdmin_list',
        );
    }
}
