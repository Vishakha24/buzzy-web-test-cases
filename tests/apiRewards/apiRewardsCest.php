<?php


class apiRewardsCest
{
    public function _before(ApiRewardsTester $I)
    {
    }

    public function _after(ApiRewardsTester $I)
    {
    }

    // tests
    public function tryToTest(ApiRewardsTester $I)
    {
    }

    public function reward_api(ApiRewardsTester $I)
    {

         //reseller program token
          $resellerProgramId = 2;
          $I->amGoingTo('generate token for reseller program');
          $I->haveHttpHeader('token ','Basic MTIzNDU2Nzg5OjEyMzQ1Njc4OQ==');
          $I->haveHttpHeader('Accept', 'application/json'); 
          $I->haveHttpHeader('Content-Type','application/json');
          $I->sendPOST('api/resellerPrograms/token', json_encode(['reseller_program_id' => $resellerProgramId]));
          $I->seeResponseCodeIs(200);
          $response = $I->grabResponse();
          $I->assertNotEmpty('$response','Response contains data');
          $reseller_token = $I->grabDataFromResponseByJsonPath('$.data.token');

          // add new user(patient)
          $I->add_patient_user($reseller_token, "asv", "asv@gmail.co", "9876543456");
          $user = $I->grabDataFromResponseByJsonPath('$.response.data.id');
          codecept_debug($user);
          //add tier and tier perks
          $I->add_tier($reseller_token,'test', '100', '200', '0.01');

          $I->add_tier_perks(1, "testtierperk");

          $I->add_promotion($reseller_token, "testpromo", "testpromodesc", 40, 8);
          $promotion = $I->grabDataFromResponseByJsonPath('$.response.data.id');
          codecept_debug($promotion);

          $I->tier_awards($reseller_token, $user, '1000', 1);

          $I->promotion_awards($reseller_token, $user, 3, 4, $promotion);

          $I->add_surveys("survey test");
          $I->add_questions(1, "testing", 7, 50);
          $I->add_survey_questions(1, 1, 2, 2);
          $I->add_reseller_program_survey($reseller_token, 1);
          $I->add_reseller_program_survey_question(1, 1, 50);
    }

}
