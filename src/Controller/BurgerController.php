<?php

namespace App\Controller;
 
use App\Repository\BurgerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Burger;
 
class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burgers_index')]
    public function index(BurgerRepository $burgerRepository): Response
    {
        // Vous pouvez injecter EntityManagerInterface à la place de BurgerRepository qui n'existe pas encore 
        $burgers = $burgerRepository->findAllBurgers();
        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            'controller_name' => 'BurgerController',
        ]);
    }

    #[Route('/burgerByIngredient/{ingredient}', name:'burger_by_ingredient')]
    public function burgerByIngredient(BurgerRepository $burgerRepository, string $ingredient): Response
    {
        $burgers = $burgerRepository->findBurgersWithIngredient($ingredient);
        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            'ingredient' => $ingredient,
            'controller_name' => 'BurgerController',
        ]);
    }

    #[Route('/topBurgers', name:'top_burgers')]
    public function topBurgers(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findTopXBurgers(3);
        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            
            'controller_name' => 'BurgerController',
        ]);
    }

    
    #[Route('/burgerWithoutIngredient/{ingredient}', name:'burgers_without_ingredient')]
    public function burgerWithoutIngredient(BurgerRepository $burgerRepository, string $ingredient): Response
    {
        $burgers = $burgerRepository->findBurgersWithoutIngredient($ingredient);
        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            
            'controller_name' => 'BurgerController',
        ]);
    }

    #[Route('/burgersWithMinimumIngredients/{min}', name:'burgers_with_min_ingredient')]
    public function burgersWithMinimumIngredients(BurgerRepository $burgerRepository, int $min): Response
    {
        $burgers = $burgerRepository->findBurgersWithMinimumIngredients($min);
        return $this->render('burger/index.html.twig', [
            'burgers' => $burgers,
            
            'controller_name' => 'BurgerController',
        ]);
    }



    #[Route('/burger/create', name: 'burger_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        $burger = new Burger();
        $burger->setName('Krabby Patty');
        $burger->setPrice(4.99);
    
        // Persister et sauvegarder le nouveau burger
        $entityManager->persist($burger);
        $entityManager->flush();
    
        return new Response('Burger créé avec succès !');
    }


}