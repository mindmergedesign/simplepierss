SimplePieRSS Addon for Statamic 2 
================================

This addon is based on the [Statamic SimplePie Plugin](https://github.com/statamic/Plugin-SimplePie) for Statamic 1.

The SimplePieRSS addon is a fast and easy-to-use RSS and Atom feed parser. 

## Installing
1. Download the zip file (or clone via git); unzip it and copy the SimplePieRss folder to `site/addons/`folder.
2. Run `php please update:addons` from the terminal
3. Enjoy.

## Example Tag
    
    {{ simplepie_rss url="http://feeds.feedburner.com/TechCrunch/" limit="5" cache="yes" }}
      <h1><a href="{{ permalink }}">{{ title }}</a></h1>
      <h2>Posted on {{ date }}</h2>
      <div class="content">
        {{ content }}
      </div>
    {{ /simplepie_rss }}

## Parameters

### URL `url`

The URL of the feed to be parsed.

    url="http://statamic.com/blog/feed/"

### Order By Date `order_by_date`
**default:** yes

Order by date or default feed order.

### Limit `limit`
**Default:** 10

Limit the number of items returned.

### Offset `offset`
**Default:** 0

Offset the returned items. For example, if your feed returns

- Mustaches
- Corncob Pipes
- Musky Scent

Setting `offset="1"` would return:

- Corncob Pipes
- Musky Scent

### Cache `cache`
**Default:** no

Turn caching on for faster page loads or to limit API/Feed requests.


### Timeout `timeout`
**Default:** 10 (seconds)

The maximum number of seconds to spend waiting to retrieve a feed.

## Variables
Upon successfully retrieving a feed, the following default variables become available inside the the `{{ simplepie_rss }}` tag pair.

- {{ title }}
- {{ permalink }}
- {{ date }}
- {{ update_date }}
- {{ author }}
- {{ category }}
- {{ description }}
- {{ content }}

