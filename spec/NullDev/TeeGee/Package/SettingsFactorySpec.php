<?php

namespace spec\NullDev\TeeGee\Package;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SettingsFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Package\SettingsFactory');
    }

    public function it_should_create_empty_instance()
    {
        $this->create()->shouldReturnAnInstanceOf('NullDev\TeeGee\Package\Settings');
    }
}
