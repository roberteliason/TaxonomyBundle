<?php
/**
 * Taxonomy choice type form field.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use SymfonyContrib\Bundle\TaxonomyBundle\Taxonomy;

class TaxonomyChoiceType extends AbstractType
{
    /**
     * @var Taxonomy
     */
    public $taxonomy;

    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $terms = $this->taxonomy->getTermRepo()->getFlatTree($options['vocabulary']);
        $builder->add($options['vocabulary'], 'choice', [
            'choice_list' => new ObjectChoiceList($terms, 'name', [], null, 'id'),
            'expanded' => true,
            'multiple' => true,
            'label' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'inherit_data' => true,
            'vocabulary' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'form';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'taxonomy_choice';
    }
}
