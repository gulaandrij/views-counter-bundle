<?php

namespace Lavulator\ViewsCounterBundle\Model;

interface ViewsCounterInterface
{
    /**
     * Count singular and plural views and update the document/entity.
     *
     * @param VisitableInterface $visitable
     */
    public function count(VisitableInterface $visitable);
}
