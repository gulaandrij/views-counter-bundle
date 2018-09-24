<?php

namespace Lavulator\ViewsCounterBundle\Traits;

trait VisitableDocumentTrait
{

    /**
     * @var int
     *
     * @ODM\Column(name="view_count_singular", type="integer")
     */
    protected $singularViewCount = 0;

    /**
     * @var int
     *
     * @ODM\Column(name="view_count_plural", type="integer")
     */
    protected $pluralViewCount = 0;

    /**
     * @var bool
     */
    private $singularViewed = false;

    /**
     * @var bool
     */
    private $pluralViewed = false;

    /**
     * Unique visitable id for every user.
     *
     * @return string
     */
    public function getVisitorId(): string
    {
        if (\is_callable([$this, 'getId'])) {
            return sprintf('%s', $this->getId());
        }

        return uniqid('visitable', true);
    }

    /**
     * Visitable name for every object/entity.
     *
     * @return string
     */
    public function getVisitable(): string
    {
        return strtolower(static::class);
    }

    /**
     * @return bool
     */
    public function isSingularViewed(): bool
    {
        return $this->singularViewed;
    }

    /**
     * @return bool
     */
    public function isPluralViewed(): bool
    {
        return $this->pluralViewed;
    }

    /**
     * @return int
     */
    public function getSingularViewCount(): int
    {
        return $this->singularViewCount;
    }

    /**
     * @param int $singularViewCount
     *
     * @return $this
     */
    public function setSingularViewCount($singularViewCount): self
    {
        $this->singularViewCount = $singularViewCount;

        return $this;
    }

    /**
     * Increase the number of unique views.
     *
     * @return int
     */
    public function onSingularViewed(): int
    {
        return $this->singularViewCount++;
    }

    /**
     * @return int
     */
    public function getPluralViewCount(): int
    {
        return $this->pluralViewCount;
    }

    /**
     * @param int $pluralViewCount
     *
     * @return $this
     */
    public function setPluralViewCount($pluralViewCount): self
    {
        $this->pluralViewCount = $pluralViewCount;

        return $this;
    }

    /**
     * Increase the number of plural views.
     *
     * @return int
     */
    public function onPluralViewed(): int
    {
        return $this->pluralViewCount++;
    }
}
