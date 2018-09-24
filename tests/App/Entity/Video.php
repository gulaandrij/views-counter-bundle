<?php

namespace Tests\App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lavulator\ViewsCounterBundle\Model\VisitableInterface;
use Lavulator\ViewsCounterBundle\Traits\VisitableEntityTrait;

/**
 * @ORM\Entity(repositoryClass="VideoRepository")
 */
class Video implements VisitableInterface
{
    use VisitableEntityTrait;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", columnDefinition="INTEGER PRIMARY KEY AUTOINCREMENT")
     */
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
