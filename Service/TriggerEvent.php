<?php

namespace Agit\TriggerBundle\Service;

use Symfony\Component\EventDispatcher\Event;

class TriggerEvent extends Event
{
    private $tag;

    private $data;

    public function __construct($tag, $data)
    {
        $this->tag = $tag;
        $this->data = $data;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function getData()
    {
        return $this->data;
    }
}
