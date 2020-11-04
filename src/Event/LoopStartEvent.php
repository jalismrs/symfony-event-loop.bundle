<?php
declare(strict_types = 1);

namespace Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class LoopStartEvent
 *
 * @package Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event
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
