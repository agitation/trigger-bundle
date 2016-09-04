<?php

namespace Agit\TriggerBundle\Service;

use DateTime;
use Exception;
use DateInterval;
use Serializable;
use Agit\ApiBundle\Exception\ObjectNotFoundException;
use Agit\BaseBundle\Tool\StringHelper;
use Doctrine\ORM\EntityManager;
use Agit\BaseBundle\Tool\Translate;
use Agit\TriggerBundle\Entity\TriggerAction;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TriggerService
{
    const DEFAULT_TTL = 86400;

    private $entityManager;

    private $eventDispatcher;

    public function __construct(EntityManager $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createTrigger($tag, TriggerData $data, $ttl = self::DEFAULT_TTL)
    {
        $expires = new DateTime();
        $expires->add(new DateInterval("PT{$ttl}S"));

        $triggerAction = new TriggerAction();
        $triggerAction->setToken(StringHelper::createRandomString(20));
        $triggerAction->setTag($tag);
        $triggerAction->setData($data);
        $triggerAction->setExpires($expires);

        $this->entityManager->persist($triggerAction);
        $this->entityManager->flush();

        return $triggerAction->getToken();
    }

    public function pullTrigger($token)
    {
        $triggerAction = $this->entityManager->getRepository("AgitTriggerBundle:TriggerAction")
            ->findOneBy([ "token" => $token ]);

        if (!$triggerAction)
            throw new ObjectNotFoundException("The requested token was not found.");

        $tag = $triggerAction->getTag();
        $data = $triggerAction->getData()->getValues();

        // remove before executing, in case there are exceptions
        $this->entityManager->remove($triggerAction);
        $this->entityManager->flush();

        $this->eventDispatcher->dispatch("agit.trigger", new TriggerEvent($tag, $data));
    }
}
