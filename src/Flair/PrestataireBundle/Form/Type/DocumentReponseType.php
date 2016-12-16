<?php

namespace Flair\PrestataireBundle\Form\Type;

use Flair\CoreBundle\Form\Type\DocumentType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Extension de documenttype.
 */
class DocumentReponseType extends DocumentType
{
    /**
     * @inheritdoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_groups' => array('consultation', 'Default')
        ));
    }
}
