<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\VariantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends BaseController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository, VariantRepository $variantRepository): Response
    {
        $products = $productRepository->findAllByVariant(2);
        $variantCaterogies = $variantRepository->findAllGroupedByCaterogy();

        $categories = $categoryRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'products' => $products,
            'variantCategories' => $variantCaterogies,
            'categories' => $categories
        ]);
    }
}
