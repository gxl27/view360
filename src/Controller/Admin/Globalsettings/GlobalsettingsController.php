<?php

namespace App\Controller\Admin\Globalsettings;

use App\Entity\Globalsettings;
use App\Form\GlobalsettingsType;
use App\Repository\GlobalsettingsRepository;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/globalsettings")
 */
class GlobalsettingsController extends BaseController
{
    /**
     * @Route("/", name="app_globalsettings_index", methods={"GET"})
     */
    public function index(GlobalsettingsRepository $globalsettingsRepository): Response
    {
        return $this->render('admin/globalsettings/index.html.twig', [
            'globalsettings' => $globalsettingsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_globalsettings_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GlobalsettingsRepository $globalsettingsRepository): Response
    {
        $globalsetting = new Globalsettings();
        $form = $this->createForm(GlobalsettingsType::class, $globalsetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $globalsettingsRepository->add($globalsetting, true);

            return $this->redirectToRoute('app_globalsettings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/globalsettings/new.html.twig', [
            'globalsetting' => $globalsetting,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_globalsettings_show", methods={"GET"})
     */
    public function show(Globalsettings $globalsetting): Response
    {
        return $this->render('admin/globalsettings/show.html.twig', [
            'globalsetting' => $globalsetting,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_globalsettings_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Globalsettings $globalsetting, GlobalsettingsRepository $globalsettingsRepository): Response
    {
        $form = $this->createForm(GlobalsettingsType::class, $globalsetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $globalsettingsRepository->add($globalsetting, true);

            return $this->redirectToRoute('app_globalsettings_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/globalsettings/edit.html.twig', [
            'globalsetting' => $globalsetting,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_globalsettings_delete", methods={"POST"})
     */
    public function delete(Request $request, Globalsettings $globalsetting, GlobalsettingsRepository $globalsettingsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$globalsetting->getId(), $request->request->get('_token'))) {
            $globalsettingsRepository->remove($globalsetting, true);
        }

        return $this->redirectToRoute('app_globalsettings_index', [], Response::HTTP_SEE_OTHER);
    }
}
