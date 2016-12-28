<?php

namespace Flair\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;

use Flair\CoreBundle\Form\DataTransformer\BooleanToStringTransformer;

/**
 * Yes no choice form type.
 */
class YesNoChoiceType extends AbstractType
{
    /**
     * @var \Flair\CoreBundle\Form\DataTransformer\BooleanToStringTransformer
     */
    protected $booleanToStringTransformer;

    /**
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected $translator;

    /**
     * Constructeur
     *
     * @param BooleanToStringTransformer $booleanToStringTransformer
     * @param TranslatorInterface $translator
     */
    public function __construct(BooleanToStringTransformer $booleanToStringTransformer, TranslatorInterface $translator)
    {
        $this->booleanToStringTransformer = $booleanToStringTransformer;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->addModelTransformer($this->booleanToStringTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $defaults = array(
            'choices'  => array(
                'yes' => $this->translator->trans('core.form.type.choice_list.yes'),
                'no'  => $this->translator->trans('core.form.type.choice_list.no')
            ),
            'expanded' => true,
        );

        $resolver->setDefaults($defaults);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'yes_no_choice';
    }
}
