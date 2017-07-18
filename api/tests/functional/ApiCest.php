<?php

namespace api\tests\functional;
use api\tests\FunctionalTester;

/**
 * Class LoginCest
 */
class ApiCest
{
    public function testList(FunctionalTester $I)
    {
        $I->wantTo('get list of offers');
        $I->sendGET('/v1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['version' => '1.0']);
    }
}
