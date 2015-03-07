<?php

namespace NullDev\TeeGee\Package;

class Settings
{
    /**
     * @var string Path to the root.
     */
    protected $rootPath;

    /**
     * @var string Namespace that points to root.
     */
    protected $rootNamespace;

    /**
     * @return string
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }

    /**
     * @param string $rootpath
     */
    public function setRootPath($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @return string
     */
    public function getRootNamespace()
    {
        return $this->rootNamespace;
    }

    /**
     * @param string $rootNamespace
     */
    public function setRootNamespace($rootNamespace)
    {
        $this->rootNamespace = $rootNamespace;
    }
}
