<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

namespace api\tests\functional;
use api\tests\FunctionalTester;

/**
 * Class LoginCest
 */
class ApiCest
{
    public function testVersion(FunctionalTester $I)
    {
        $I->wantTo('get API version');
        $I->sendGET('/v1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['success' => true]);
        $I->seeResponseContainsJson(['status' => 200]);
        $I->seeResponseContainsJson(['version' => '1.0']);

    }

    public function testError404(FunctionalTester $I)
    {
        $I->wantTo('get 404 Error');
        $I->sendGET('/v1/undefined-action');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['success' => false]);
        $I->seeResponseContainsJson(['status' => 404]);
    }

}
