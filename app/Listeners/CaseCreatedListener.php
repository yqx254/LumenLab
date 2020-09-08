<?php


namespace App\Listeners;


use App\Events\CaseCreatedEvent;

class CaseCreatedListener{
    public function __construct(){

    }

    public function handle(CaseCreatedEvent $event){
        echo $event->case->create_tel;
        \Log::info("Listening case creating");
    }
}