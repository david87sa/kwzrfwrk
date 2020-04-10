<?php

namespace Kweizar\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PublishController extends Controller
{
    public function indexAction()
    {
        $component = $this->getDoctrine()
                ->getRepository('KweizarStoreBundle:MainComponent')
                ->findAll();
        $sectionTypes = $this->getDoctrine()
                ->getRepository("KweizarStoreBundle:SectionType")
                ->findAll();
        $form = $this->createContactEmailForm();
            
        return $this->render("KweizarPageBundle:Publish:index.html.twig",array(
            'component'=>$component,
            'sectionTypes'=>$sectionTypes,
            'contactEmailForm'=>$form->createView()));
        
    }
    
    public function contactEmailAction(Request $request)
    {
        
        $mailer = $this->get('mailer');
        
        $form =  $this->createContactEmailForm();
        $form->handleRequest($request);
        try{
            $message = $mailer->createMessage()
                ->setSubject($form->get('subject')->getData())
                ->setFrom('kweizar@kepasaka.com')
                ->setTo('kweizarband@gmail.com')
                ->setBody(
                    $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                        'KweizarPageBundle:emails:contactEmail.html.twig',
                        array('info' => $form->get('content')->getData(),
                            'email' => $form->get('email')->getData())
                    ),
                    'text/html'
                );
            $mailer->send($message);
        }catch(Exception $e){
            return new Response("false");
        }
        return new Response("true");
    }
    
    public function newsElementAction($id){
        $element = $this->getDoctrine()
                ->getRepository('KweizarStoreBundle:Element')
                ->find($id);
        
        return $this->render("KweizarPageBundle:Publish/components:newsElement.html.twig",array(
            'newsitem'=>$element));
        
    }
    
    
    private function createContactEmailForm(){
        $element=array(''=>'');
        return $this->createFormBuilder($element)
                ->add('subject','text')
                ->add('email','email')
                ->add('content','textarea')
                ->add('send','submit',array('label'=>'Send'))
                ->getForm();
    }
}
