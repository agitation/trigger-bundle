<?php

namespace Agit\TriggerBundle\Service;

use Exception;
use Serializable;
use Doctrine\ORM\EntityManager;
use Agit\IntlBundle\Translate;

class TriggerData implements Serializable
{
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function serialize()
    {
        return serialize($this->values);
    }

    public function unserialize($values)
    {
        $this->values = unserialize($values);
    }
}
