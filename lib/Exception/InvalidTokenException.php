<?php

/*
 * @package    agitation/trigger-bundle
 * @link       http://github.com/agitation/trigger-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\TriggerBundle\Exception;

use Agit\BaseBundle\Exception\AgitException;

/**
 * A non-existent ticket has been requested or referenced.
 */
class InvalidTokenException extends AgitException
{
    protected $statusCode = 400;
}
