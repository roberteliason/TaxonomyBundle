<?php
/**
 * Taxonomy entity type form field.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use SymfonyContrib\Bundle\TaxonomyBundle\Taxonomy;

class TermEntityType extends AbstractType
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
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choiceList = function (Options $options) {
            $terms = $this->taxonomy->getTermRepo()->getFlatTree($options['vocabulary']);
            return new ObjectChoiceList($terms, 'hierarchyLabel', [], null, 'id');
        };

        $resolver->setDefaults([
            'class' => 'TaxonomyBundle:Term',
            'vocabulary' => null,
            'choice_list' => $choiceList,
            'required' => false,
            'empty_value' => '[None]',
            'attr' => [
                'class' => 'term-parent-id'
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'taxonomy_term_entity';
    }
}
