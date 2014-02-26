<?php
/**
 * @todo Not complete!
 *
 * Attempt to create a single form field type that will determine the user
 * facing widget via options.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use SymfonyContrib\Bundle\TaxonomyBundle\Form\DataTransformer\TermsToCsvTransformer;

class TaxonomyType extends AbstractType
{
    public $taxonomy;

    public function __construct($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options['taxonomy'] = $this->taxonomy;

        switch ($options['widget']) {
            case 'text':
                $textOptions = [
                    'max_length' => $options['max_length'],
                    'required' => $options['required'],
                    'label' => $options['label'],
                    'trim' => $options['trim'],
                    'read_only' => $options['read_only'],
                    'disabled' => $options['disabled'],
                    'error_bubbling' => $options['error_bubbling'],
                    'error_mapping' => $options['error_mapping'],
                    'mapped' => $options['mapped'],
                    //'value' => $options['value'],
                    //'widget_attributes' => $options['widget_attributes'],
                ];
                $builder
                    ->addModelTransformer(new TermsToCsvTransformer($options));
                break;

            case 'select':
                //var_dump($builder->getData());die;
                $selectOptions = [
                    'required' => $options['required'],
                    'label' => $options['label'],
                    'read_only' => $options['read_only'],
                    'disabled' => $options['disabled'],
                    'error_bubbling' => $options['error_bubbling'],
                    'error_mapping' => $options['error_mapping'],
                    'mapped' => $options['mapped'],
                    'inherit_data' => $options['inherit_data'],
                    'by_reference' => $options['by_reference'],
                    'empty_data' => $options['empty_data'],
                    'choices' => [
                        't' => 'test',
                        't2' => 'test2',
                    ],
                    'expanded' => false,
                    'multiple' => false,
                ];
                break;

            case 'checkboxes':
            case 'radios':
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, array(
            'widget' => $options['widget'],
            'choices' => [
                't' => 'test',
                't2' => 'test2',
            ],
            'preferred_choices' => null,
            'expanded' => false,
            'multiple' => false,
            'empty_value' => null,
        ));

    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => 'App\WealthProfileContentBundle\Entity\Profile',
            'vocabulary' => null,
            'delimiter' => ',',
            'enclosure' => '"',
            'widget' => 'text',
            'compound' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'taxonomy';
    }
}
