# CacheBuster

CacheBuster is a small  but useful plugin for busting cache when using Craft CMS in combination with Element API.
When using cachebuster you can force the removal of cache items when saving a specific entry. 
This is useful when cache duration for element api entries have been set to indefinite (or just a long time).

# Installation
    - Clone this repo
    - Copy the folder cachebuster into your plugins folder
    - Go to the plugins configuration in your Craft CMS admin panel and install the plugin

# Busting entry item cache
    - Click on the configuration icon next to the plugin name
    - Fill in the api path where the entry is located: api/entry/{identifier} (identifier can be a "slug" or an "id", this refers to the slug or id of an entry)

# Busting cache of lists containing entries
 
    - Click on the configuration icon next to the plugin name
    - Fill in the api paths of lists containing entries: api/pages, api/news, api/entries
