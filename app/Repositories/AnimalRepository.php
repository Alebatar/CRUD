<?php
namespace App\Repositories;

use App\Entities\Animal;
use Doctrine\ORM\EntityManager;

class AnimalRepository{

    /**
     * @var string
     */
    private $class = 'App\Entities\Animal';
    /**
     * @var EntityManager
     */
    private $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save($object)
    {
        $this->em->persist($object);
        $this->em->flush($object);
        return $object;
    }

    public function delete($object)
    {
        $this->em->remove($object);
        $this->em->flush($object);
        return true;
    }
}
