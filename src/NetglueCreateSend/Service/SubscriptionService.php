<?php

namespace NetglueCreateSend\Service;

use NetglueCreateSendApi\Client\CreateSendClient;
use NetglueCreateSendApi\Exception as ApiException;


use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;

class SubscriptionService implements
                          EventManagerAwareInterface
{

    use EventManagerAwareTrait;

    /**
     * @var CreateSendClient
     */
    private $client;

    /**
     * @param CreateSendClient $client
     * @return void
     */
    public function __construct(CreateSendClient $client)
    {
        $this->client = $client;
    }

    /**
     * Subscribe the email address to the given list
     * @param string $email
     * @param string $listId
     * @param array $apiParams Other API Paramaters
     * @return bool
     */
    public function subscribe($email, $listId, $apiParams = array())
    {
        $email = trim(strtolower($email));
        $apiParams['EmailAddress'] = $email;
        $apiParams['ListId'] = $listId;

        $defaults = array(
            'Resubscribe' => true,
            'RestartSubscriptionBasedAutoresponders' => true,
        );

        $data = array_merge($defaults, $apiParams);

        try {
            $this->client->subscribe($data);
            $this->getEventManager()->trigger(__FUNCTION__, $this, $data);

            return true;
        } catch(ApiException\ExceptionInterface $e) {
            $data['exception'] = $e;
            switch($e->getCode()) {
                case 1:
                    $event = 'error';
                    break;
                case 204:
                case 205:
                case 206:
                case 207:
                    $event = 'suppressed';
                    break;
                case 208:
                    $event = 'unconfirmed';
                    break;

                case null:
                    $event = 'unknown';
                    break;
            }
            $this->getEventManager()->trigger(__FUNCTION__ . '.' . $event, $this, $data);

            return false;
        }

    }


}
