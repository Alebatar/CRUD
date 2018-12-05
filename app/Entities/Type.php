<?php
namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="type")
 */
class Type
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
    private $libelle;

    /**
    * @ORM\OneToMany(targetEntity="Animal", mappedBy="type", cascade={"persist"})
    * @var ArrayCollection|Animal[]
    */
    protected $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setAnimals(Type $animal)
    {
        if(!$this->animals->contains($animal)) {
            $animal->setType($this);
            $this->animals->add($animal);
        }
    }

    public function getAnimals()
    {
        return $this->animals;
    }
}
