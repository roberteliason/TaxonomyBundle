<?php
/**
 * Allows initialization of model with an array of data.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Model\Traits;

trait ArraySetTrait
{
    /**
     * Set object properties from array values via setter methods.
     *
     * @param array $data
     */
    public function setByArray(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            $this->$method($value);
        }
    }
}
