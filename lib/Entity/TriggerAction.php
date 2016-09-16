<?php

/*
 * @package    agitation/trigger-bundle
 * @link       http://github.com/agitation/trigger-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\TriggerBundle\Entity;

use Agit\BaseBundle\Entity\GeneratedIdentityAwareTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

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
    private $tag;

    /**
     * @ORM\Column(type="array")
     */
    private $data;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expires;

    /**
     * Set token.
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
     * Get token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set tag.
     *
     * @param string $tag
     *
     * @return TriggerAction
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag.
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set data.
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
     * Get data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set expires.
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
     * Get expires.
     *
     * @return DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }
}
