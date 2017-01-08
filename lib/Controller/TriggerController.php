<?php

/*
 * @package    agitation/trigger-bundle
 * @link       http://github.com/agitation/trigger-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\TriggerBundle\Controller;

use Agit\BaseBundle\Exception\PublicException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TriggerController extends Controller
{
    public function tokenAction($token)
    {
        try {
            $this->container->get("agit.trigger")->pullTrigger($token);
            $response = new Response("", 204);
        } catch (PublicException $e) {
            $response = new Response($e->getMessage(), $e->getStatusCode());
        } catch (Exception $e) {
            $response = new Response("Internal error.", 500);
        }

        $response->headers->set("Content-Type", "text/plain");
        $response->headers->set("Expires", "Mon, 7 Apr 1980 05:00:00 GMT");
        $response->headers->set("Cache-Control", "no-cache, must-revalidate, max-age=0", true);
        $response->headers->set("Pragma", "no-store", true);

        return $response;
    }
}
