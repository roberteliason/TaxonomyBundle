<?php
/**
 * Doctrine ORM repository for taxonomy vocabularies.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Entity\Repository\Traits;

use SymfonyContrib\Bundle\TaxonomyBundle\Entity\Vocabulary;

trait VocabularyRepositoryTrait
{
    public function createVocabulary($name, $data = [], $flush = true)
    {
        $data['name'] = $name;
        $vocab = new Vocabulary($data);

        $this->em->persist($vocab);
        if ($flush) {
            $this->em->flush($vocab);
        }

        // @todo: Fire event.

        return $vocab;
    }

    public function createVocabularies(array $vocabularies)
    {
        $entities = [];
        foreach ($vocabularies as $vocab) {
            $entities[] = $this->createVocabulary($vocab['name'], $vocab, false);
        }

        $this->em->flush();

        return $entities;
    }

    public function deleteVocabulary($name)
    {
        $dql = "DELETE TaxonomyBundle:Vocabulary v
                WHERE v.name = :name";

        $this->em->createQuery($dql)
            ->execute(['name' => $name]);

        // @todo: Fire event.
    }

    public function deleteVocabularies(array $names)
    {
        $dql = "DELETE TaxonomyBundle:Vocabulary v
                WHERE v.name IN (:names)";

        $this->em->createQuery($dql)
            ->execute(['names' => $names]);

        // @todo: Fire event.
    }

    /**
     * @param $name
     *
     * @return Vocabulary|null
     */
    public function getVocabulary($name)
    {
        $dql = "SELECT v
                FROM TaxonomyBundle:Vocabulary v
                WHERE v.name = :name";

        return $this->em->createQuery($dql)
            ->setParameter('name', $name)
            ->getOneOrNullResult();
    }

    public function getVocabularies(array $names = [])
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('v')
            ->from('TaxonomyBundle:Vocabulary', 'v');

        if (!empty($names)) {
            $qb->where('v.name IN (:names)');
            $qb->setParameter('names', $names);
        }

        return $qb->getQuery()->getResult();
    }
}
