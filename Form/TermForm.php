<?php
/**
 * Form for creating/editing terms.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TermForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'trim' => true,
            ])
            ->add('desc', 'textarea', [
                'required' => false,
                'trim' => true,
            ])
            ->add('parent', 'taxonomy_term_entity', [
                'class' => 'TaxonomyBundle:Term',
                'vocabulary' => $options['vocabulary'],
            ])
            ->add('save', 'submit', [
                'attr' => [
                    'class' => 'btn-success',
                ]
            ]);
//            ->add('cancel', 'button', [
//                'url' => $options['cancel_url'],
//            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'SymfonyContrib\\Bundle\\TaxonomyBundle\\Entity\\Term',
            'vocabulary' => null,
            //'cancel_url' => '/',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'taxonomy_term_form';
    }
}
