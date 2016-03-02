<?php
/**
 * Form for creating/editing a vocabulary.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VocabularyForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', 'text', [
                'trim' => true,
            ])
            ->add('desc', 'textarea', [
                'required' => false,
                'trim' => true,
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
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'SymfonyContrib\\Bundle\\TaxonomyBundle\\Entity\\Vocabulary',
//            'cancel_url' => '/',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'taxonomy_vocabulary_form';
    }
}
