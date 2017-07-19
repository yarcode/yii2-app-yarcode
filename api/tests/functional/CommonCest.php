<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

namespace api\tests\functional;

use api\tests\FunctionalTester;

/**
 * Class CommonCest
 * @package api\tests\functional
 */
class CommonCest
{
    public function testError404(FunctionalTester $I)
    {
        $I->wantTo('get 404 Error');
        $I->sendGET('/undefined-module');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['success' => false]);
        $I->seeResponseContainsJson(['status' => 404]);
    }

}
