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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PizzaAdminController extends AbstractController
{
    /**
     * @Route("/admin/pizza/list", name="app_admin_pizzaAdmin_list")
     */
    public function list(Request $request, PizzaRepository $repository): Response
    {
        // Récupére toutes les pizzas
        $pizzas = $repository->findAll();

        // Retourne une page html
        return $this->render('Admin/PizzaAdmin/list.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }

    /**
     * @Route("/admin/pizza/nouvelle", name="app_admin_pizzaAdmin_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        // Création du formulaire
        $form = $this->createAndHandleForm(
            PizzaType::class,
            $request,
        );

        // Si le formulaire à été soumis et est valide
        if ($this->isValidForm($form)) {
            // Récupération de la pizza
            $pizza = $form->getData();

            // Enregistrement des données dans la base
            $manager->persist($pizza);
            $manager->flush();

            // Redirection vers la liste des pizzas
            return $this->redirectToRoute('app_admin_pizzaAdmin_list');
        }

        // Crétion de la vue du formulaire : 
        // génération du HTML du formulaire
        $formView = $form->createView();

        // Affiche le formulaire de création de pizza
        return $this->render('Admin/PizzaAdmin/create.html.twig', [
            'pizzaForm' => $formView,
        ]);
    }

    /**
     * @Route("/admin/pizza/{id}", name="app_admin_pizzaAdmin_show")
     */
    public function show(Pizza $pizza): Response
    {
        // On affiche la page html
        return $this->render('Admin/PizzaAdmin/show.html.twig', [
            'pizza' => $pizza,
        ]);
    }

    /**
     * @Route("/admin/pizza/{id}/supprimer", name="app_admin_pizzaAdmin_remove")
     */
    public function remove(
        Pizza $pizza,
        EntityManagerInterface $manager,
    ): Response {
        // On supprime la pizza
        $manager->remove($pizza);
        $manager->flush();

        return new Response("La pizza {$pizza->getId()} à bien été supprimée");
    }

    /**
     * @Route("/admin/pizza/{id}/modifier", name="app_admin_pizzaAdmin_update")
     */
    public function update(
        Pizza $pizza,
        EntityManagerInterface $manager,
        Request $request,
    ): Response {
        // 
        $pizza->getIngredients();
        // Création du formulaire remplie avec les données
        // de la pizza
        $form = $this->createAndHandleForm(
            PizzaType::class,
            $request,
            $pizza,
        );

        // Si le formulaire est envoyé et valide
        if ($this->isValidForm($form)) {
            // On enregistre la pizza en base de données
            $manager->persist($form->getData());
            $manager->flush();

            // On redirige vers la liste des pizzas
            return $this->redirectToRoute('app_admin_pizzaAdmin_list');
        }

        return $this->render('Admin/PizzaAdmin/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function createAndHandleForm(
        string $formType,
        Request $request,
        $data = null,
    ): FormInterface {
        // Création du formulaire remplie avec les données
        // de la pizza
        $form = $this->createForm($formType, $data);

        // Remplir le formulaire avec les données de l'utilisateur
        $form->handleRequest($request);

        return $form;
    }

    protected function isValidForm(FormInterface $form): bool
    {
        return $form->isSubmitted() && $form->isValid();
    }
}
