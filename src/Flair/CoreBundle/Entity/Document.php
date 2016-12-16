<?php

namespace Flair\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document attaché à une demande de consultation.
 *
 * @ORM\Entity
 * @ORM\Table(name = "documents")
 *
 * @Vich\Uploadable
 */
class Document
{
    /**
     * @var integer Le document uploadé.
     *
     * @ORM\Id
     * @ORM\Column(
     *      name = "id_document",
     *      type = "integer"
     * )
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var String Le titre associé au document.
     *
     * @ORM\Column(
     *      name     = "titre",
     *      type     = "string",
     *      nullable = true
     * )
     *
     * @Assert\NotBlank(groups = { "consultation"})
     */
    private $titre;

    /**
     * @Assert\File(
     *      maxSize          = "5M"
     * )
     * @Vich\UploadableField(
     *      mapping          = "document",
     *      fileNameProperty = "filename"
     * )
     */
    private $document;

    /**
     * @var String Le nom du fichier
     *
     * @ORM\Column(
     *      name   = "filename",
     *      type   = "string",
     *      length = 255
     * )
     */
    private $filename;

    /**
     * @var \DateTime La date d'upload du fichier.
     *
     * @ORM\Column(
     *      name = "date_upload",
     *      type = "datetime"
     * )
     */
    private $dateUpload;

    /**
     * Initialisation de la date d'upload.
     */
    public function __construct()
    {
        $this->dateUpload = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param String $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return String
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param String $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return String
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param \DateTime $dateUpload
     */
    public function setDateUpload($dateUpload)
    {
        $this->dateUpload = $dateUpload;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpload()
    {
        return $this->dateUpload;
    }
}
