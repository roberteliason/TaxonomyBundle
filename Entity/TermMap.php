<?php
/**
 *
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Entity;

use SymfonyContrib\Bundle\TaxonomyBundle\Model\Traits\ArraySetTrait;

class TermMap
{
    use ArraySetTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $termId;

    /**
     * @var string
     */
    protected $owner;

    /**
     * @var string
     */
    protected $ownerId;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var Term
     */
    protected $term;


    /**
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        $this->created = new \DateTime();

        if ($data !== null) {
            $this->setByArray($data);
        }
    }

    /**
     * @param \DateTime $created
     * @return TermMap
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $id
     * @return TermMap
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $owner
     * @return TermMap
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param string $ownerId
     * @return TermMap
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * @return string
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @param string $termId
     * @return TermMap
     */
    public function setTermId($termId)
    {
        $this->termId = $termId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTermId()
    {
        return $this->termId;
    }

    /**
     * @param Term $term
     * @return TermMap
     */
    public function setTerm(Term $term)
    {
        $this->term   = $term;
        $this->termId = $term->getId();

        return $this;
    }

    /**
     * @return Term
     */
    public function getTerm()
    {
        return $this->term;
    }
}
