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
        }
   
        return $this->render('basket/index.html.twig', [
            'productsInBasket' => $productsInBasket,
        ]);
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
    
        foreach ($baskets as $basket) {
            $basket->removeProduct($product);
        }
    
        $entityManager->flush();
    
        return $this->redirectToRoute('app_basket');
    }
}
