<?php

namespace Agit\TriggerBundle\Service;

use DateTime;
use Exception;
use DateInterval;
use Serializable;
use Agit\CommonBundle\Helper\StringHelper;

use Doctrine\ORM\EntityManager;
use Agit\IntlBundle\Translate;
use Agit\TriggerBundle\Entity\TriggerAction;

use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

class TriggerService
{
    const DEFAULT_TTL = 86400;

    private $entityManager;

    private $container;

    public function __construct(EntityManager $entityManager, $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    public function createTrigger($service, $method, TriggerData $data, $ttl = self::DEFAULT_TTL)
    {
        $expires = new DateTime();
        $expires->add(new DateInterval("PT{$ttl}S"));

        $triggerAction = new TriggerAction();
        $triggerAction->setToken(StringHelper::createRandomString(20));
        $triggerAction->setService($service);
        $triggerAction->setMethod($method);
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
            throw new InvalidCsrfTokenException("The requested token was not found.");

        $service = $triggerAction->getService();
        $method = $triggerAction->getMethod();
        $data = $triggerAction->getData();

        // remove before executing, in case there are exceptions
        $this->entityManager->remove($triggerAction);
        $this->entityManager->flush();

        $this->container->get($service)->$method($data);
    }
}
