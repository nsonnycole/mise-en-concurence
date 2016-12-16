<?php

namespace Flair\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Représente une catégorie.
 *
 * @ORM\Entity(repositoryClass = "Flair\UserBundle\Repository\CategoriePrestatairesRepository")
 * @ORM\Table(name = "categories_prestataires")
 */
class CategoriePrestataire
{
    /**
     * @var integer L'identifiant de la catégorie.
     *
     * @ORM\Id
     * @ORM\Column(type = "integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var String Le nom de la catégorie.
     *
     * @ORM\Column(type = "string")
     */
    private $nom;

    /**
     * @ORM\ManyToOne(
     *     targetEntity = "Flair\UserBundle\Entity\CategoriePrestataire",
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
     * @var ArrayCollection La liste des catégories filles.
     *
     * @ORM\OneToMany(
     *     targetEntity = "Flair\UserBundle\Entity\CategoriePrestataire",
     *     mappedBy     = "parent",
     *     cascade      = { "persist" }
     * )
     */
    private $sousCategories;

    /**
     * Initialisation de la liste de catégories.
     */
    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
    }

    /**
     * REtourne le nom complet.
     */
    public function getFullName()
    {
        $helper = function ($categorie) use (&$helper) {
            if ($categorie->getParent() == null) {
                return $categorie->geTNom();
            } else {
                return $helper($categorie->getParent()) . ' / ' . $categorie->getNom();
            }
        };

        return $helper($this);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
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
