<?php
/**
 * Form type for ordering terms.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TermSortType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'hidden', [
                'disabled' => true,
                'label' => false,
                'attr' => [
                    'class' => 'term-id',
                ],
            ])
            ->add('parent', 'taxonomy_term_entity', [
                'vocabulary' => $options['vocabulary'],
            ])
            ->add('path', 'text', [
                'attr' => [
                    'class' => 'term-path'
                ],
            ])
            ->add('weight', 'integer', [
                'attr' => [
                    'class' => 'term-weight'
                ],
            ])
            ->add('level', 'integer', [
                'attr' => [
                    'class' => 'term-level'
                ],
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'SymfonyContrib\\Bundle\\TaxonomyBundle\\Entity\\Term',
            'vocabulary' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'taxonomy_term_sort';
    }
}
