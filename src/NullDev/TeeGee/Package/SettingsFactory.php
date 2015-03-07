<?php

namespace NullDev\TeeGee\Package;

use NullDev\TeeGee\Package\Settings;

class SettingsFactory
{
    /**
     * @return Settings Creates new instance of settings.
     */
    public function create()
    {
        return new Settings();
    }
}
