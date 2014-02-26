<?php
/**
 * Default taxonomy listing pages.
 */

namespace SymfonyContrib\Bundle\TaxonomyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Provides pages for administration of the taxonomy system.
 */
class PublicController extends Controller
{

    /**
     * Not Complete.
     * List of the content associated with a term.
     *
     * @param string $vocab Machine name of vocabulary.
     * @param string $term Name of term.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function termContentListAction($vocab, $term)
    {
        $taxonomy = $this->get('taxonomy');
        /*
        $entities = $taxonomy->getMapsByTerm('App\WealthProfileContentBundle\Entity\Profile', $vocab, $term);

        return $this->render('TaxonomyBundle:Public:term-content-list.html.twig', [
            'term' => $term,
            'entities' => $entities,
        ]);
        */
    }
}
