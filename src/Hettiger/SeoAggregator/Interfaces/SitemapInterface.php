<?php namespace Hettiger\SeoAggregator\Interfaces;

interface SitemapInterface {

    /**
     * Add a link to the sitemap
     *
     * @param string $link
     * @param \DateTime $updated_at
     * @return void
     */
    public function addLink($link, $updated_at);

    /**
     * Add a collection of links to the sitemap
     *
     * @param object $collection
     * @param string $url_prefix
     * @return void
     */
    public function addCollection($collection, $url_prefix = null);

    /**
     * Get the content for the sitemap.xml file
     *
     * @return string
     */
    public function getSitemapXml();

}
