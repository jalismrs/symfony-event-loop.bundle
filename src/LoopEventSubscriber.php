<?php
declare(strict_types = 1);

namespace Jalismrs\EventLoopBundle;

use Jalismrs\EventBundle\ConsoleEventSubscriberAbstract;

/**
 * Class LoopEventSubscriber
 *
 * @package Jalismrs\EventLoopBundle
 */
class LoopEventSubscriber extends
    ConsoleEventSubscriberAbstract
{
    /**
     * getSubscribedEvents
     *
     * @static
     * @return string[]
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
     * @param \Jalismrs\EventLoopBundle\LoopAdvanceEvent $event
     *
     * @return \Jalismrs\EventLoopBundle\LoopAdvanceEvent
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
        $isActive = parent::isActive();
        
        return $isActive
            &&
            $this
                ->getStyle()
                ->getVerbosity() > 128;
    }
    
    /**
     * onLoopFinish
     *
     * @param \Jalismrs\EventLoopBundle\LoopFinishEvent $event
     *
     * @return \Jalismrs\EventLoopBundle\LoopFinishEvent
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
     * @param \Jalismrs\EventLoopBundle\LoopStartEvent $event
     *
     * @return \Jalismrs\EventLoopBundle\LoopStartEvent
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
