<?php
namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="animals")
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $scale;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $fur;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $feathers ;

    /**
    * @ORM\ManyToOne(targetEntity="Type", inversedBy="animals")
    * @var Type
    */
    private $type;


    public function getId()
    {
        return $this->id;
    }

    public function setName(String $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setScale(String $scale)
    {
        $this->scale = $scale;
    }

    public function getScale()
    {
        return $this->scale;
    }

    public function setFur(String $fur)
    {
        $this->fur = $fur;
    }

    public function getFur()
    {
        return $this->fur;
    }

    public function setFeathers(String $feathers)
    {
        $this->feathers = $feathers;
    }

    public function getFeathers()
    {
        return $this->feathers;
    }

    public function setType(Type $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function hiss()
    {
      if ($this->type->getId() == 1) {
        return "je suis un(e) ".$this->name." et mes écailles sont ".$this->scale.".";
      }
    }

    public function growl()
    {
      if ($this->type->getId() == 2) {
        return "je suis un(e) ".$this->name." et ma fourrure est ".$this->fur.".";
      }
    }

    public function tweet()
    {
      if ($this->type->getId() == 3) {
        return "je suis un(e) ".$this->name." et mon plumage est ".$this->feathers.".";
      }
    }
}
