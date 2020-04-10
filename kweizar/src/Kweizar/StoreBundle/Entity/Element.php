<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Kweizar\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ELEMENT")
 */
class Element{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\ManyToOne(targetEntity="Section",inversedBy="elements")
     * @ORM\JoinColumn(name="section_id",referencedColumnName="id",nullable=false)
     */
    private $section;
    
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $imgSrc;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;
        
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $destinationType;
    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $destinationContent;
    
    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }


    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
    function getImgSrc() {
        return $this->imgSrc;
    }

    function getTitle() {
        return $this->title;
    }

    function getDestinationType() {
        return $this->destinationType;
    }

    function getDestinationContent() {
        return $this->destinationContent;
    }

    function setImgSrc($imgSrc) {
        $this->imgSrc = $imgSrc;
        return $this;
    }

    function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    function setDestinationType($destinationType) {
        $this->destinationType = $destinationType;
        return $this;
    }

    function setDestinationContent($destinationContent) {
        $this->destinationContent = $destinationContent;
        return $this;
    }

    
       

    /**
     * Set section
     *
     * @param \Kweizar\StoreBundle\Entity\Section $section
     * @return Element
     */
    public function setSection(\Kweizar\StoreBundle\Entity\Section $section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Kweizar\StoreBundle\Entity\Section 
     */
    public function getSection()
    {
        return $this->section;
    }
}
