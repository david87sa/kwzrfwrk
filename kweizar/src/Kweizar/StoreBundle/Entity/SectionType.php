<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kweizar\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="SECTION_TYPE")
 */
class SectionType{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $template;
        /**
     * @ORM\Column(type="string", length=500)
     */
    private $content;
    
    /**
     * @ORM\OneToMany(targetEntity="Section",mappedBy="sectionType")
     */
    private $sections;
    
    public function __construct() {
        $this->sections= new ArrayCollection();
    }
    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getContent() {
        return $this->content;
    }
    public function getTemplate(){
        return $this->template;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setContent($content) {
        $this->content = $content;
    }
    public function setTemplate($template){
        $this->template = $template;
    }


        /**
     * Add sections
     *
     * @param \Kweizar\StoreBundle\Entity\Section $sections
     * @return SectionType
     */
    public function addSection(\Kweizar\StoreBundle\Entity\Section $sections)
    {
        $this->sections[] = $sections;

        return $this;
    }

    /**
     * Remove sections
     *
     * @param \Kweizar\StoreBundle\Entity\Section $sections
     */
    public function removeSection(\Kweizar\StoreBundle\Entity\Section $sections)
    {
        $this->sections->removeElement($sections);
    }

    /**
     * Get sections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSections()
    {
        return $this->sections;
    }
}
