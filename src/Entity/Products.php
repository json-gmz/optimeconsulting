<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
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
     * @ORM\Column(type="text", length=50)
     */
    private $mark;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $category;

    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $price;

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

    public function getmark()
    {
        return $this->mark;
    }

    public function getcategory()
    {
        return $this->category;
    }

    public function getprice()
    {
        return $this->price;
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

    public function setmark($mark)
    {
        $this->mark = $mark;
    }

    public function setcategory($category)
    {
        $this->category = $category;
    }

    public function setprice($price)
    {
        $this->price = $price;
    }
}
