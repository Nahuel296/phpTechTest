<?php

namespace Application\User\EventHandler;

use Domain\User\Event\UserRegisteredEvent;

class SendWelcomeEmailHandler
{
    public function __invoke(UserRegisteredEvent $event)
    {
        $user = $event->getUser();
        
        echo "Email sent to: " . $user->getEmail()->value();
    }
}
