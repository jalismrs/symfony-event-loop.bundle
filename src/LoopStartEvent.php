<?php
declare(strict_types = 1);

namespace Jalismrs\EventLoopBundle;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class LoopStartEvent
 *
 * @package Jalismrs\EventLoopBundle
 *
 * @codeCoverageIgnore
 */
final class LoopStartEvent extends
    Event
{
    /**
     * count
     *
     * @var int
     */
    private int $count;

    /**
     * LoopStartEvent constructor.
     *
     * @param int $count
     */
    public function __construct(
        int $count
    ) {
        $this->count = $count;
    }

    /**
     * getCount
     *
     * @return int
     */
    public function getCount() : int
    {
        return $this->count;
    }
}
