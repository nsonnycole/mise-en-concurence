<?php

namespace Flair\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Représente la catégorie des organisme.
 *
 * @ORM\Entity(repositoryClass = "Flair\UserBundle\Repository\CategorieOrganismesRepository")
 * @ORM\Table(name = "categories_organismes")
 */
class CategorieOrganisme
{
    /**
     * @var integer L'identifient technique de la catégorie.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name = "id", type = "integer")
     */
    private $id;

    /**
     * @var string Le nom de la catégorie.
     *
     * @ORM\Column(type = "string")
     */
    private $nom;

    /**
     * @ORM\ManyToOne(
     *     targetEntity = "Flair\UserBundle\Entity\CategorieOrganisme",
     *     inversedBy   = "sousCategories",
     *     cascade      = { "persist" }
     * )
     * @ORM\JoinColumn(
     *      name     = "id_categorie_parent",
     *      onDelete = "cascade"
     * )
     */
    private $parent;

    /**
     * @var ArrayCollection La liste des sous catégories.
     *
     * @ORM\OneToMany(
     *     targetEntity = "Flair\UserBundle\Entity\CategorieOrganisme",
     *     mappedBy     = "parent",
     *     cascade      = { "persist" }
     * )
     */
    private $sousCategories;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $sousCategories
     */
    public function setSousCategories($sousCategories)
    {
        $this->sousCategories = $sousCategories;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSousCategories()
    {
        return $this->sousCategories;
    }
}
