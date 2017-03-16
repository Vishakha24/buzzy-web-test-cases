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
          $I->login('qwerty', '12345678');
          
          //add reseller program
          $I->addResellerProgram('testProgram', 'store', 1, 2, 3);
          $programId = $I->grabDataFromResponseByJsonPath('$.response.id');
          codecept_debug($programId);

          // generate reseller program token
          $I->generateToken($programId, '123456789', '123456789');
          $reseller_token = $I->grabDataFromResponseByJsonPath('$.data.token');
          codecept_debug($reseller_token);

          // add new user or patient
          $I->add_patient_user($reseller_token, "vckz", "vckz@gmail.co", "9876543456");
          $user = $I->grabDataFromResponseByJsonPath('$.response.data.id');
          codecept_debug($user);

          // edit patient
          $I->edit_patient_user($reseller_token, 'akdrm', 1);

          // add promotion
          $I->add_promotion($reseller_token, "testpromo", "testpromodesc", 40, 8);
          $promotion = $I->grabDataFromResponseByJsonPath('$.response.data.id');
          codecept_debug($promotion);
          $promotion = $promotion[0];

          // award promotion
          $I->promotion_awards($reseller_token, $user, $promotion);
          // edit promotion
          $I->edit_promotion($reseller_token,'promo1', 5, 1);
          // $promotion = $I->grabDataFromResponseByJsonPath('$.promotion.id');
          // codecept_debug($promotion);
          // $promotion = $promotion[0];
 


          //add tier
          $I->add_tier($reseller_token,'test tier', '100', '200', '0.01');

          // edit tier
          $I->edit_tier($reseller_token,'tier 1', 1);

          // add tier perks
          $I->add_tier_perks(1, "testtierperk");

          // edit tier perk
          $I->edit_tier_perks('perk 1', 1);

          // award tiers
          $I->tier_awards($reseller_token, $user, '1000', 1);

          //add gift coupon
          $I->add_gift_coupon($reseller_token, 100, 'gift coupon', 8, 'gift coupon');

          //edit gift coupon
          $I->edit_gift_coupon($reseller_token, 250, 1);

          //manual award
          $I->manual_awards($reseller_token, $user, 100);

          // //gift coupon award(api is not working)
          // $I->giftCouponAward($reseller_token, $user, 1);

          // // api is working fine but there is prob in test case
          // $I->add_surveys("survey test");
          // $I->add_questions(1, "testing", 7, 50);
          // $I->add_survey_questions(1, 1, 2, 2);

          // add reseller program survey 
          $I->add_reseller_program_survey($reseller_token, 1, 'perfect');

          // add reseller program survey question
          $I->add_reseller_program_survey_question(1, 1, 50);

          // add milestone program 
          $I->addMilestone($reseller_token, 'milestone program', 1, 10, 'level 1', 1, 1, 100, 3);

          //survey and milestone award
          $I->surveyAndMilestoneAward($reseller_token, $user, 1, 'yes', 1, 2, 'no', 0);
    }

}
