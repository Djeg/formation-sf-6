<?php

declare(strict_types=1);

namespace App\Controller\Doctrine;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaExempleController extends AbstractController
{
    /**
     * @Route("/pizza-exemple", name="app_doctrine_pizza_exemple_test")
     */
    public function test(EntityManagerInterface $manager): Response
    {
        // Créer une pizza
        $pizza = new Pizza();
        $pizza->setName('Régina');
        $pizza->setBase('tomate');
        $pizza->setDescription('Pizza régina');
        $pizza->setSize('large');
        $pizza->setPrice(8.9);

        // On demande à doctrine de prendre en compte notre
        // pizza
        $manager->persist($pizza);

        // On enregistre dans la base de données
        $manager->flush();

        return new Response('La pizza à bien été enregistré');
    }

    /**
     * @Route("/pizza/{id}", name="app_doctrine_pizza_exemple_afficher")
     */
    public function afficher(int $id, PizzaRepository $repository): Response
    {
        $pizza = $repository->find($id);
        $pizzas = $repository->findAll();

        return $this->render('doctrine/pizza_exemple/afficher.html.twig', [
            'pizza' => $pizza,
            'pizzas' => $pizzas,
        ]);
    }
}
