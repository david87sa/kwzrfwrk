<?php

namespace Kweizar\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Kweizar\StoreBundle\Entity\MainComponent;
use Kweizar\StoreBundle;
use Symfony\Component\HttpFoundation\Request;
use Kweizar\StoreBundle\Entity\Section;
use Kweizar\StoreBundle\Entity\Element;
use Kweizar\StoreBundle\Entity\SectionType;

class AuthorController extends Controller
{
    public function indexAction()
    {
        
        $MainComponent = new MainComponent();
        $section = new Section();
        $element = new Element();
        $sectionType = new SectionType();
        
        $component = $this->getDoctrine()
                ->getRepository('KweizarStoreBundle:MainComponent')
                ->findAll();
        $sectionTypes = $this->getDoctrine()
                ->getRepository("KweizarStoreBundle:SectionType")
                ->findAll();
        
        $sectionForm = $this->createSectionForm($section);
        $sectionTypeForm = $this->createSectionTypeForm($sectionType);
        $elementForm = $this->createElementForm($element);
        $form = $this->createCurrentForm($MainComponent);
        
        
        $formEmail = $this->createContactEmailForm();
            
        return $this->render("KweizarPageBundle:Author:index.html_1.twig",array(
            'form'=>$form->createView(),
            'sectionform'=>$sectionForm->createView(),
            'sectionTypeform'=>$sectionTypeForm->createView(),
            'elementform'=>$elementForm->createView(),
            'component'=>$component,
            'sectionTypes'=>$sectionTypes,
            'contactEmailForm'=>$formEmail->createView()));
        
    }    
    public function maintenanceAction()
    {
        
        $MainComponent = new MainComponent();
        $section = new Section();
        $element = new Element();
        $sectionType = new SectionType();
        
        $component = $this->getDoctrine()
                ->getRepository('KweizarStoreBundle:MainComponent')
                ->findAll();
        $sectionTypes = $this->getDoctrine()
                ->getRepository("KweizarStoreBundle:SectionType")
                ->findAll();
        
        $sectionForm = $this->createSectionForm($section);
        $sectionTypeForm = $this->createSectionTypeForm($sectionType);
        $elementForm = $this->createElementForm($element);
        $form = $this->createCurrentForm($MainComponent);
        
        
        $formEmail = $this->createContactEmailForm();
            
        return $this->render("KweizarPageBundle:Author:maintenance.html.twig",array(
            'form'=>$form->createView(),
            'sectionform'=>$sectionForm->createView(),
            'sectionTypeform'=>$sectionTypeForm->createView(),
            'elementform'=>$elementForm->createView(),
            'component'=>$component,
            'sectionTypes'=>$sectionTypes,
            'contactEmailForm'=>$formEmail->createView()));
        
    }
    
    public function addAction(Request $request){
        
        $MainComponent = new MainComponent();
        $form =  $this->createCurrentForm($MainComponent);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $em->persist($MainComponent);
        $em->flush();
        
        return $this->redirect($this->generateUrl('kweizar_page_author'));
                
    }
    
    public function addSectionTypeAction(Request $request){
        
        $sectionType = new SectionType();
        $form =  $this->createSectionTypeForm($sectionType);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $em->persist($sectionType);
        $em->flush();
        
        return $this->redirect($this->generateUrl('kweizar_page_author'));
                
    }    
    public function deleteSectionTypeAction($id){
        
        $this->deleteObject('KweizarStoreBundle:SectionType', $id);
        
        return $this->redirect($this->generateUrl('kweizar_page_author_maintenance'));
                
    }
    
    public function deleteAction($id){
        
        $this->deleteObject('KweizarStoreBundle:MainComponent',$id);
     
        return $this->redirect($this->generateUrl('kweizar_page_author'));
    }
     public function deleteSectionAction($id){
        
        $this->deleteObject('KweizarStoreBundle:Section',$id);
     
        return $this->redirect($this->generateUrl('kweizar_page_author'));
    }
     public function deleteElementAction($id){
        
         $this->deleteObject('KweizarStoreBundle:Element',$id);
     
        return $this->redirect($this->generateUrl('kweizar_page_author'));
    }
    
    private function deleteObject($resource,$id){
        $em = $this->getDoctrine()->getManager();
        $object = $em
                ->getRepository($resource)
                ->find($id);
        if (!$object) {
            throw $this->createNotFoundException('No ojbect found for id '.$id);
        }
        $em->remove($object);
        $em->flush();
    }
    public function addSectionAction(Request $request){
        $parentId = $request->query->get('parentid');
        
        $section = new Section();
        
        $em = $this->getDoctrine()->getManager();
        $MainComponent = $em
                ->getRepository('KweizarStoreBundle:MainComponent')
                ->find($parentId);
        if (!$MainComponent) {
            throw $this->createNotFoundException('No component found for id '.$parentId);
        }
        $form =  $this->createSectionForm($section);
        $form->handleRequest($request);
        $section->setParent($MainComponent);
        $em->persist($section);
        $em->flush();
        
        return $this->redirect($this->generateUrl('kweizar_page_author'));
                
    }
    public function addElementAction(Request $request){
        $sectionId = $request->query->get('sectionid');
        
        $element = new Element();
        
        $em = $this->getDoctrine()->getManager();
        $section = $em
                ->getRepository('KweizarStoreBundle:Section')
                ->find($sectionId);
        if (!$section) {
            throw $this->createNotFoundException('No section found for id '.$sectionId);
        }
        $form =  $this->createElementForm($element);
        $form->handleRequest($request);
        $element->setSection($section);
        
        $em->persist($element);
        $em->flush();
        
        return $this->redirect($this->generateUrl('kweizar_page_author'));
                
    }
    
    public function editElementAction(Request $request){
        $elementId = $request->query->get("elementid");
        
        $em = $this->getDoctrine()->getManager();
        $element = $em
                ->getRepository('KweizarStoreBundle:Element')
                ->find($elementId);
        
        if (!$element) {
            throw $this->createNotFoundException('No element found for id '.$id);
            
        }
            
        $form =  $this->createElementForm($element);
        $form->handleRequest($request);

        $em->flush();
        
        
        return $this->redirect($this->generateUrl('kweizar_page_author'));
    }
        
    
    private function createCurrentForm($element){
        return $this->createFormBuilder($element)
                ->add('description','text')
                ->add('content','text')
                ->add('url','text')
                ->add('save','submit',array('label'=>'Add Component'))
                ->getForm();
    }
    private function createSectionTypeForm($element){
        return $this->createFormBuilder($element)
                ->add('description','text')
                ->add('content','text')
                ->add('template','text')
                ->add('save','submit',array('label'=>'Add Section Type'))
                ->getForm();
    }
    
    private function createSectionForm($element){
        return $this->createFormBuilder($element)
                ->add('title','text')
                ->add('subTitle','text')
                ->add('sectionType', 'entity', array(
                    'class' => 'KweizarStoreBundle:SectionType',
                    'property' => 'description',))
                ->add('save','submit',array('label'=>'Add Section'))
                ->getForm();
    }
    private function createElementForm($element){
        return $this->createFormBuilder($element)
                ->add('imgSrc','text')
                ->add('title','text')
                ->add('description','text')
                ->add('destinationType', 'choice', array(
                    'choices' => array("image"=>"Image",
                        "iframe"=>"iframe(video)",
                        "inline"=>"inline(html)",
                        "ajax"=>"Ajax Request")))
                ->add('destinationContent','text')
                ->add('save','submit',array('label'=>'Add Element'))
                ->getForm();
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
