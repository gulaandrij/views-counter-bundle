<?php

namespace Lavulator\ViewsCounterBundle\Manager;

use Lavulator\ViewsCounterBundle\Model\ViewsCounterInterface;
use Lavulator\ViewsCounterBundle\Model\VisitableInterface;
use Lavulator\ViewsCounterBundle\Model\VisitableManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class SessionViewsCounter
 *
 * @package Lavulator\ViewsCounterBundle\Manager
 */
class SessionViewsCounter implements ViewsCounterInterface
{
    public const SESSION_KEY = '_views_counter';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var VisitableManagerInterface
     */
    private $visitableManager;

    /**
     * @param SessionInterface          $session
     * @param VisitableManagerInterface $visitableManager
     */
    public function __construct(SessionInterface $session, VisitableManagerInterface $visitableManager)
    {
        $this->session          = $session;
        $this->visitableManager = $visitableManager;
    }

    /**
     * @param VisitableInterface $visitable
     */
    public function count(VisitableInterface $visitable): void
    {
        $viewsSession = $this->session->get(self::SESSION_KEY);

        if (null === $viewsSession) { // unique view
            $viewsSession = [];
            $this->saveVisitable($viewsSession, $visitable);

            $visitable->onUniqueViewed();
        } elseif (!isset($viewsSession[$visitable->getVisitable()][$visitable->getVisitorId()])) { // unique view
            $this->saveVisitable($viewsSession, $visitable);

            $visitable->onUniqueViewed();
        } elseif (isset($viewsSession[$visitable->getVisitable()][$visitable->getVisitorId()])) { // plural view
            $visitable->onPluralViewed();
        }

        $this->visitableManager->update($visitable);
    }

    /**
     * @param array              $viewsSession
     * @param VisitableInterface $visitable
     */
    private function saveVisitable(array $viewsSession, $visitable): void
    {
        $viewsSession[$visitable->getVisitable()] = [];

        $this->saveVisitorId($viewsSession, $visitable);
    }

    /**
     * @param array              $viewsSession
     * @param VisitableInterface $visitable
     */
    private function saveVisitorId(array $viewsSession, $visitable): void
    {
        $viewsSession[$visitable->getVisitable()][$visitable->getVisitorId()] = $visitable->getVisitorId();

        $this->session->set(self::SESSION_KEY, $viewsSession);
    }
}
