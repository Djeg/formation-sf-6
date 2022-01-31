<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Repository\DetailsRepository;
use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="app_front_front_home")
     */
    public function home(PizzaRepository $repository, SessionInterface $session): Response
    {
        $pizzas = $repository->findAll();

        return $this->render('Front/Front/home.html.twig', [
            'pizzas' => $pizzas,
            'cartSize' => array_sum($session->get('cart', [])),
        ]);
    }

    /**
     * @Route("/nous-contacter", name="app_front_front_contact")
     */
    public function contact(DetailsRepository $repository): Response
    {
        $details = $repository->findOneBy([
            'name' => 'ma_pizzeria',
        ]);

        return $this->render('Front/Front/contact.html.twig', [
            'details' => $details,
        ]);
    }

    /**
     * @Route("/ajouter-au-panier/{id}", name="app_front_front_addToCart")
     */
    public function addToCart(int $id, SessionInterface $session): Response
    {
        // On veut un tableaux contenant l'id de la pizza associé à sa quantité:
        // [ 1 => 2, 4 => 1, 8 => 1 ]

        // Je récupére la session "cart", si elle n'existe pas,
        // ce sera un tableaux vide
        $cart = $session->get('cart', [1 => null]);

        // On rajoute la quantité à l'id données
        //if (!isset($cart[$id])) {
        //    $cart[$id] = 0;
        //}

        //$cart[$id] = $cart[$id] + 1;

        // Si l'id dans le panier n'éxiste pas
        // Alors l'id prend la valeur 1
        // Sinon l'id sera incrémenté de 1
        $cart[$id] = !isset($cart[$id]) ? 1 : $cart[$id] + 1;

        // On met à jour le panier dans la session
        $session->set('cart', $cart);

        // Redirige vers la liste des pizzas
        return $this->redirectToRoute('app_front_front_home');
    }

    /**
     * @Route("/mon-panier", name="app_front_front_cart")
     */
    public function cart(PizzaRepository $repository, SessionInterface $session): Response
    {
        // On récupére ce que l'on as dans le panier
        $cart = $session->get('cart', []);

        $pizzas = $repository->findBy([
            'id' => array_keys($cart),
        ]);

        $total = 0;

        foreach ($pizzas as $pizza) {
            $pizzaTotal = $pizza->getPrice() * $cart[$pizza->getId()];
            $total += $pizzaTotal;
        }

        return $this->render('Front/Front/cart.html.twig', [
            'pizzas' => $pizzas,
            'cart' => $cart,
            'total' => $total,
        ]);
    }
}
