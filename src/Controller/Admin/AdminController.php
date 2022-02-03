<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Admin\UpdatableEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class AdminController extends AbstractController
{
    protected function entityList(
        ServiceEntityRepository $repository,
        string $dataKey = "data",
    ): Response {
        $controllerName = $this->getControllerName();

        return $this->render("Admin/$controllerName/list.html.twig", [
            "$dataKey" => $repository->findAll(),
        ]);
    }

    protected function createEntity(
        Request $request,
        EntityManagerInterface $manager,
        string $formType,
        string $redirectRoute,
        string $controllerName,
    ): Response {
        $form = $this->createForm($formType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute($redirectRoute);
        }

        return $this->render("Admin/$controllerName/create.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    protected function updateEntity(
        Request $request,
        EntityManagerInterface $manager,
        UpdatableEntity $entity,
        string $formType,
        string $redirectRoute,
        string $controllerName,
    ): Response {
        $form = $this->createForm($formType, $entity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute($redirectRoute);
        }

        return $this->render("Admin/$controllerName/update.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    protected function removeEntity(
        EntityManagerInterface $manager,
        UpdatableEntity $entity,
        string $redirectRoute,
    ): Response {
        $manager->remove($entity);
        $manager->flush();

        return $this->redirectToRoute($redirectRoute);
    }

    private function getControllerName(): string
    {
        $controllerClass = $this::class;
        dump($this::class);
        $controllerParts = explode('\\', $controllerClass);
        $controllerName = end($controllerParts);

        return str_replace('Controller', '', $controllerName);
    }
}
