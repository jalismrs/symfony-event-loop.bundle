<?php
declare(strict_types = 1);

namespace Jalismrs\EventLoopBundle;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class LoopAdvanceEvent
 *
 * @package App\Event
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
     * @param int $steps
     */
    public function __construct(
        int $steps = 1
    ) {
        $this->steps = $steps;
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
