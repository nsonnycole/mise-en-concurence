<?php

namespace Flair\CoreBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Extension de la classe document pour y ajouter une contrainte pdf.
 */
class PdfDocumentType extends DocumentType
{
    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array('pdf'),
            'data_class'        => 'Flair\CoreBundle\Entity\Document'
        ));
    }
}
