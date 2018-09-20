<?php

namespace Lavulator\ViewsCounterBundle\Model;

interface VisitableManagerInterface
{
    /**
     * Update views of the visitable object/entity.
     *
     * @param VisitableInterface $visitable
     */
    public function update(VisitableInterface $visitable);
}
