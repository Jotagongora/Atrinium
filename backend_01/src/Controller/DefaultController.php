<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\Sector;
use App\Form\EmpresaType;
use App\Form\SectorType;
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
     * @Route("/crear/empresa", name="default_index_crear")
     */
    public function createCompany(Request $request, SectorRepository $sectorRepository): Response
    {

        $sectors = $sectorRepository->findAll();

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
            'sectors' => $sectors,
            'companyForm' => $form->createView()
        ]);
    }

     /**
     * @Route("/crear/sector", name="default_index_crear_sector")
     */
    public function createSector(Request $request, SectorRepository $sectorRepository): Response
    {

        $sector = new Sector;

        $form = $this->createForm(SectorType::class, $sector);

        $form->handleRequest($request);

        if ($form->get('Cancelar')->isClicked())
        {
            return $this->redirectToRoute('default_index_sector');
        }

        if ($form->isSubmitted())
        {
            $newSector = $sector->getNombre();

            $result = $sectorRepository->findAll();

            $data = [];

            foreach($result as $existingSector) {

                $data[] = strtolower($existingSector->getNombre());
                
            }

            if (in_array(strtolower($newSector), $data)) {

                $this->addFlash(
                    'notice',
                    '¡Ese sector ya existe!'
                );

                return $this->redirectToRoute('default_index_sector');

            } else {

                $em = $this->getDoctrine()->getManager();

                $em->persist($sector);

                $em->flush();

                return $this->redirectToRoute('default_index_sector');
            }
        }

        return $this->render('default/sectorForm.html.twig', [
            'sectorForm' => $form->createView()
        ]);
    }


     /**
     * @Route("/modificar/empresa", name="default_index_modificar_empresa")
     */
    public function modifyCompany(Request $request, EmpresaRepository $empresaRepository): Response
    {
        $empresa = $empresaRepository->find($request->query->get('id'));

        $form = $this->createForm(EmpresaType::class, $empresa);

        $form->handleRequest($request);

        if ($form->get('Cancelar')->isClicked())
        {
            return $this->redirectToRoute('default_index_company');
        }

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
     * @Route("/modificar/sector", name="default_index_modificar_sector")
     */
    public function modifySector(Request $request, SectorRepository $sectorRepository): Response
    {
        $sector = $sectorRepository->find($request->query->get('id'));

        $form = $this->createForm(SectorType::class, $sector);

        $form->handleRequest($request);

        if ($form->get('Cancelar')->isClicked())
        {
            return $this->redirectToRoute('default_index_sector');
        }

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($sector);

            $em->flush();

            return $this->redirectToRoute('default_index_sector');
        }

        return $this->render('default/sectorForm.html.twig', [
            'sectorForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/eliminar/empresa", name="default_index_eliminar_empresa")
     */
    public function deleteCompany(Request $request, EmpresaRepository $empresaRepository, EntityManagerInterface $entityManager): Response
    {

        if($request->query->has('id'))
        {

        $empresa = $empresaRepository->find($request->query->get('id'));

        $entityManager->remove($empresa);

        $entityManager->flush();

        return $this->redirectToRoute('default_index_company');

        }

        return $this->redirectToRoute('default_index_company');
    }

    /**
     * @Route("/eliminar/sector", name="default_index_eliminar_sector")
     */
    public function deleteSector(Request $request, SectorRepository $sectorRepository, EntityManagerInterface $entityManager, EmpresaRepository $empresaRepository): Response
    {

        if($request->query->has('id'))
        {

        $sector = $sectorRepository->find($request->query->get('id'));

        $data = $sector->getEmpresas();

        if (sizeof($data) > 0) {

            $this->addFlash(
                'notice',
                '¡Alguna empresa pertece al sector!. Elimina primero las empresas relacionadas para elimiar el sector'
            );

            return $this->redirectToRoute('default_index_sector');

        } else {

            $entityManager->remove($sector);

            $entityManager->flush();

            return $this->redirectToRoute('default_index_sector');

            }
        }

        return $this->redirectToRoute('default_index_sector');
    }

    /**
     * @Route("/confirmar_eliminar/empresa", name="default_index_confirmar_eliminar_empresa")
     */
    public function redirectDeleteCompany(Request $request): Response
    {
        $id = $request->query->get('id');

        return $this->render('default/deleteCompany.html.twig', [
            'id' => $id
        ]);
    }

    /**
     * @Route("/confirmar_eliminar/sector", name="default_index_confirmar_eliminar_sector")
     */
    public function redirectDeleteSector(Request $request): Response
    {
        $id = $request->query->get('id');

        return $this->render('default/deleteSector.html.twig', [
            'id' => $id
        ]);
    }

}