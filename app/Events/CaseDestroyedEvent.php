<?php


namespace App\Events;

use App\Model\Cases;
use Illuminate\Queue\SerializesModels;

class CaseDestroyedEvent{
    use SerializesModels;

    public $case;

    public function __construct(Cases $case){
        $this->case = $case;
    }
}