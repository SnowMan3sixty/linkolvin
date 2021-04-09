<?php

namespace App\Controller;

use App\Entity\Oferta;
use App\Entity\Empresa;
use App\Form\OfertaType;
use App\Repository\OfertaRepository;
use App\Repository\EmpresaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/oferta')]
class OfertaController extends AbstractController
{
    #[Route('/', name: 'oferta_index', methods: ['GET'])]
    public function index(OfertaRepository $ofertaRepository): Response
    {    
        if(in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)){
            return $this->render('oferta/index.html.twig', [
                'ofertas' => $ofertaRepository->findAll(),  
            ]);
        }  
        elseif(in_array('ROLE_COMPANY', $this->getUser()->getRoles(), true)){
            return $this->render('oferta/index.html.twig', [
                'ofertas' => $ofertaRepository->findByEmpresa(($this->getDoctrine()->getRepository('App:Empresa')->findOneByUsuari($this->getUser()->getId()))->getID()),  
            ]);
        }  
        
    }

    #[Route('/new', name: 'oferta_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $ofertum = new Oferta();
        
        //se consulta el id de la empresa a partir del id del ususario
        $idEmpresa = ($this->getDoctrine()->getRepository('App:Empresa')->findOneByUsuari($this->getUser()->getId()))->getID();
        //Se busca el objeto empresa segun el id encontrado anteriormente
        $ofertum->setEmpresa($this->getDoctrine()->getRepository(Empresa::class)->findOneById($idEmpresa));
        $ofertum->setEstat(0);

        $form = $this->createForm(OfertaType::class, $ofertum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ofertum);
            $entityManager->flush();

            return $this->redirectToRoute('oferta_index');
        }

        return $this->render('oferta/new.html.twig', [
            'ofertum' => $ofertum,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'oferta_show', methods: ['GET'])]
    public function show(Oferta $ofertum): Response
    {
        return $this->render('oferta/show.html.twig', [
            'ofertum' => $ofertum,
        ]);
    }

    #[Route('/{id}/edit', name: 'oferta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Oferta $ofertum): Response
    {
        $form = $this->createForm(OfertaType::class, $ofertum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('oferta_index');
        }

        return $this->render('oferta/edit.html.twig', [
            'ofertum' => $ofertum,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/aprove', name: 'oferta_aprove', methods: ['GET', 'POST'])]
    public function aprove(Request $request, Oferta $ofertum): Response
    {
        $ofertum->setEstat(1);




        $ofertum->setDataPublicacio(new \DateTime(date("Y/m/d")));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ofertum);
        $entityManager->flush();
        return $this->redirectToRoute('oferta_index');
    }

    #[Route('/{id}/denegate', name: 'oferta_denegate', methods: ['GET', 'POST'])]
    public function denegate(Request $request, Oferta $ofertum): Response
    {
        $ofertum->setEstat(2);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ofertum);
        $entityManager->flush();
        return $this->redirectToRoute('oferta_index');
    }

    #[Route('/{id}', name: 'oferta_delete', methods: ['DELETE'])]
    public function delete(Request $request, Oferta $ofertum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ofertum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ofertum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('oferta_index');
    }
}
