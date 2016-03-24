<?php

namespace BiblesearchApi;

/**
 * @version $Id$
 * @author  Mark Bradshaw <mbradshaw@americanbible.org>
 * @package ABS
 */

class Search extends Base {

	/**
     * The name of the XML element in the response that defines the object.
     *
     * @var string
     */
    const XML_RESPONSE_ELEMENT = 'search';
	
	function __construct(Api $api) {
        parent::__construct($api, self::XML_RESPONSE_ELEMENT);
        $this->__setXpath('search');
    }
	
	protected function getUrl($method) {
        switch($method) {
            case 'search':
                return 'search.xml';
            
            default:
                throw new Exception('Invalid method ' . $method);
        }
    }
	
	/*
     * Method to search all books of the Bible
     * 
     * @param   array $params
     * 
     *  query: the words or passage you are searching for. REQUIRED
     *  version: may be one or several of the version �version� values
     *
     *  @return  xml SimpleXML object
     */
    public function search($params = array()) {
        $this->__setXpath('result');
        if (!isset($params['query']) || empty($params['query'])) {
            throw new Exception("The parameter 'query' is required");
        }
        foreach ($this->__allowedSearchParams() as $key) {
            if (isset($params[$key])) {
                $this->addParam($key,$params[$key]);
            }
        }
        return $this->requestXml('search');
    }
    private function __allowedSearchParams() {
        return array('query',
                     'version'
                     );
    }
}