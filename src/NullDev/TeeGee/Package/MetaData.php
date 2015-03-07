<?php

namespace NullDev\TeeGee\Package;

use NullDev\TeeGee\Package\Settings;

class MetaData
{
    /**
     * @var Settings Source code settings object.
     */
    protected $sourceCode;

    /**
     * @var Settings Unit test settings object.
     */
    protected $unitTest;

    /**
     * @var Settings Integration test settings object.
     */
    protected $integrationTest;

    /**
     * @var Settings Functional test settings object.
     */
    protected $functionalTest;

    /**
     * @return Settings
     */
    public function getSourceCode()
    {
        return $this->sourceCode;
    }

    /**
     * @param Settings $sourceCode
     *
     * @return $this
     */
    public function setSourceCode(Settings $sourceCode)
    {
        $this->sourceCode = $sourceCode;

        return $this;
    }

    /**
     * @return Settings
     */
    public function getUnitTest()
    {
        return $this->unitTest;
    }

    /**
     * @param Settings $unitTest
     *
     * @return $this
     */
    public function setUnitTest(Settings $unitTest)
    {
        $this->unitTest = $unitTest;

        return $this;
    }

    /**
     * @return Settings
     */
    public function getIntegrationTest()
    {
        return $this->integrationTest;
    }

    /**
     * @param Settings $integrationTest
     *
     * @return $this
     */
    public function setIntegrationTest(Settings $integrationTest)
    {
        $this->integrationTest = $integrationTest;

        return $this;
    }

    /**
     * @return Settings
     */
    public function getFunctionalTest()
    {
        return $this->functionalTest;
    }

    /**
     * @param Settings $functionalTest
     *
     * @return $this
     */
    public function setFunctionalTest(Settings $functionalTest)
    {
        $this->functionalTest = $functionalTest;

        return $this;
    }
}
