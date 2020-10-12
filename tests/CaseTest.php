<?php


use App\Http\Controllers\Facades\FacadeTest;
class CaseTest extends TestCase{


    public function testBasic(){
        echo FacadeTest::someService();
    }
}