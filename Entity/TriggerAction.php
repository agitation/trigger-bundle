<?php

namespace Agit\TriggerBundle\Entity;

use DateTime;

use Doctrine\ORM\Mapping as ORM;
use Agit\CommonBundle\Entity\GeneratedIdentityAwareTrait;

/**
 * @ORM\Entity
 */
class TriggerAction
{
    use GeneratedIdentityAwareTrait;

    /**
     * @ORM\Column(type="string",unique=true,length=50)
     */
    private $token;

    /**
     * @ORM\Column(type="string")
     */
    private $service;

    /**
     * @ORM\Column(type="string")
     */
    private $method;

    /**
     * @ORM\Column(type="array")
     */
    private $data;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expires;

    /**
     * Set token
     *
     * @param string $token
     *
     * @return TriggerAction
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set service
     *
     * @param string $service
     *
     * @return TriggerAction
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return TriggerAction
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set data
     *
     * @param array $data
     *
     * @return TriggerAction
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set expires
     *
     * @param DateTime $expires
     *
     * @return TriggerAction
     */
    public function setExpires(DateTime $expires)
    {
        $this->expires = $expires;
        return $this;
    }

    /**
     * Get expires
     *
     * @return DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }
}
