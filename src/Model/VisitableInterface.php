<?php

namespace Lavulator\ViewsCounterBundle\Model;

/**
 * Interface VisitableInterface
 *
 * @package Lavulator\ViewsCounterBundle\Model
 */
interface VisitableInterface
{
    /**
     * Singular Views entity field.
     *
     * @var string
     */
    public const SINGULAR_VIEW_FIELD = 'singularViewCount';

    /**
     * Plural Views entity field.
     *
     * @var string
     */
    public const PLURAL_VIEW_FIELD = 'pluralViewCount';

    /**
     * Session key.
     *
     * @var string
     */
    public const SESSION_KEY = '_views_count';

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return bool
     */
    public function isSingularViewed(): bool;

    /**
     * @return bool
     */
    public function isPluralViewed(): bool;

    /**
     * Unique visitor id for every user.
     *
     * @return string
     */
    public function getVisitorId(): string;

    /**
     * Visitable name for every object/entity.
     *
     * @return string
     */
    public function getVisitable(): string;

    /**
     * Increase the number of singular views.
     *
     * @return int
     */
    public function onSingularViewed(): int;

    /**
     * Increase the number of plural views.
     *
     * @return int
     */
    public function onPluralViewed(): int;

    /**
     * Increase the number of unique views.
     *
     * @return $this
     */
    public function onUniqueViewed();
}
