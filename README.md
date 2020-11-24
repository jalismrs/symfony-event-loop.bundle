# symfony.bundle.event.loop

Adds loop events with their listener

## Test

`phpunit` or `vendor/bin/phpunit`

coverage reports will be available in `var/coverage`

## Use
EventListener is assumed to be active and configured
```php
use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopAdvanceEvent;
use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopFinishEvent;
use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopStartEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SomeClass {
    private EventDispatcher $eventDispatcher;

    public function someFunction(
        array $datas
    ): void {
        $count = count($datas);
        if ($count > 0) {
            $loopStartEvent = new LoopStartEvent(
                $count
            );
            $this->eventDispatcher->dispatch($loopStartEvent);
        
            foreach ($datas as $data) {
                // do something
            
                $loopAdvanceEvent = new LoopAdvanceEvent();
                $this->eventDispatcher->dispatch($loopAdvanceEvent);
            }
        
            $loopFinishEvent = new LoopFinishEvent();
            $this->eventDispatcher->dispatch($loopFinishEvent);
        }
    }
}
```
