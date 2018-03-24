<?php
declare(strict_types=1);

/*
 * @package    agitation/trigger-bundle
 * @link       http://github.com/agitation/trigger-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\TriggerBundle\Service;

use Serializable;

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
