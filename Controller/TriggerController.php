<?php

namespace Agit\TriggerBundle\Controller;

use Exception;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TriggerController extends Controller
{
    public function tokenAction($token)
    {
        try
        {
            $this->container->get("agit.trigger")->pullTrigger($token);
            $response = new Response("", 204);
        }
        catch (Exception $e)
        {
            $response = new Response($e->getMessage(), 500);
        }

        $response->headers->set("Content-Type", "text/plain");
        $response->headers->set("Expires", "Mon, 7 Apr 1980 05:00:00 GMT");
        $response->headers->set("Cache-Control", "no-cache, must-revalidate, max-age=0", true);
        $response->headers->set("Pragma", "no-store", true);

        return $response;
    }

    private function getTicket($code)
    {
        $codeParts = explode("-", $code);

        if (count($codeParts) !== 2)
            throw new TicketNotFoundException("Invalid ticket ID: $code");

        $ticket = $this->container->get("doctrine.orm.entity_manager")
            ->getRepository("TixysCommonModelBundle:Ticket")
            ->findOneBy(["id" => (int)$codeParts[0], "code" => $codeParts[1]]);

        if (!$ticket)
            throw new TicketNotFoundException("Invalid ticket ID: $code");

        return $ticket;
    }
}
