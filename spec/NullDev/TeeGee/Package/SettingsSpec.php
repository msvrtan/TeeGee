<?php

namespace spec\NullDev\TeeGee\Package;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SettingsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Package\Settings');
    }

    public function it_should_hold_root_path()
    {
        $this->setRootPath('path');
        $this->getRootPath()->shouldReturn('path');
    }

    public function it_should_know_namespace_of_root_path()
    {
        $this->setRootNamespace('Vendor\PackageBundle');
        $this->getRootNamespace()->shouldReturn('Vendor\PackageBundle');
    }
}
