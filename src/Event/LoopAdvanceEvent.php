<?php
declare(strict_types = 1);

namespace Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class LoopAdvanceEvent
 *
 * @package Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event
 *
 * @codeCoverageIgnore
 */
final class LoopAdvanceEvent extends
    Event
{
    /**
     * steps
     *
     * @var int
     */
    private int $steps;
    
    /**
     * LoopAdvanceEvent constructor.
     *
     * @param int|null $steps
     */
    public function __construct(
        int $steps = null
    ) {
        $this->steps = $steps ?? 1;
    }

    /**
     * getSteps
     *
     * @return int
     */
    public function getSteps() : int
    {
        return $this->steps;
    }
}
