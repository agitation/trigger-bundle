<?php

namespace Agit\TriggerBundle\Exception;

use Agit\BaseBundle\Exception\AgitException;

/**
 * A non-existent ticket has been requested or referenced.
 */
class InvalidTokenException extends AgitException
{
    protected $httpStatus = 400;
}
