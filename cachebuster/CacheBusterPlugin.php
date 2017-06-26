<?php
/**
 * CacheBustingElementApi pluging for CraftCMS in combination with elementapi
 *
 * Turn on cache busting for elementapi after an entry has been saved
 *
 * @author    hnto
 * @copyright Copyright (c) 2017 BlockLevel
 * @link      https://blocklevel.nl
 * @package   CacheBustingElementApi
 * @since     1.0.0
 */

namespace Craft;

class CacheBusterPlugin extends BasePlugin
{
    /**
     * Initialize CacheBuster
     */
    public function init()
    {
        try {
            $entryPath = $this->getSettings()->entrypath;

            if (preg_match("/(.*)\{(.*)\}/", $entryPath, $matches) !== 0) {
                //Remove first item
                array_shift($matches);
            }

            if (empty($matches)
                || !isset($matches[0])
                || !isset($matches[1])
                || !in_array($matches[1], ['slug', 'id'])
            ) {
                return;
            }

            craft()->on('entries.onSaveEntry', function(Event $event) use ($matches) {
                /** Clear the cache for the entry that's been saved -- BEGIN */
                    craft()->cacheBuster->bustEntry($event->params['entry'], $matches);
                /** Clear the cache for the entry that's been saved -- END */

                /** Clear the cache for specified lists that contain entries -- BEGIN */
                    craft()->cacheBuster->bustListsWithEntries(
                        (bool) $this->getSettings()->clearentrylists,
                        $this->getSettings()->listpath
                    );
                /** Clear the cache for specified lists that contain entries -- END */
            });

        } catch (Exception $e) {
            Craft::log("ERROR: The craft cachebuster elementapi plugin encountered an error while trying to initialize: {$e}", LogLevel::Error);
        }
    }

    /**
     * @return mixed
     */
    public function getName ()
    {
        return Craft::t('Cache Busting for Element API');
    }

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        return Craft::t('');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl ()
    {
        return '';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl ()
    {
        return '';
    }

    /**
     * @return string
     */
    public function getVersion ()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion ()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper ()
    {
        return 'hnto';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl ()
    {
        return 'https://github.com/hnto';
    }

    /**
     * Define plugin settings.
     *
     * @return array
     */
    protected function defineSettings()
    {
        return [
            'entrypath' => AttributeType::String,
            'listpath' => AttributeType::String,
            'clearentrylists' => AttributeType::Bool,
        ];
    }

    /**
     * Get settings template.
     *
     * @return string
     */
    public function getSettingsHtml()
    {
        return craft()->templates->render('cachebuster/_settings', array(
            'settings' => $this->getSettings(),
        ));
    }
}
