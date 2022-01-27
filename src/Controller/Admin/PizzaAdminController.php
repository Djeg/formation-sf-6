<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PizzaAdminController extends AbstractController
{
    /**
     * @Route("/admin/pizza/list", name="app_admin_pizzaAdmin_list")
     */
    public function list(PizzaRepository $repository): Response
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
        // récupération de la méthode HTTP
        $method = $request->getMethod();

        // Si le formulaire a été envoyé
        if ($method === 'POST') {
            // Création d'une nouvelle pizza
            $pizza = new Pizza();

            // On vas remplir notre pizza avec
            // les données du formulaire
            $pizza->setName($request->request->get('name'));
            $pizza->setDescription($request->request->get('description'));
            $pizza->setPrice((float)$request->request->get('price'));
            $pizza->setImage($request->request->get('image'));

            // On enregistre la pizza en base de données
            $manager->persist($pizza);
            $manager->flush();
        }


        // Affiche le formulaire de création de pizza
        return $this->render('Admin/PizzaAdmin/create.html.twig');
    }

    /**
     * @Route("/admin/pizza/{id}", name="app_admin_pizzaAdmin_show")
     */
    public function show(int $id, PizzaRepository $repository): Response
    {
        // Récupération de la pizza
        $pizza = $repository->find($id);

        // On affiche la page html
        return $this->render('Admin/PizzaAdmin/show.html.twig', [
            'pizza' => $pizza,
        ]);
    }

    /**
     * @Route("/admin/pizza/{id}/supprimer", name="app_admin_pizzaAdmin_remove")
     */
    public function remove(
        int $id,
        PizzaRepository $repository,
        EntityManagerInterface $manager,
    ): Response {
        // On récupére la pizza que l'on veut supprimer
        $pizza = $repository->find($id);

        // On supprime la pizza
        $manager->remove($pizza);
        $manager->flush();

        return new Response("La pizza $id à bien été supprimée");
    }

    /**
     * @Route("/admin/pizza/{id}/modifier", name="app_admin_pizzaAdmin_update")
     */
    public function update(
        int $id,
        PizzaRepository $repository,
        EntityManagerInterface $manager,
        Request $request,
    ): Response {
        // On récupére la pizza que l'on veut mettre à jour
        $pizza = $repository->find($id);

        // Si le formulaire a été envoyé
        if ($request->getMethod() === 'POST') {
            // On vas remplir notre pizza avec
            // les données du formulaire
            $pizza->setName($request->request->get('name'));
            $pizza->setDescription($request->request->get('description'));
            $pizza->setPrice((float)$request->request->get('price'));
            $pizza->setImage($request->request->get('image'));

            // On enregistre la pizza en base de données
            $manager->persist($pizza);
            $manager->flush();
        }

        return $this->render('Admin/PizzaAdmin/update.html.twig', [
            'pizza' => $pizza,
        ]);
    }
}
