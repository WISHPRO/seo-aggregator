<?php namespace Hettiger\SeoAggregator;

class Robots implements RobotsInterface {

    /**
     * @var Helpers
     */
    protected $helpers;

    protected $protocol;
    protected $host;

    protected $disallowed_paths;
    protected $disallowed_collections;

    /**
     * @param HelpersInterface $helpers
     * @param string $protocol
     * @param null|string $host
     */
    function __construct($helpers, $protocol = 'http', $host = null)
    {
        $this->helpers = $helpers;

        $this->protocol = $protocol;
        $this->host = $host;
    }

    /**
     * Disallow a path for robots
     *
     * @param string $path
     */
    public function disallowPath($path)
    {
        $this->disallowed_paths[] = $path;
    }

    /**
     * Disallow a collection of paths for robots
     *
     * @param array|object $collection
     * @param string $url_prefix
     */
    public function disallowCollection($collection, $url_prefix = null)
    {
        foreach ( $collection as $path ) {
            $path['prefix'] = $url_prefix;
        }

        $this->disallowed_collections[] = $collection;
    }

    /**
     * Get the content for the robots.txt file
     *
     * TODO Does not take care of disallowed collections yet
     *
     * @param bool $sitemap
     * @return string
     */
    public function getRobotsDirectives($sitemap = false)
    {
        $lines[] = 'User-agent: *';

        if ( ! is_null($this->disallowed_paths) ) {
            foreach ( $this->disallowed_paths as $path ) {
                $lines[] = 'Disallow: ' . $path;
            }
        }

        if ( $sitemap ) {
            $lines[] = PHP_EOL . 'Sitemap: '
                . $this->helpers->url(
                    'sitemap.xml',
                    $this->protocol,
                    $this->host
                );
        }

        $output = implode(PHP_EOL, $lines);

        return $output;
    }

}
