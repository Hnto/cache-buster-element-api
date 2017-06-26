<?php
namespace Craft;

class CacheBusterService extends BaseApplicationComponent
{
    /**
     * The Cache buster plugin instance.
     *
     * @var \Craft\CacheBusterPlugin
     */
    protected $plugin;

    /**
     * Sentry's settings.
     *
     * @var array
     */
    protected $settings;

    /**
     * Get Sentry's settings.
     *
     * @return void
     */
    public function __construct()
    {
        $this->plugin = craft()->plugins->getPlugin('cachebuster');
        $this->settings = $this->plugin->getSettings();
    }

    /**
     * Returns CacheBuster entry path
     *
     * @return string
     */
    public function entrypath()
    {
        return $this->settings->getAttribute('entrypath');
    }

    /**
     * Returns CacheBuster list path
     *
     * @return string
     */
    public function listpath()
    {
        return $this->settings->getAttribute('listpath');
    }

    /**
     * Returns CacheBuster clear entry lists
     *
     * @return mixed
     */
    public function clearentrylists()
    {
        return $this->settings->getAttribute('clearentrylists');
    }

    /**
     * Bust cache item on element api for a single entry
     *
     * @param EntryModel $entry
     * @param array $entryPath
     */
    public function bustEntry(EntryModel $entry, array $entryPath = [])
    {
        //Determine cache key
        $cacheKey = CacheBusterModel::ELEMENT_API_ROOT .
            $entryPath[0] .
            $entry->{$entryPath[1]} .
            CacheBusterModel::ELEMENT_API_END;

        //Delete cache
        craft()->cache->delete($cacheKey);
    }

    /**
     * Bust cache on element api for lists containing entries
     *
     * @param $clear
     * @param $listpath
     */
    public function bustListsWithEntries($clear, $listpath)
    {
        if ($clear !== true) {

            return;
        }

        $entriesAmount = craft()->db
            ->createCommand()
            ->select('id')
            ->from('entries')
            ->execute();

        $defaults = craft()->config->get(CacheBusterModel::ELEMENT_API_DEFAULTS_KEY, CacheBusterModel::ELEMENT_API_NAME);

        //Determine elements per page
        $elementsPerPage = CacheBusterModel::ELEMENT_API_PER_PAGE_DEFAULT;
        if (isset($defaults[CacheBusterModel::ELEMENT_API_PER_PAGE_KEY])) {
            $elementsPerPage = $defaults[CacheBusterModel::ELEMENT_API_PER_PAGE_KEY];
        }

        //Determine pageparam key
        $pageParam = CacheBusterModel::ELEMENT_API_PAGE_PARAM_DEFAULT;
        if (isset($defaults[CacheBusterModel::ELEMENT_API_PAGE_PARAM_KEY])) {
            $pageParam = $defaults[CacheBusterModel::ELEMENT_API_PAGE_PARAM_KEY];
        }

        $pages = ceil($entriesAmount / $elementsPerPage);

        $paths = explode(CacheBusterModel::PATH_DELIMITER, $listpath);
        foreach($paths as $path) {
            //Loop through the amount of pages
            for($cp = 1; $cp <= $pages; $cp++) {
                //Determine cachekey
                $cacheKey = CacheBusterModel::ELEMENT_API_ROOT .
                    $path .
                    CacheBusterModel::ELEMENT_API_END .
                    $pageParam .
                    '=' .
                    $cp;

                //Delete cache
                craft()->cache->delete($cacheKey);
            }
        }
    }
}
