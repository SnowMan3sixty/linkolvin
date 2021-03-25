<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

#[Route('/')]
class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index()
    {    
        if($this->getUser())    {
            if(in_array('ROLE_COMPANY', $this->getUser()->getRoles(), true) || in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true) ){
                return $this->render('index/index.html.twig');
            }
            else{
                return $this->redirect('http://localhost:8080');
            }     
        }
        else{
            return $this->redirectToRoute('app_login');
        }
           
    }
    #[Route('/logged', name: 'logged')]
    public function logged()
    {               
       if(in_array('ROLE_COMPANY', $this->getUser()->getRoles(), true) ){
            if(!($this->getUser()->isVerified())){
                return $this->redirectToRoute('empresa_new');
            }
            else{
                return $this->redirectToRoute('index');
            }        
       }
       else if(in_array('ROLE_USER', $this->getUser()->getRoles(), true)){
            if(!($this->getUser()->isVerified())){
                return $this->redirectToRoute('candidat_new');
            }
            else{
                return $this->redirect('http://localhost:8080');
            }     
       }     
       else{
            return $this->redirect('http://localhost:8080');
       }
    }
}
