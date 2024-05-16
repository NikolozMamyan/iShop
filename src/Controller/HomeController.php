<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Entity\Product;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, Request $request, ProductRepository $productRepository): Response
    {
        $user = $this->getUser();
        $products = $productRepository->findAll();
        
        return $this->render('home/index.html.twig', [
            'user' => $user,
            'products' => $products,
        ]);
    }

    #[Route('/home/addToCard/{id}', name: 'app_addToCart')]
    public function addToCart(EntityManagerInterface $entityManager, Request $request, ProductRepository $productRepository, int $id): Response
    {
        $user = $this->getUser();
        $basket = new Basket();
        $product = $productRepository->find($id);
    
        $basket->addProduct($product)
                ->setQuantity(1);
        $user->addProduct($basket);
    
        $entityManager->persist($basket);
        $entityManager->flush();
        
                return $this->redirectToRoute('app_home');
        return $this->render('home/addToCart.html.twig', [
        
            
        ]);
    }
}
