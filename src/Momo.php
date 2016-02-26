<?php
namespace Momo;

/**
 * class Momo
 *
 * @package Momo
 *
 */
use Momo\Helpers\Decoder;
class Momo extends MMConfig
{
    private $response;
    private $request;
    private $bearer;

    /**
     * Constructor
     *
     * @param string    $apiToken   API Seller Token
     */
    public function __construct($apiToken = null, MMRequest $request = null, MMResponse $response = null)
    {
        $this->setEnv();
        $this->request = $request ?: new MMRequest();
        $this->response = $response ?: new MMResponse();

        if (!empty($apiToken)) {
            $this->bearer = $apiToken;
        }
    }

    /**
     * @return headers
     */
    public function getResponseHeaders()
    {
        return $this->response->getHeaders();
    }

    /**
     * @return body
     */
    public function getResponseBody()
    {
        return $this->response->getBody();
    }

    /**
     * @return int
     */
    public function getResponseCode()
    {
        return $this->response->getHttpCode();
    }

    /**
     * Make POST requests to the API.
     *
     * @param string $path
     * @param array  $parameter
     *
     * @return array|object
     */
    public function post($path, array $parameter = [])
    {
        return $this->http('POST', $this->config['host'], $path, $parameter);
    }

    /**
     * @param string $method
     * @param string $host
     * @param string $path
     * @param array  $parameters
     *
     * @return array|object
     */
    private function http($method, $host, $path, array $body)
    {
        $url = sprintf('%s/%s', $host, $path);

        if ($this->bearer === null) {
            throw new MMException("invalid API token.");
        }
        $headers = [
            'Authorization' => 'Seller ' . $this->bearer,
            'Content-type' => 'application/vnd.api+json',
        ];

        $result = $this->request->send($url, $method, $body, $headers, $this->timeout);
        list($responseHeaders, $responseBody) = $this->extractResponse($result);

        $this->response->setHttpCode($this->request->getHttpCode());
        $this->response->setHeaders($responseHeaders);
        $this->response->setBody(Decoder::json($responseBody, $this->decodeAsArray));
        return;
    }

    /**
     * Extract Raw data
     * @param string $results
     *
     * @return array
     */
    private function extractResponse($results)
    {
        return explode("\r\n\r\n", $results);
    }

}
