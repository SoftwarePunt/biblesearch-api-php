<?php

namespace BiblesearchApi;

/**
 * API Client for bibles.org.
 */
class Api
{
    /**
     * API Token
     *
     * @var string
     */
    private $key;

    /**
     * Server hostname
     *
     * @var string
     */
    private $server;

    /**
     * API client constructor.
     *
     * @param string $key API Token
     * @param string $server Server hostname (e.g. "bibles.org")
     */
    public function __construct($key, $server = 'bibles.org')
    {
        $this->key = $key;
        $this->server = $server;
    }

    /**
     * Given a relative $endpoint URL, returns the full URL including authentication.
     *
     * @param string $endpoint Relative API url (e.g. "/versions/eng-GNTD/books.js")
     * @return string URL
     */
    public function getUrl($endpoint = '/example.js')
    {
        return sprintf('https://%s:x@%s/%s', $this->key, $this->server, $endpoint);
    }

    /**
     * Fetches data from a given endpoint and decodes it as JSON.
     *
     * @param string $endpoint Relative API url (e.g. "/versions/eng-GNTD/books.js")
     * @return mixed Decoded data from server
     */
    public function fetchData($endpoint)
    {
        $url = $this->getUrl($endpoint);
        $data = file_get_contents($url);
        return json_decode($data);
    }
}