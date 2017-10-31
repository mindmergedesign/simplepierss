<?php

namespace Statamic\Addons\SimplePieRss;

use SimplePie;
use Statamic\API\Parse;
use Statamic\Extend\Tags;
use Statamic\API\Folder;

class SimplepieRssTags extends Tags
{
	
	/**
	* The {
		{
			simple_pie_rss
		}
	}
	tag
	     *
	     * @return string|array
	     */
	    public function index()
	    {
		$url            = $this->getParam('url', null);
		$order_by_date  = $this->getParam('order_by_date', true, false, true);
		$offset         = $this->getParam('offset', 0);
		$cache          = $this->getParam('cache', false, false, true);
		$timeout        = $this->getParam('timeout', 10);
		
		$count          = $this->getParam('count', false);
		$limit          = $this->getParam('limit', 10);
		$limit = $limit == 'no' ? 0 : $limit;
		if ($count && $this->getParam('limit', false) === false) {
			$limit = $count;
			# backwards compatibility
		}
		$feed = new SimplePie();
		$cache_folder = 'local/cache/addons/simplepierss';
		if ( ! Folder::exists($cache_folder)) {
			Folder::make($cache_folder);
		}
		$feed->set_cache_location($cache_folder);
		$feed->enable_cache($cache);
		$feed->set_feed_url($url);
		$feed->enable_order_by_date($order_by_date);
		$success = $feed->init();
		$feed->handle_content_type();
		if ( ! $feed->error() && $success) {
			$loop_count = 0;
			$output = '';
			foreach($feed->get_items($offset) as $item) {
				$data = array();
				$data['title']        = $item->get_title();
				$data['permalink']    = $item->get_permalink();
				$data['date']         = $item->get_date();
				$data['updated_date'] = $item->get_updated_date();
				$data['author']       = $item->get_author();
				$data['category']     = $item->get_category();
				$data['description']  = $item->get_description();
				$data['content']      = $item->get_content();
				$loop_count ++;
				$output .= Parse::template($this->content, $data);
				if ($loop_count >= $limit) break;
			}
			return $output;
		}
		return '';
	}
	
	
	/**
	* The {
		{
			simple_pie_rss:example
		}
	}
	tag
	     *
	     * @return string|array
	     */
	    public function feed()
	    {
		return $this->index();
	}
}
