<?php

namespace NullDev\TeeGee\Package;

use NullDev\TeeGee\Package\MetaDataFactory;
use NullDev\TeeGee\Package\SettingsFactory;

class Symfony2BundleMetaGenerator
{
    protected $metaDataFactory;

    protected $settingsFactory;

    public function __construct(MetaDataFactory $metaDataFactory, SettingsFactory $settingsFactory)
    {
        $this->metaDataFactory = $metaDataFactory;
        $this->settingsFactory = $settingsFactory;
    }

    /**
     * @param string $rootPath Path to the root of package (in this case Symfony2Bundle).
     *
     * @return MetaData
     */
    public function generate($rootPath)
    {
        if (substr($rootPath, -1) === '/') {
            $rootPath = substr($rootPath, 0, -1);
        }

        $packageMeta = $this->metaDataFactory->create();

        $sourceSettings = $this->settingsFactory->create();

        $sourceSettings->setRootPath($rootPath);
        $sourceSettings->setRootNamespace($this->calculateRootNamespaceFromRootPath($rootPath));

        $packageMeta->setSourceCode($sourceSettings);
        $packageMeta->setUnitTest($this->generateUnitTestSettings($sourceSettings));
        $packageMeta->setIntegrationTest($this->generateIntegrationTestSettings($sourceSettings));
        $packageMeta->setFunctionalTest($this->generateFunctionalTestSettings($sourceSettings));

        return $packageMeta;
    }

    /**
     * @param Settings $sourceSettings
     *
     * @return Settings
     */
    public function generateUnitTestSettings(Settings $sourceSettings)
    {
        return $this->generateTestSettings($sourceSettings, 'Unit');
    }

    /**
     * @param Settings $sourceSettings
     *
     * @return Settings
     */
    public function generateIntegrationTestSettings(Settings $sourceSettings)
    {
        return $this->generateTestSettings($sourceSettings, 'Integration');
    }

    /**
     * @param Settings $sourceSettings
     *
     * @return Settings
     */
    public function generateFunctionalTestSettings(Settings $sourceSettings)
    {
        return $this->generateTestSettings($sourceSettings, 'Functional');
    }

    /**
     * @param Settings $sourceSettings
     * @param string   $testType
     *
     * @return Settings
     */
    public function generateTestSettings(Settings $sourceSettings, $testType)
    {
        $testSettings = $this->settingsFactory->create();

        $testSettings->setRootPath($sourceSettings->getRootPath().'/Tests/'.$testType);
        $testSettings->setRootNamespace($sourceSettings->getRootNamespace().'\\Tests\\'.$testType);

        return $testSettings;
    }

    /**
     * @param string $rootPath
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function calculateRootNamespaceFromRootPath($rootPath)
    {
        if (substr($rootPath, -1) === '/') {
            $rootPath = substr($rootPath, 0, -1);
        }

        //Locates last occurance of 'src/' in given path.
        $regex = '/.*src\/(?<namespace>.*)$/';

        //Regex hasnt matched 'src/' in path.
        if (!preg_match($regex, $rootPath, $matches)) {
            throw new \Exception('Root namespace not recognizable in '.$rootPath);
        }

        //Replace '/' with namespace separator.
        $namespace = str_replace('/', '\\', $matches['namespace']);

        return $namespace;
    }
}
