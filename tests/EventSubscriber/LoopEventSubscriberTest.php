<?php
declare(strict_types = 1);

namespace Tests\EventSubscriber;

use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\EventSubscriber\LoopEventSubscriber;
use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopFinishEvent;
use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopAdvanceEvent;
use Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\Event\LoopStartEvent;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class LoopEventSubscriberTest
 *
 * @package Tests\EventSubscriber
 *
 * @covers \Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\EventSubscriber\LoopEventSubscriber
 */
class LoopEventSubscriberTest extends
    TestCase
{
    /**
     * mockStyle
     *
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\Console\Style\SymfonyStyle
     */
    private MockObject $mockStyle;
    
    /**
     * testOnLoopAdvance
     *
     * @return void
     */
    public function testOnLoopAdvance() : void
    {
        // arrange
        $systemUnderTest = $this->createSUT();
    
        $steps = 1;
        
        $loopAdvanceEvent = new LoopAdvanceEvent(
            $steps
        );
        
        // expect
        $this->mockStyle
            ->expects(self::once())
            ->method('progressAdvance')
            ->with(
                self::equalTo($steps),
            );
        
        // act
        $output = $systemUnderTest->onLoopAdvance($loopAdvanceEvent);
        
        // assert
        self::assertSame(
            $loopAdvanceEvent,
            $output,
        );
    }
    
    /**
     * testOnLoopFinish
     *
     * @return void
     */
    public function testOnLoopFinish() : void
    {
        // arrange
        $systemUnderTest = $this->createSUT();
        
        $loopFinishEvent = new LoopFinishEvent();
        
        // expect
        $this->mockStyle
            ->expects(self::once())
            ->method('progressFinish');
        
        // act
        $output = $systemUnderTest->onLoopFinish($loopFinishEvent);
        
        // assert
        self::assertSame(
            $loopFinishEvent,
            $output,
        );
    }
    
    /**
     * testOnLoopStart
     *
     * @return void
     */
    public function testOnLoopStart() : void
    {
        // arrange
        $systemUnderTest = $this->createSUT();
        
        $count = 1;
        
        $loopStartEvent = new LoopStartEvent(
            $count
        );
        
        // expect
        $this->mockStyle
            ->expects(self::once())
            ->method('progressStart')
            ->with(
                self::equalTo($count),
            );
        
        // act
        $output = $systemUnderTest->onLoopStart($loopStartEvent);
        
        // assert
        self::assertSame(
            $loopStartEvent,
            $output,
        );
    }
    
    /**
     * setUp
     *
     * @return void
     */
    protected function setUp() : void
    {
        parent::setUp();
        
        $this->mockStyle = $this->createMock(SymfonyStyle::class);
    }
    
    /**
     * createSUT
     *
     * @return \Jalismrs\Symfony\Bundle\JalismrsLoopEventBundle\EventSubscriber\LoopEventSubscriber
     */
    private function createSUT() : LoopEventSubscriber
    {
        // arrange
        $systemUnderTest = new LoopEventSubscriber();
    
        // expect
        $this->mockStyle
            ->expects(self::once())
            ->method('getVerbosity')
            ->willReturn(129);
    
        // act
        $systemUnderTest->activate();
        $systemUnderTest->setStyle($this->mockStyle);
        
        return $systemUnderTest;
    }
}
