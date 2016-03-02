<?php
/**
 *
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\Collections\ArrayCollection;
use SymfonyContrib\Bundle\TaxonomyBundle\Model\Traits\ArraySetTrait;

class Term
{
    use ArraySetTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $desc;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var Vocabulary
     */
    protected $vocabulary;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var \SymfonyContrib\Bundle\TaxonomyBundle\Entity\TermMap
     */
    protected $map;

    /**
     * @var null|Term
     */
    protected $parent;

    /**
     * @var ArrayCollection
     */
    protected $children;


    /**
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        $this->desc = '';
        $this->weight = 0;
        $this->level = 0;
        $this->created = new \DateTime();
        $this->children = new ArrayCollection();

        if ($data !== null) {
            $this->setByArray($data);
        }
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Doctrine lifecycle callback.
     *
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        if (!$args->hasChangedField('updated')) {
            $this->updated = new \DateTime();
        }
    }

    /**
     * @param \DateTime $created
     * @return Term
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
     * @param string $desc
     * @return Term
     */
    public function setDesc($desc)
    {
        $this->desc = $desc ?: '';

        return $this;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param string $id
     * @return Term
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
     * @param string $name
     * @return Term
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \DateTime $updated
     * @return Term
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param Vocabulary $vocabulary
     * @return Term
     */
    public function setVocabulary($vocabulary)
    {
        $this->vocabulary = $vocabulary;

        return $this;
    }

    /**
     * @return \SymfonyContrib\Bundle\TaxonomyBundle\Entity\Vocabulary
     */
    public function getVocabulary()
    {
        return $this->vocabulary;
    }

    /**
     * @param int $weight
     * @return Term
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param TermMap $map
     * @return Term
     */
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * @return \SymfonyContrib\Bundle\TaxonomyBundle\Entity\TermMap
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param ArrayCollection $children
     * @return Term
     */
    public function setChildren(ArrayCollection $children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param int $level
     * @return Term
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param null|Term $parent
     * @return Term
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return null|Term
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param string $path
     * @return Term
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the name prepended by level to show hierarchy.
     *
     * @param string $levelCharacter
     * @return string
     */
    public function getHierarchyLabel($levelCharacter = '--')
    {
        return str_repeat($levelCharacter, $this->level) . ' ' . $this->getName();
    }

}
