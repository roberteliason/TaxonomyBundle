<?php
/**
 * Interface for taxonomy supporting models.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Model;

use SymfonyContrib\Bundle\TaxonomyBundle\Taxonomy;

interface TaxonomyOwnerInterface
{
    /**
     * @return string
     */
    public function getTaxonomyOwner();

    /**
     * @return mixed
     */
    public function getTaxonomyOwnerId();

    /**
     * @return Taxonomy
     */
    public function getTaxonomy();

    /**
     * @return array
     */
    public function getTerms();
}
