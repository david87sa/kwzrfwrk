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
 * @ORM\Table(name="SECTION")
 */
class Section{
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $title;    
    
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $subTitle;

    /**
     * @ORM\ManyToOne(targetEntity="MainComponent",inversedBy="sections")
     * @ORM\JoinColumn(name="parent_id",referencedColumnName="id",nullable=false)
     */
    private $parent;
    
    /**
     * @ORM\ManyToOne(targetEntity="SectionType",inversedBy="section")
     * @ORM\JoinColumn(name="sectiontype_id",referencedColumnName="id",nullable=false)
     */
    private $sectiontype;
    
    /**
     * @ORM\OneToMany(targetEntity="Element",mappedBy="section",cascade={"persist"})
     */
    private $elements;
    
    public function __construct() {
        $this->elements=new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }


    public function setId($id) {
        $this->id = $id;
    }

       

    /**
     * Set title
     *
     * @param string $title
     * @return Section
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    function getSubTitle() {
        return $this->subTitle;
    }
    /**
     * Set title
     *
     * @param string $subTitle
     * @return Section
     */
    function setSubTitle($subTitle) {
        $this->subTitle = $subTitle;
    }

    
    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set parent
     *
     * @param \Kweizar\StoreBundle\Entity\MainComponent $parent
     * @return Section
     */
    public function setParent(\Kweizar\StoreBundle\Entity\MainComponent $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Kweizar\StoreBundle\Entity\MainComponent 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set sectiontype
     *
     * @param \Kweizar\StoreBundle\Entity\SectionType $sectiontype
     * @return Section
     */
    public function setSectiontype(\Kweizar\StoreBundle\Entity\SectionType $sectiontype)
    {
        $this->sectiontype = $sectiontype;

        return $this;
    }

    /**
     * Get sectiontype
     *
     * @return \Kweizar\StoreBundle\Entity\SectionType 
     */
    public function getSectiontype()
    {
        return $this->sectiontype;
    }

    /**
     * Add elements
     *
     * @param \Kweizar\StoreBundle\Entity\Element $elements
     * @return Section
     */
    public function addElement(\Kweizar\StoreBundle\Entity\Element $elements)
    {
        $this->elements[] = $elements;

        return $this;
    }

    /**
     * Remove elements
     *
     * @param \Kweizar\StoreBundle\Entity\Element $elements
     */
    public function removeElement(\Kweizar\StoreBundle\Entity\Element $elements)
    {
        $this->elements->removeElement($elements);
    }

    /**
     * Get elements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getElements()
    {
        return $this->elements;
    }
        
    /**
     * Set elements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setElements($elements)
    {
        return $this->addElement(new Element($elements));
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Section
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
