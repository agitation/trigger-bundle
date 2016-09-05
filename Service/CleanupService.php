<?php

namespace Agit\TriggerBundle\Service;

use DateTime;
use Agit\BaseBundle\Event\CronjobRegistrationEvent;
use Doctrine\ORM\EntityManager;

class CleanupService
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function cronjobRegistration(CronjobRegistrationEvent $event)
    {
        $event->registerCronjob("*/10 * * * *", [$this, "cleanup"]);
    }

    public function cleanup()
    {
        $this->entityManager->createQueryBuilder()
            ->delete("AgitTriggerBundle:TriggerAction", "action")
            ->where("action.expires <= :now")
            ->setParameter("now", new DateTime())
            ->getQuery()->execute();
    }
}
