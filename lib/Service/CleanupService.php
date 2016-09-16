<?php

/*
 * @package    agitation/trigger-bundle
 * @link       http://github.com/agitation/trigger-bundle
 * @author     Alexander Günsche
 * @license    http://opensource.org/licenses/MIT
 */

namespace Agit\TriggerBundle\Service;

use Agit\CronBundle\Event\CronjobRegistrationEvent;
use DateTime;
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
