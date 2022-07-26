<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $products = $productRepository->findAll();
        $categories = $categoryRepository->findAllVisible();

        return $this->render('home/index.html.twig', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
