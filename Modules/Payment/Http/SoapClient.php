<?php

namespace Modules\Payment\Http;

use Closure;
use Illuminate\Support\Arr;
use SoapClient as MainSoapClient;
use SoapFault;

class SoapClient
{
    /**
     * @var array
     */
    protected $config;
    /**
     * @var int
     */
    protected $attempts;
    /**
     * Main soap class
     *
     * @var MainSoapClient
     */
    private $soap;

    /**
     * @param string $soapServer
     * @param array $config
     * @param array $options
     */
    public function __construct($soapServer, $config, $options = [])
    {
        $this->config = $config;

        $this->attempts = intval(Arr::get($config, 'attempts')) ?: 1;

        $this->soap = new MainSoapClient($soapServer, $options);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws \SoapFault
     */
    public function __call($name, array $arguments)
    {
        return $this->attempt($this->attempts, function () use ($name, $arguments) {
            return call_user_func_array([$this->soap, $name], $arguments);
        });
    }

    /**
     * Try soap codes for multiple times
     *
     * @param int $attempts
     * @param \Closure $statements
     * @return mixed
     * @throws \SoapFault
     */
    protected function attempt($attempts, Closure $statements)
    {
        while ($attempts > 0) {
            try {
                return $statements();
            } catch (SoapFault $e) {
                $attempts--;

                if ($attempts == 0) {
                    throw $e;
                }
            }
        }

        return false;
    }
}
