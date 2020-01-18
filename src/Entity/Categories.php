<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=15)
     */
    private $code;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=250)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    private $active;

    // Getters & Setter
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getcode()
    {
        return $this->code;
    }

    public function getname()
    {
        return $this->name;
    }

    public function getdescription()
    {
        return $this->description;
    }

    public function getactive()
    {
        return $this->active;
    }

    public function setcode($code)
    {
        $this->code = $code;
    }

    public function setname($name)
    {
        $this->name = $name;
    }

    public function setdescription($description)
    {
        $this->description = $description;
    }

    public function setactive($active)
    {
        $this->active = $active;
    }
}
