<?php
/**
 * Default implementation of TaxonomyOwnerInterface.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Model;

use SymfonyContrib\Bundle\TaxonomyBundle\Taxonomy;
use SymfonyContrib\Bundle\TaxonomyBundle\Entity\Term;
use Doctrine\Common\Collections\ArrayCollection;

trait TaxonomyOwnerTrait
{
    /**
     * @var Taxonomy
     */
    protected $taxonomy;

    /**
     * @var array
     */
    protected $terms;

    /**
     * @return Taxonomy
     */
    public function getTaxonomy()
    {
        global $kernel;
        return $this->taxonomy ?: $this->taxonomy = $kernel->getContainer()->get('taxonomy');
    }

    /**
     * Default the taxonomy owner to the class name.
     *
     * @return string
     */
    public function getTaxonomyOwner()
    {
        return get_called_class();
    }

    /**
     * Default ownerId to getId method or id property.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getTaxonomyOwnerId()
    {
        if (method_exists($this, 'getId')) {
            return $this->getId();
        } elseif (property_exists($this, 'id')) {
            return $this->id;
        } else {
            throw new \Exception('Taxonomy OwnerId needs to be set.');
        }
    }

    /**
     * Get all terms mapped to this content.
     *
     * @param null|string $vocabName
     * @return array
     */
    public function getTerms($vocabName = null)
    {
        // Lazy load terms.
        if (empty($this->terms) && $this->getTaxonomyOwnerId()) {
            $taxonomy = $this->getTaxonomy();
            $this->terms = $taxonomy->getMappedTerms($this->getTaxonomyOwner(), $this->getTaxonomyOwnerId());
        }

        if ($vocabName) {
            return isset($this->terms[$vocabName]) ? $this->terms[$vocabName] : [];
        } else {
            return $this->terms ?: [];
        }
    }

    /**
     * Get the vocabularies of terms that are mapped to this content.
     *
     * @return array
     */
    public function getVocabularies()
    {
        return array_keys($this->terms);
    }

    /**
     * Add/Map a term to this content. Create term if it does not exist.
     *
     * @param string|Term $term
     * @param string $vocabName
     * @return Term
     */
    public function addTerm($term, $vocabName)
    {
        $taxonomy = $this->getTaxonomy();
        if (is_string($term)) {
            $term = $taxonomy->getOrCreateTerm($term, $vocabName);
        }

        if ($this->getTaxonomyOwnerId()) {
            $taxonomy->mapTerm($term, $this);
        }

        if ($this->terms === null) {
            $this->terms = [];
        }
        $this->terms[$vocabName][$term->getId()] = $term;

        return $term;
    }

    /**
     * Add/map multiple terms to this content.
     *
     * @param array $terms
     * @param string $vocabName
     * @param bool $replace
     */
    public function addTerms(array $terms, $vocabName, $replace = false)
    {
        if ($replace && $this->getTaxonomyOwnerId()) {
            $this->removeAllTerms($vocabName);
        }

        $result = [];
        foreach ($terms as $term) {
            $result[] = $this->addTerm($term, $vocabName);
        }

        $this->terms[$vocabName] = $result;
    }

    /**
     * Remove/unmap a term from this content.
     *
     * @param string $name
     * @param string $vocabName
     */
    public function removeTerm($name, $vocabName)
    {
        $taxonomy = $this->getTaxonomy();
        $term = $taxonomy->getTermRepo()->getTerm($name, $vocabName);
        $taxonomy->unmapTerm($term, $this);
    }

    /**
     * Remove multiple terms from this content.
     *
     * @todo
     */
    public function removeTerms()
    {}

    /**
     * Remove all terms from this content.
     *
     * @param string|null $vocabName
     */
    public function removeAllTerms($vocabName = null)
    {
        $taxonomy = $this->getTaxonomy();
        if ($vocabName) {
            $taxonomy->unmapAllTerms($this, 'ownerId', $vocabName);
        } else {
            $taxonomy->unmapAllTerms($this, 'ownerId');
        }
    }
}
