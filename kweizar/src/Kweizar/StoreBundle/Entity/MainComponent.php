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
 * @ORM\Entity(repositoryClass="Kweizar\StoreBundle\Entity\MainComponentRepository")
 * @ORM\Table(name="MAIN_COMPONENT")
 */
class MainComponent{
    
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
    private $content;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $url;
    
    /**
     * @ORM\OneToMany(targetEntity="Section",mappedBy="parent",cascade={"persist"})
     */
    private $sections;
    
    public function __construct() {
        $this->sections=new ArrayCollection();
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

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setContent($content) {
        $this->content = $content;
    }

       

    /**
     * Set url
     *
     * @param string $url
     * @return MainComponent
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Add sections
     *
     * @param \Kweizar\StoreBundle\Entity\Section $sections
     * @return MainComponent
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
