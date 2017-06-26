<?php
namespace Craft;

class CacheBusterModel
{
    /**
     * Determines the path delimiter when adding
     * multiple values in text fields in CacheBuster
     */
    const PATH_DELIMITER = ', ';

    /**
     * Determines the elementapi plugin name
     */
    const ELEMENT_API_NAME = 'elementapi';

    /**
     * Determines the global identifier in the settings page of cache buster.
     * The identifier is then translated into the id/handle variable of the global
     * that is being saved.
     */
    const GLOBAL_PATH_IDENTIFIER = '{global}';

    /**
     * The root of the cache key for an element api path.
     * This key has been defined by the Element API plugin
     */
    const ELEMENT_API_ROOT = 'elementapi:';

    /**
     * The ending of an element api path before any query parameters
     */
    const ELEMENT_API_END = ':';

    /**
     * The configuration key for the settings of the defaults for element api
     * This key has been defined by the Element API plugin
     */
    const ELEMENT_API_DEFAULTS_KEY = 'defaults';

    /**
     * The configuration key for setting the element per page amount
     * This key has been defined by the Element API plugin
     */
    const ELEMENT_API_PER_PAGE_KEY = 'elementsPerPage';

    /**
     * The default value to use when the per page key has not been set
     * This default amount has been defined by the Element API plugin
     */
    const ELEMENT_API_PER_PAGE_DEFAULT = 100;

    /**
     * The configuration key for setting the page parameter value
     * This key has been defined by the Element API plugin
     */
    const ELEMENT_API_PAGE_PARAM_KEY = 'pageParam';

    /**
     * The default value to use when the page param key has not been set
     * This default value has been defined by the Element API plugin
     */
    const ELEMENT_API_PAGE_PARAM_DEFAULT = 'pg';
}