<?php
declare(strict_types=1);
/*
 * @package    agitation/trigger-bundle
 * @link       http://github.com/agitation/trigger-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\TriggerBundle\Exception;

use Agit\BaseBundle\Exception\PublicException;

/**
 * A non-existent ticket has been requested or referenced.
 */
class InvalidTokenException extends PublicException
{
    protected $statusCode = 400;
}
