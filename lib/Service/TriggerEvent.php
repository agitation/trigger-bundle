<?php
declare(strict_types=1);

/*
 * @package    agitation/trigger-bundle
 * @link       http://github.com/agitation/trigger-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

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
