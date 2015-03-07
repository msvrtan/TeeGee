<?php

namespace spec\NullDev\TeeGee\Package;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MetaDataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Package\MetaData');
    }

    /**
     * @param NullDev\TeeGee\Package\Settings $settings
     */
    public function it_should_hold_package_source_code_settings_data($settings)
    {
        $this->setSourceCode($settings);
        $this->getSourceCode()->shouldReturn($settings);
    }

    /**
     * @param NullDev\TeeGee\Package\Settings $settings
     */
    public function it_should_hold_package_unit_test_settings_data($settings)
    {
        $this->setUnitTest($settings);
        $this->getUnitTest()->shouldReturn($settings);
    }

    /**
     * @param NullDev\TeeGee\Package\Settings $settings
     */
    public function it_should_hold_package_integration_test_settings_data($settings)
    {
        $this->setIntegrationTest($settings);
        $this->getIntegrationTest()->shouldReturn($settings);
    }

    /**
     * @param NullDev\TeeGee\Package\Settings $settings
     */
    public function it_should_hold_package_functional_test_settings_data($settings)
    {
        $this->setFunctionalTest($settings);
        $this->getFunctionalTest()->shouldReturn($settings);
    }
}
