<?php
namespace Training3\ExchangeRate\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Data
 */
class Data extends AbstractHelper
{
    /**
     * Rate Api URl
     */
    const RATE_API_URL = 'http://api.fixer.io/latest?base=USD';

    /**Get Rates From Third Party
     *
     * @return array
     */
    public function getRates()
    {
        $client = new \Zend_Http_Client();
        $client->setUri(self::RATE_API_URL);
        $client->setMethod($client::GET);
        $response = $client->request();
        return json_decode($response->getRawBody(), true);
    }
}
