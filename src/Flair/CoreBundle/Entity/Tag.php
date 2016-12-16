<?php

namespace Flair\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Représente un tag (un mot cléf).
 *
 * @ORM\Entity
 * @ORM\Table(name = "tags")
 */
class Tag
{
    /**
     * @var integer L'identifiant technique du tag.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name = "id", type = "integer")
     */
    private $id;

    /**
     * @var String Le nom du mot cléf.
     *
     * @ORM\Column(
     *      name   = "name",
     *      type   = "string",
     *      length = 255
     * )
     */
    private $name;

    /**
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
