<?php


namespace App\Events;

use App\Model\Cases;
use Illuminate\Queue\SerializesModels;

class CaseCreatedEvent{
    use SerializesModels;

    public $case;

    /**
     * 创建事件实例
     * CaseCreatedEvent constructor.
     * @param Cases $case
     */
    public function __construct(Cases $case){
        $this->case = $case;
    }
}