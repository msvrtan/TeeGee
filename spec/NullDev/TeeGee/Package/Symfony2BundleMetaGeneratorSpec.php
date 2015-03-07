<?php

namespace spec\NullDev\TeeGee\Package;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Symfony2BundleMetaGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('NullDev\TeeGee\Package\Symfony2BundleMetaGenerator');
    }

    /**
     * @param NullDev\TeeGee\Package\MetaDataFactory $metaDataFactory
     * @param NullDev\TeeGee\Package\SettingsFactory $settingsFactory
     */
    public function let($metaDataFactory, $settingsFactory)
    {
        $this->beConstructedWith($metaDataFactory, $settingsFactory);
    }

    /**
     * @param NullDev\TeeGee\Package\MetaDataFactory $metaDataFactory
     * @param NullDev\TeeGee\Package\SettingsFactory $settingsFactory
     * @param NullDev\TeeGee\Package\MetaData        $metaData
     * @param NullDev\TeeGee\Package\Settings        $settings
     */
    public function it_should_generate_package_meta_for_symfony2bundle(
        $metaDataFactory,
        $settingsFactory,
        $metaData,
        $settings
    ) {
        $metaDataFactory->create()->shouldBeCalled()->willReturn($metaData);
        $settingsFactory->create()->shouldBeCalled()->willReturn($settings);

        $this->generate('/lib/application/src/Vendor/PackageBundle')->shouldReturn($metaData);
    }

    /**
     * @param NullDev\TeeGee\Package\SettingsFactory $settingsFactory
     * @param NullDev\TeeGee\Package\Settings        $sourceSettings
     * @param NullDev\TeeGee\Package\Settings        $unitTestSettings
     */
    public function it_should_generate_unit_test_settings_from_given_source_settings(
        $settingsFactory,
        $sourceSettings,
        $unitTestSettings
    ) {
        $sourcePath      = '/src/Vendor/PackageBundle';
        $sourceNamespace = 'Vendor\PackageBundle';

        $sourceSettings->getRootPath()->willReturn($sourcePath);
        $sourceSettings->getRootNamespace()->willReturn($sourceNamespace);

        $unitTestSettings->setRootPath($sourcePath.'/Tests/Unit')->shouldBeCalled();
        $unitTestSettings->setRootNamespace($sourceNamespace.'\Tests\Unit')->shouldBeCalled();

        $settingsFactory->create()->shouldBeCalled()->willReturn($unitTestSettings);
        $this->generateUnitTestSettings($sourceSettings)->shouldReturn($unitTestSettings);
    }

    /**
     * @param NullDev\TeeGee\Package\SettingsFactory $settingsFactory
     * @param NullDev\TeeGee\Package\Settings        $sourceSettings
     * @param NullDev\TeeGee\Package\Settings        $unitTestSettings
     */
    public function it_should_generate_integration_test_settings_from_given_source_settings(
        $settingsFactory,
        $sourceSettings,
        $unitTestSettings
    ) {
        $sourcePath      = '/src/Vendor/PackageBundle';
        $sourceNamespace = 'Vendor\PackageBundle';

        $sourceSettings->getRootPath()->willReturn($sourcePath);
        $sourceSettings->getRootNamespace()->willReturn($sourceNamespace);

        $unitTestSettings->setRootPath($sourcePath.'/Tests/Integration')->shouldBeCalled();
        $unitTestSettings->setRootNamespace($sourceNamespace.'\Tests\Integration')->shouldBeCalled();

        $settingsFactory->create()->shouldBeCalled()->willReturn($unitTestSettings);
        $this->generateIntegrationTestSettings($sourceSettings)->shouldReturn($unitTestSettings);
    }

    /**
     * @param NullDev\TeeGee\Package\SettingsFactory $settingsFactory
     * @param NullDev\TeeGee\Package\Settings        $sourceSettings
     * @param NullDev\TeeGee\Package\Settings        $unitTestSettings
     */
    public function it_should_generate_functional_test_settings_from_given_source_settings(
        $settingsFactory,
        $sourceSettings,
        $unitTestSettings
    ) {
        $sourcePath      = '/src/Vendor/PackageBundle';
        $sourceNamespace = 'Vendor\PackageBundle';

        $sourceSettings->getRootPath()->willReturn($sourcePath);
        $sourceSettings->getRootNamespace()->willReturn($sourceNamespace);

        $unitTestSettings->setRootPath($sourcePath.'/Tests/Functional')->shouldBeCalled();
        $unitTestSettings->setRootNamespace($sourceNamespace.'\Tests\Functional')->shouldBeCalled();

        $settingsFactory->create()->shouldBeCalled()->willReturn($unitTestSettings);
        $this->generateFunctionalTestSettings($sourceSettings)->shouldReturn($unitTestSettings);
    }

    /**
     * @param NullDev\TeeGee\Package\SettingsFactory $settingsFactory
     * @param NullDev\TeeGee\Package\Settings        $sourceSettings
     * @param NullDev\TeeGee\Package\Settings        $testSettings
     */
    public function it_should_generate_test_settings_from_given_source_settings_and_suffix(
        $settingsFactory,
        $sourceSettings,
        $testSettings
    ) {
        $sourcePath      = '/src/Vendor/PackageBundle';
        $sourceNamespace = 'Vendor\PackageBundle';

        $sourceSettings->getRootPath()->willReturn($sourcePath);
        $sourceSettings->getRootNamespace()->willReturn($sourceNamespace);

        $testSettings->setRootPath($sourcePath.'/Tests/Type')->shouldBeCalled();
        $testSettings->setRootNamespace($sourceNamespace.'\Tests\Type')->shouldBeCalled();

        $settingsFactory->create()->shouldBeCalled()->willReturn($testSettings);
        $this->generateTestSettings($sourceSettings, 'Type')->shouldReturn($testSettings);
    }

    public function it_should_generate_root_namespace_from_root_path()
    {
        $this->calculateRootNamespaceFromRootPath('/src/Vendor/PackageBundle')->shouldReturn('Vendor\PackageBundle');
    }

    public function it_should_generate_root_namespace_from_location_last_src_occurance_in_root_path()
    {
        $this->calculateRootNamespaceFromRootPath('/src/app/src/Vendor/PackageBundle')
            ->shouldReturn('Vendor\PackageBundle');
        $this->calculateRootNamespaceFromRootPath('/lib/src/app/src/Vendor/PackageBundle')
            ->shouldReturn('Vendor\PackageBundle');
    }

    public function it_should_generate_root_namespace_from_root_path_given_with_trailing_slash()
    {
        $this->calculateRootNamespaceFromRootPath('/src/Vendor/PackageBundle/')->shouldReturn('Vendor\PackageBundle');
    }

    public function it_should_throw_exception_when_generating_root_namespace_from_unrecognizable_root_path()
    {
        $this->shouldThrow('\Exception')->duringCalculateRootNamespaceFromRootPath('/lib/Vendor/PackageBundle/');
    }
}
