<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Empresa;
use App\Form\EmpresaType;
use App\Repository\EmpresaRepository;
use App\Repository\SectorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default_index")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/empresas", name="default_index_company")
     */
    public function companies(EmpresaRepository $empresaRepository): Response
    {
        $empresas = $empresaRepository->findAll();

        return $this->render('default/company.html.twig', [
            'companies' => $empresas
        ]);
    }

     /**
     * @Route("/sector", name="default_index_sector")
     */
    public function sectors(SectorRepository $sectorRepository): Response
    {

        $sectores = $sectorRepository->findAll();

        return $this->render('default/sector.html.twig', [
            'sectors' => $sectores
        ]);
    }

    /**
     * @Route("/crear", name="default_index_crear")
     */
    public function createCompany(Request $request): Response
    {
        $empresa = new Empresa();

        $form = $this->createForm(EmpresaType::class, $empresa);

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($empresa);

            $em->flush();

            return $this->redirectToRoute('default_index_company');
        }

        return $this->render('default/form.html.twig', [
            'companyForm' => $form->createView()
        ]);
    }

     /**
     * @Route("/modificar", name="default_index_modificar")
     */
    public function modifyCompany(Request $request, EmpresaRepository $empresaRepository): Response
    {
        $empresa = $empresaRepository->find($request->query->get('id'));

        $form = $this->createForm(EmpresaType::class, $empresa);

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($empresa);

            $em->flush();

            return $this->redirectToRoute('default_index_company');
        }

        return $this->render('default/form.html.twig', [
            'companyForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/eliminar", name="default_index_eliminar")
     */
    public function deleteCompany(Request $request, EmpresaRepository $empresaRepository, EntityManagerInterface $entityManager): Response
    {
        $empresa = $empresaRepository->find($request->query->get('id'));

        dump($empresa);

        $entityManager->remove($empresa);

        $entityManager->flush();

        return $this->redirectToRoute('default_index_company');
    }

}