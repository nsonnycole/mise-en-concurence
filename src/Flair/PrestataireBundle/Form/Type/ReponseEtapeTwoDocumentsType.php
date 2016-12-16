<?php

namespace Flair\PrestataireBundle\Form\Type;

use Flair\CoreBundle\Form\Type\PdfDocumentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Envoi d'un devis personnel.
 */
class ReponseEtapeTwoDocumentsType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montantHt', 'money', array(
                'label' => 'Montant HT',
                'precision' => 0
            ))
            ->add('montantTtc', 'money', array(
                'label' => 'Montant TTC',
                'precision' => 0
            ))
            ->add('devisDocument', new PdfDocumentType(), array(
                'label' => 'Votre devis'
            ));
    }

    /**
     * Definition des valeurs par defaut.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Flair\PrestataireBundle\Model\ReponseEtapeTwo',
            'validation_groups' => array('with_documents', 'pdf')
        ));
    }


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'etape_2_documents_type';
    }
}
