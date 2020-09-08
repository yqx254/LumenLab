<?php


namespace App\Listeners;


use App\Events\CaseCreatedEvent;
use App\Events\CaseDestroyedEvent;

class CaseSubscriber{
    public function caseCreate(CaseCreatedEvent $event){
        echo 'I know one case is created!';
    }

    public function caseDestroy(CaseDestroyedEvent $event){
        echo 'I know one case is destroyed!';
    }

    public function subscribe($event){
        $event->listen(
            'App\Events\CaseCreatedEvent', 'App\Listeners\CaseSubscriber@caseCreate'
        );
        $event->listen(
            'App\Events\CaseDestroyedEvent', 'App\Listeners\CaseSubscriber@caseDestroy'
        );
    }
}