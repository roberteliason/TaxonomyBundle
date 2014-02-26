<?php
/**
 * Form for ordering/sorting terms in a hierarchy.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use SymfonyContrib\Bundle\TaxonomyBundle\Form\Type\TermSortType;

class TermsSortForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('terms', 'collection', [
                'type' => new TermSortType(),
                'label' => false,
                'options' => [
                    'vocabulary' => $options['vocabulary'],
                ],
            ])
            ->add('save', 'submit', [
                'attr' => [
                    'class' => 'btn-success',
                ],
            ])
            ->add('reset', 'button', [
                'url' => $options['cancel_url'],
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'cancel_url' => '/',
            'vocabulary' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'taxonomy_terms_sort_form';
    }
}
