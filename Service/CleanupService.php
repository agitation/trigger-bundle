<?php

namespace Agit\TriggerBundle\Service;

use DateTime;
use Agit\CronBundle\Cron\CronAwareInterface;
use Agit\CronBundle\Event\CronjobRegistrationEvent;
use Doctrine\ORM\EntityManager;

class CleanupService implements CronAwareInterface
{
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function cronjobRegistration(CronjobRegistrationEvent $event)
    {
        $event->registerCronjob($this, "*/15 * * * *");
    }

    public function cronjobExecute()
    {
        $this->entityManager->createQueryBuilder()
            ->delete("AgitTriggerBundle:TriggerAction", "action")
            ->where("action.expires <= :now")
            ->setParameter("now", new DateTime())
            ->getQuery()->execute();
    }
}
