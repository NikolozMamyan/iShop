<?php

namespace App\Controller;

use App\Repository\BasketRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'app_basket')]
    public function showBasket(EntityManagerInterface $entityManager, BasketRepository $basketRepository): Response
    {
        $user = $this->getUser();
        $baskets = $basketRepository->findBy(['user' => $user]);
        
    
        $productsInBasket = [];
        foreach ($baskets as $basket) {
            $productsInBasket = array_merge($productsInBasket, $basket->getProduct()->toArray());
             $basketsQuantity = $basket->getQuantity();
        }
 
        return $this->render('basket/index.html.twig', [
            'productsInBasket' => $productsInBasket,
             'basketsQuantity' => $basketsQuantity
        ]);
    }

    #[Route('/basket/update', name: 'app_update_basket_quantity')]
    public function updateBasket(EntityManagerInterface $entityManager, BasketRepository $basketRepository, Request $request): Response
    {
        $user = $this->getUser();
        $baskets = $basketRepository->findBy(['user' => $user]);
        $basket = $baskets[0];
        $displayedQuantity = intval($request->request->get('displayed_quantity'));
    
    $basket -> setQuantity($displayedQuantity);
    $entityManager->persist($basket);
    $entityManager->flush();

    return $this->redirectToRoute('app_basket');
     
    }

    #[Route('/basket/delete/{productId}', name: 'app_delete_basket')]
    public function deleteBasketItem(EntityManagerInterface $entityManager, ProductRepository $productRepository, BasketRepository $basketRepository, int $productId): Response
    {
        $user = $this->getUser();
        $product = $productRepository->find($productId);
        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }
    
        $baskets = $basketRepository->findBy(['user' => $user]);
        $basketsQuantity = []; // Définir une valeur par défaut pour $basketsQuantity
    
        foreach ($baskets as $basket) {
            $basket->removeProduct($product);
            $basketsQuantity[] = $basket->getQuantity(); // Remplir $basketsQuantity avec les quantités des paniers
        }
    
        $entityManager->flush();
        return $this->redirectToRoute('app_basket');
    
        return $this->render('basket/index.html.twig', [
            'productsInBasket' => $baskets,
            'basketsQuantity' => $basketsQuantity,
        ]);
    }

}
