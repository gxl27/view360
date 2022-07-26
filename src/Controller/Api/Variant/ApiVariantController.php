<?php

namespace App\Controller\Api\Variant;

use App\Entity\Variant;
use App\Repository\VariantRepository;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/variant")
 */
class ApiVariantController extends BaseController
{
    /**
     * @Route("/{id}", name="api_variant_show", methods={"GET"})
     */
    public function index(Variant $id): Response
    {
        // $categories = $ProductRepository->findAllVisible();
        $result = [];
        // for($i = 0 ; $i< sizeof($categories); $i++){
        //     // for single values
            $result = [
                'id' => $id->getId(),
                'name' => $id->getName(),
                'img' => $id->getDocument(),

                
            ];
        //     // for array values
            $products = $id->getProducts();

            $result['productsCount'] = sizeof($products);
            for($i = 0; $i< sizeof($products) ; $i++){
                
                if(sizeof($products) > 0){
                    $result['products'][$i]['id'] = $products[$i]->getId();
                    $result['products'][$i]['name'] = $products[$i]->getVariant()->getName() . " " . $products[$i]->getColor()->getName();
                    $result['products'][$i]['colorType'] = $products[$i]->getColor()->getType();
                    $result['products'][$i]['colorValue'] = $products[$i]->getColor()->getValue();
                    $result['products'][$i]['img'] = $products[$i]->getDocument();
                    $result['products'][$i]['stock'] = $products[$i]->getStock();
                    $result['products'][$i]['price'] = $products[$i]->getPrice();
 
                }
            }
  
        
        return new JsonResponse($result);
    }

    

    // /**
    //  * @Route("/{id}", name="app_category_show", methods={"GET"})
    //  */
    // public function show(Category $category): Response
    // {
    //     return $this->render('admin/category/show.html.twig', [
    //         'category' => $category,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}/edit", name="app_category_edit", methods={"GET", "POST"})
    //  */
    // public function edit(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    // {
    //     $form = $this->createForm(CategoryType::class, $category);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $photoName = new PhotoService($form->get('photo')->getData(), $this->getParameter('uploads_directory'));
    //         $category->setDocument($photoName->getFilename());

    //         $categoryRepository->add($category, true);

    //         return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('admin/category/edit.html.twig', [
    //         'category' => $category,
    //         'form' => $form,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="app_category_delete", methods={"POST"})
    //  */
    // public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
    //         $categoryRepository->remove($category, true);
    //     }

    //     return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    // }
}
