<?php

namespace Craft;

class CacheBusterVariable
{
    /**
     * Settings.
     *
     * @var object
     */
    private $_settings;

    /**
     * Constructor.
     *
     * Gets plugin settings for internal use.
     */
    public function __construct()
    {
        $this->_settings = craft()->plugins->getPlugin('cachebuster')->getSettings();
    }

    /**
     * Returns CacheBuster listpath
     *
     * @return string
     */
    public function listpath()
    {
        return craft()->cachebuster->listpath();
    }

    /**
     * Returns CacheBuster entrypath
     *
     * @return string
     */
    public function entrypath()
    {
        return craft()->cachebuster->entrypath();
    }

    /**
     * Returns CacheBuster clearentrylists
     *
     * @return string
     */
    public function clearentrylists()
    {
        return craft()->cachebuster->clearentrylists();
    }
}
