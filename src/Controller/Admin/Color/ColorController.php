<?php

namespace App\Controller\Admin\Color;

use App\Entity\Color;
use App\Form\ColorType;
use App\Repository\ColorRepository;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/color")
 */
class ColorController extends BaseController
{
    /**
     * @Route("/", name="app_color_index", methods={"GET"})
     */
    public function index(ColorRepository $colorRepository): Response
    {
        return $this->render('admin/color/index.html.twig', [
            'colors' => $colorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_color_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ColorRepository $colorRepository): Response
    {
        $color = new Color();
        // dd($color);
        $form = $this->createForm(ColorType::class, $color);
        // dd($form);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $colorRepository->add($color, true);

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/color/new.html.twig', [
            'color' => $color,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_color_show", methods={"GET"})
     */
    public function show(Color $color): Response
    {
        return $this->render('admin/color/show.html.twig', [
            'color' => $color,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_color_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Color $color, ColorRepository $colorRepository): Response
    {
        $form = $this->createForm(ColorType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $colorRepository->add($color, true);

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/color/edit.html.twig', [
            'color' => $color,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_color_delete", methods={"POST"})
     */
    public function delete(Request $request, Color $color, ColorRepository $colorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$color->getId(), $request->request->get('_token'))) {
            $colorRepository->remove($color, true);
        }

        return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
