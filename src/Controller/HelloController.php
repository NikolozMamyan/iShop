<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
    #[Route('/', name: 'app_hello')]
    public function index(EntityManagerInterface $entityManager, Request $request, ProductRepository $productRepository): Response
    {

        $products = $productRepository->findAll();
        return $this->render('hello/index.html.twig', [
            'products' => $products,
        ]);
    }
}
