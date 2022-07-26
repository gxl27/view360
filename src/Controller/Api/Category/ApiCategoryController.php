<?php

namespace App\Controller\Api\Category;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/category")
 */
class ApiCategoryController extends BaseController
{
    /**
     * @Route("/", name="api_category_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAllVisible();
        $result = [];
        for($i = 0 ; $i< sizeof($categories); $i++){
            // for single values
            $result[$i] = [
                'id' => $categories[$i]->getId(),
                'name' => $categories[$i]->getName(),
                'img' => $categories[$i]->getDocument(),
            ];
            // for array values
            for($j = 0; $j< sizeof($categories[$i]->getVariants()); $j++){
                $variant = $categories[$i]->getVariants();
                $result[$i]['variantsCount'] = sizeof($variant);
                if(sizeof($variant) > 0){
                    $result[$i]['variants'][$j]['id'] = $variant[$j]->getId();
                    $result[$i]['variants'][$j]['name'] = $variant[$j]->getName();
                    $result[$i]['variants'][$j]['img'] = $variant[$j]->getDocument();
                }
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
