<?php

namespace Lavulator\ViewsCounterBundle\Manager;

use Lavulator\ViewsCounterBundle\Model\ViewsCounterInterface;
use Lavulator\ViewsCounterBundle\Model\VisitableInterface;
use Lavulator\ViewsCounterBundle\Model\VisitableManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class CookieViewsCounter
 *
 * @package Lavulator\ViewsCounterBundle\Manager
 */
class CookieViewsCounter implements ViewsCounterInterface
{
    public const COOKIE_KEY = '_views_counter';

    /**
     * @var VisitableManagerInterface
     */
    private $visitableManager;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @param RequestStack              $requestStack
     * @param VisitableManagerInterface $visitableManager
     */
    public function __construct(RequestStack $requestStack, VisitableManagerInterface $visitableManager)
    {
        $this->visitableManager = $visitableManager;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param VisitableInterface $visitable
     */
    public function count(VisitableInterface $visitable): void
    {
        $viewsCookie = $this->request->cookies->get(self::COOKIE_KEY);

        if (null === $viewsCookie) { // unique view
            $viewsCookie = [];
            $this->saveVisitable($viewsCookie, $visitable);

            $visitable->onUniqueViewed();
        } elseif (!isset($viewsCookie[$visitable->getVisitable()][$visitable->getVisitorId()])) { // unique view
            $this->saveVisitable($viewsCookie, $visitable);

            $visitable->onUniqueViewed();
        } elseif (isset($viewsCookie[$visitable->getVisitable()][$visitable->getVisitorId()])) { // plural view
            $visitable->onPluralViewed();
        }

        $this->visitableManager->update($visitable);
    }

    /**
     * @param array              $viewsCookie
     * @param VisitableInterface $visitable
     */
    private function saveVisitable(array $viewsCookie, $visitable): void
    {
        $viewsCookie[$visitable->getVisitable()] = [];

        $this->saveVisitorId($viewsCookie, $visitable);
    }

    /**
     * @param array              $viewsCookie
     * @param VisitableInterface $visitable
     */
    private function saveVisitorId(array $viewsCookie, $visitable): void
    {
        $viewsCookie[$visitable->getVisitable()][$visitable->getVisitorId()] = $visitable->getVisitorId();

//        $c = new Cookie(self::COOKIE_KEY,$viewsCookie);
    }
}
