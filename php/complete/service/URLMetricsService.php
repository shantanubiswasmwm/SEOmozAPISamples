<?php
/**
 * 
 * Service class to call the various methods to
 * URL Metrics
 * 
 * URL Metrics is a paid API that returns the metrics about a URL or set of URLs.  
 * 
 * @author Radeep Solutions
 *
 */
class URLMetricsService 
{
	private $authenticator;
	
	public function __construct($authenticator)
	{
		$this->authenticator = $authenticator;		
	}
	
	/**
	 * 
	 * This method returns the metrics about a URL or set of URLs.  
	 * 
	 * @param string objectURL
	 * @param array options
	 * @return
	 */
	public function getUrlMetrics($objectURL, array $options = array())
	{
		
		$urlToFetch = "http://lsapi.seomoz.com/linkscape/url-metrics/" . urlencode($objectURL) . "?" . $this->authenticator->getAuthenticationStr();
        
        /**
         * @param col This field filters the data to get only specific columns
         *  col = 0 fetches all the data
         */
        $options['cols'] = isset($options['cols']) && (int)$options['cols'] > 0 ? (int)$options['cols'] : 0;
        $urlToFetch .= "&Cols=" . $options['cols'];

		$response = ConnectionUtil::makeRequest($urlToFetch);
		
		return $response;
	}
	
	/**
	 * @return the $authenticator
	 */
	public function getAuthenticator() {
		return $this->authenticator;
	}

	/**
	 * @param $authenticator the $authenticator to set
	 */
	public function setAuthenticator($authenticator) {
		$this->authenticator = $authenticator;
	}
	
}

?>