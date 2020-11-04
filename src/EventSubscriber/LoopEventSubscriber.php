<?php
declare(strict_types = 1);

namespace Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\EventSubscriber;

use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopAdvanceEvent;
use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopFinishEvent;
use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopStartEvent;
use Jalismrs\Symfony\Common\ConsoleEventSubscriberAbstract;

/**
 * Class LoopEventSubscriber
 *
 * @package Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\EventSubscriber
 */
class LoopEventSubscriber extends
    ConsoleEventSubscriberAbstract
{
    /**
     * getSubscribedEvents
     *
     * @static
     * @return string[]
     *
     * @codeCoverageIgnore
     */
    public static function getSubscribedEvents() : array
    {
        return [
            LoopAdvanceEvent::class => 'onLoopAdvance',
            LoopFinishEvent::class  => 'onLoopFinish',
            LoopStartEvent::class   => 'onLoopStart',
        ];
    }
    
    /**
     * onLoopAdvance
     *
     * @param \Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopAdvanceEvent $event
     *
     * @return \Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopAdvanceEvent
     */
    public function onLoopAdvance(
        LoopAdvanceEvent $event
    ) : LoopAdvanceEvent {
        if ($this->isActive()) {
            $steps = $event->getSteps();
            
            $this
                ->getStyle()
                ->progressAdvance($steps);
        }
        
        return $event;
    }
    
    /**
     * isActive
     *
     * @return bool
     */
    public function isActive() : bool
    {
        /**
         * NOTE:
         *
         * porgress bars are displayed on stderr
         * BUT we do not want then to be displayed in scheduled tasks
         * SO we use '-vv' instead of '-vvv' and add this condition
         */
        return parent::isActive()
            &&
            $this
                ->getStyle()
                ->getVerbosity() > 128;
    }
    
    /**
     * onLoopFinish
     *
     * @param \Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopFinishEvent $event
     *
     * @return \Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopFinishEvent
     */
    public function onLoopFinish(
        LoopFinishEvent $event
    ) : LoopFinishEvent {
        if ($this->isActive()) {
            $this
                ->getStyle()
                ->progressFinish();
        }
        
        return $event;
    }
    
    /**
     * onLoopStart
     *
     * @param \Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopStartEvent $event
     *
     * @return \Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopStartEvent
     */
    public function onLoopStart(
        LoopStartEvent $event
    ) : LoopStartEvent {
        if ($this->isActive()) {
            $count = $event->getCount();
            
            $this
                ->getStyle()
                ->progressStart($count);
        }
        
        return $event;
    }
}
