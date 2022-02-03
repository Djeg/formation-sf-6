<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Repository\DetailsRepository;
use App\Repository\PizzaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $session->set('cart_size', array_sum($cart));

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

    /**
     * @Route("/mon-panier/supprimer/{id}", name="app_front_front_removeFromCart")
     */
    public function removeFromCart(int $id, SessionInterface $session): Response
    {
        // Récupération du panier
        $cart = $session->get('cart', []);

        // Test si le panier à la pizza à l'id
        // indiqué
        if (isset($cart[$id])) {
            // supprime la pizza du panier
            unset($cart[$id]);
        }

        // On met à jour le panier dans la session
        $session->set('cart', $cart);
        $session->set('cart_size', array_sum($cart));

        // Redirige vers la page du panier
        return $this->redirectToRoute('app_front_front_cart');
    }

    /**
     * @Route("/mon-panier/modifier/{id}/{quantity}", name="app_front_front_updateCart")
     */
    public function updateCart(int $id, int $quantity, SessionInterface $session): Response
    {
        // Si la quantité est inférieur ou égale à 0
        if ($quantity <= 0) {
            // On redirige vers la supression de la pizza du panier
            return $this->redirectToRoute('app_front_front_removeFromCart', [
                'id' => $id,
            ]);
        }

        // Récupération du panier
        $cart = $session->get('cart', []);

        // Si la pizza n'est présente dans mon panier
        if (!isset($cart[$id])) {
            // On léve un erreur 404
            throw new NotFoundHttpException();
        }

        // On met à jour la quantité de pizza
        $cart[$id] = $quantity;

        // On enregistre le panier dans la session
        $session->set('cart', $cart);
        $session->set('cart_size', array_sum($cart));

        // On redirige vers la page du panier
        return $this->redirectToRoute('app_front_front_cart');
    }
}
