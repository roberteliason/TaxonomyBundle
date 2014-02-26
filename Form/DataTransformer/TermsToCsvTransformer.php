<?php
/**
 * Transforms term objects to comma separated values for form fields.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use SymfonyContrib\Bundle\TaxonomyBundle\Taxonomy;

class TermsToCsvTransformer implements DataTransformerInterface
{
    /**
     * @var Taxonomy
     */
    protected $taxonomy;

    /**
     * @var string
     */
    protected $vocabName;

    /**
     * @var bool
     */
    protected $multiple;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @var string
     */
    protected $enclosure;

    public function __construct(array $options)
    {
        if (!is_object($options['taxonomy']) || !is_a($options['taxonomy'], 'SymfonyContrib\Bundle\TaxonomyBundle\Taxonomy')) {
            throw new TransformationFailedException('Taxonomy service option is missing.');
        }
        if (!is_string($options['vocabulary']) ) {
            throw new TransformationFailedException('Vocabulary option is missing.');
        }

        $this->taxonomy   = $options['taxonomy'];
        $this->vocabName  = $options['vocabulary'];
        $this->multiple   = $options['multiple'];
        $this->delimiter  = $options['delimiter'];
        $this->enclosure  = $options['enclosure'];
    }

    public function transform($terms)
    {
        if ($terms === null) {
            return '';
        }

        if ($this->multiple && !is_array($terms)) {
            throw new TransformationFailedException('Expected an array.');
        }

        if (!$this->multiple && !is_object($terms)) {
            throw new TransformationFailedException('Expected a term object.');
        }


        if ($this->multiple) {
            $array = [];
            foreach ($terms as $term) {
                $array[] = $term->getName();
            }
            $stream = fopen('php://memory', 'w+');
            fputcsv($stream, $array, $this->delimiter, $this->enclosure);
            rewind($stream);
            $value = stream_get_contents($stream);
            fclose($stream);
        } else {
            $value = $terms->getName();
        }

        return $value;
    }

    public function reverseTransform($value)
    {
        if ($value === null || $value === '') {
            return $this->multiple ? [] : null;
        }

        if (!is_string($value) ) {
            throw new TransformationFailedException('Expected a string.');
        }

        if ($this->multiple) {
            $values = str_getcsv($value);

            $terms = [];
            foreach ($values as $name) {
                $name = trim($name);
                $term = $this->taxonomy->getOrCreateTerm($name, $this->vocabName);
                $terms[$term->getId()] = $term;
            }

            return $terms;
        } else {
            return $this->taxonomy->getOrCreateTerm(trim($value), $this->vocabName);
        }
    }
}
