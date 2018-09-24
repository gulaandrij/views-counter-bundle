<?php

namespace Lavulator\ViewsCounterBundle\Traits;

use Doctrine\ORM\Mapping as ORM;

trait VisitableEntityTrait
{

    /**
     * @var int
     *
     * @ORM\Column(name="view_count_singular", type="integer", options={"default":"0"})
     */
    protected $singularViewCount = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="view_count_plural", type="integer", options={"default":"0"})
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
        $this->singularViewed = true;

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
        $this->pluralViewed = true;

        return $this->pluralViewCount++;
    }

    /**
     * Increase the number of unique views.
     *
     * @return $this
     */
    public function onUniqueViewed()
    {
        $this->onSingularViewed();
        $this->onPluralViewed();

        return $this;
    }
}
