<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientAdminController extends AdminController
{
    /**
     * @Route("/admin/ingredients/list", name="app_admin_ingredientAdmin_list")
     */
    public function list(IngredientRepository $repository): Response
    {
        return $this->entityList($repository, 'IngredientAdmin', 'ingredients');
    }

    /**
     * @Route("/admin/ingredients/create", name="app_admin_ingredientAdmin_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(IngredientType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_admin_ingredientAdmin_list');
        }

        return $this->render('Admin/IngredientAdmin/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ingredients/{id}/modifier", name="app_admin_ingredientAdmin_update")
     */
    public function update(
        Ingredient $ingredient,
        EntityManagerInterface $manager,
        Request $request,
    ): Response {
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_admin_ingredientAdmin_list');
        }

        return $this->render('Admin/IngredientAdmin/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ingredients/{id}/supprimer", name="app_admin_ingredientAdmin_remove")
     */
    public function remove(Ingredient $ingredient, EntityManagerInterface $manager): Response
    {
        $manager->remove($ingredient);
        $manager->flush();

        return $this->redirectToRoute('app_admin_ingredientAdmin_list');
    }
}
