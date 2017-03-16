<?php

use Codeception\Util\Locator;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class ApiRewardsTester extends \Codeception\Actor
{
    use _generated\ApiRewardsTesterActions;

   /**
    * Define custom actions here
    */

    public function login($username,$password)
    {
       $I = $this;
       $I->wantTo('Login to super admin dashboard');
       $I->amOnPage('staffs/login');
       $I->fillField('#username', $username);
       $I->fillField('#password', $password);
       $I->click('Login');
    }

    public function logout()
    {
        $I = $this;

        $I->click(Locator::find('a', ['class' => 'fa fa-sign-out']));
        $I->wait(3);

    }

   // api to add reseller program

   public function addResellerProgram($name, $creditType, $featureId1, $featureId2, $featureId3){
        $I = $this;
        $I->amGoingTo("add new program");
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('reseller/resellerPrograms/addResellerProgram', json_encode(['program_name' => $name, 'credit_type' => $creditType, 'features' => array([$featureId1, $featureId2, $featureId3])]));
        $I->seeResponseCodeIs(200);
        $response = $I->grabResponse();
        // $programId = $I->grabDataFromResponseByJsonPath('$.response.id');
        // codecept_debug($programId);

   }

   public function generateToken($programId, $clientId, $clientSecret){
        $I = $this;
        $programId = $programId[0];
        $token = base64_encode($clientId.':'. $clientSecret);
        $I->amGoingTo('generate token for reseller program');
        $I->haveHttpHeader('Authorization ','Basic '.$token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/resellerPrograms/token', json_encode(['reseller_program_id' => $programId]));
        $I->seeResponseCodeIs(200);
        $response = $I->grabResponse();
        $I->assertNotEmpty('$response','Response contains data');
        $reseller_token = $I->grabDataFromResponseByJsonPath('$.data.token');
   } 

   public function add_patient_user($reseller_token, $name, $email, $phone)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add new patient");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/users', json_encode(['name' => $name, 'email'=>$email, 'phone'=>$phone]));
        $I->seeResponseCodeIs(200);
        $user = $I->grabResponse();
   }

   public function edit_patient_user($reseller_token, $name, $id)
   {    
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("edit patient");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPUT('api/users/edit/'.$id, json_encode(['name' => $name]));
        $I->seeResponseCodeIs(200);
        $user = $I->grabResponse();
   }

   public function add_tier($reseller_token,$tiername, $lowerbound, $upperbound, $multiplier)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add new tier");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
         $I->sendPOST('api/tiers', json_encode(['name' => $tiername,'lowerbound'=>$lowerbound, 'upperbound'=>$upperbound, 'multiplier'=>$multiplier]));
        $I->seeResponseCodeIs(200);
        $tier = $I->grabResponse();
   }

   public function edit_tier($reseller_token,$tiername, $id)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("edit tier");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
         $I->sendPUT('api/tiers/edit/'.$id, json_encode(['name' => $tiername]));
        $I->seeResponseCodeIs(200);
        $tier = $I->grabResponse();
   }


   public function add_tier_perks($tierId, $perk)
   {
        $I = $this;
        $I->amGoingTo("add new tier perk");
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/tierPerks', json_encode(['tier_id' => $tierId, 'perk' => $perk]));
        $I->seeResponseCodeIs(200);
        $tierPerk = $I->grabResponse();
   }

    public function edit_tier_perks($perk, $id)
   {
        $I = $this;
        $I->amGoingTo("edit tier perk");
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPUT('api/tierPerks/edit/'.$id, json_encode(['perk' => $perk]));
        $I->seeResponseCodeIs(200);
        $tierPerk = $I->grabResponse();
   }

   public function add_promotion($reseller_token,$promoname, $description, $points, $frequency)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add new promotion");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/promotions', json_encode(['name' => $promoname,'description'=>$description, 'points'=>$points, 'frequency'=>$frequency]));
        $I->seeResponseCodeIs(200);
        $tier = $I->grabResponse();
   }

   public function edit_promotion($reseller_token,$promoname, $frequency, $id)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("edit promotion");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPUT('api/promotions/edit/'.$id, json_encode(['name' => $promoname,'frequency'=>$frequency]));
        $I->seeResponseCodeIs(200);
        $tier = $I->grabResponse();
   }
   public function promotion_awards($reseller_token, $user, $promotion)
   {
      $reseller_token = $reseller_token[0];
      $user = $user[0];
      $I = $this;
      $I->amGoingTo("award promotion to user");
      $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
      // $I->sendPOST('api/awards/promotions', json_encode(["selectedPromotions" => array([$promoId1, $promotion]), 'user_id' => $user]));
      $I->sendPOST('api/awards/promotions', json_encode(['user_id' => $user, "selectedPromotions" => array($promotion)]));
      $I->seeResponseCodeIs(200);
      $promotionaward = $I->grabResponse();
   }

   public function tier_awards($reseller_token, $user, $amount, $bounteeId)
   {
      $reseller_token = $reseller_token[0];
      $user = $user[0];
      $I = $this;
      $I->amGoingTo("award tier to user");
      $I->haveHttpHeader('Authorization','Bearer '.$reseller_token);
      $I->haveHttpHeader('Accept', 'application/json'); 
      $I->haveHttpHeader('Content-Type','application/json');
      $I->sendPOST('api/awards/tier', json_encode(['user_id' => $user, 'amount' => $amount, 'bountee_transaction_id' => $bounteeId]));
      $I->seeResponseCodeIs(200);
      $tieraward = $I->grabResponse();
   }

   // doubt 
   public function add_surveys($survey_name)
   {
        $I = $this;
        $I->amGoingTo("add new survey");
        // $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/surveys/add', json_encode(['name' => $survey_name]));
        $I->seeResponseCodeIs(200);
        $survey = $I->grabResponse();
   }

   public function add_questions($question_type_id, $text, $frequency, $points)
   {
        $I = $this;
        $I->amGoingTo("add new question");
        $I->haveHttpHeader('Accept', 'application/json', 'Content-Type','application/json'); 
        // $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/surveys/add_questions', json_encode(['question_type_id' => $question_type_id, 'text' => $text, 'frequency' => $frequency, 'points' => $points]));
        $I->seeResponseCodeIs(200);
        $question = $I->grabResponse();
   }

   public function add_survey_questions($surveyId, $questionId, $surveyId1, $questionId1)
   {
        $I = $this;
        $I->amGoingTo("add new survey question");
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/surveys/add_survey_question', json_encode(array(['survey_id' => $surveyId, 'question_id' => $questionId], ['survey_id' => $surveyId1, 'question_id' => $questionId1])));
        $I->seeResponseCodeIs(200);
        $surveyQuestion = $I->grabResponse();
   }

   public function add_reseller_program_survey($reseller_token, $surveyId, $surveyType)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add reseller program survey");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/surveys/add_reseller_program_survey', json_encode(['survey_id' => $surveyId, 'survey_type' => $surveyType]));
        $I->seeResponseCodeIs(200);
        $resellerProgramSurvey = $I->grabResponse();
   }

   public function add_reseller_program_survey_question($resellerProgramSurveyId, $surveyQuestionId, $points)
   {
        $I = $this;
        $I->amGoingTo("add reseller program survey question");
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/surveys/add_reseller_program_survey_question', json_encode(['reseller_program_survey_id' => $resellerProgramSurveyId, 'survey_question_id' => $surveyQuestionId, 'points' => $points]));
        $I->seeResponseCodeIs(200);
        $resellerProgramSurveyQuestion = $I->grabResponse();
   }

   public function addMilestone($reseller_token, $name, $is_limited, $duration, $level_name, $level_number, $rewardtype, $points, $level_rule)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add milestone");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/resellerProgramMilestones/addmilestone', json_encode(['name' => $name, 'is_limited' => $is_limited, 'duration' => $duration, 'milestone_levels' => array(array('name' => $level_name, 'level_number' => $level_number, 'milestone_level_rewards'=> array('reward_type_id' => $rewardtype, 'points' => $points), 'milestone_level_rules' => array('level_rule' => $level_rule)))]));
        $I->seeResponseCodeIs(200);
        $milestone = $I->grabResponse();
   }

    public function surveyAndMilestoneAward($reseller_token, $user, $resellerProgSurveyQuesId, $response, $perfectSuvey, $resellerProgSurveyQuesId1, $response1, $perfectSuvey1)
    {
        $reseller_token = $reseller_token[0];
        $user = $user[0];
        $I = $this;
        $I->amGoingTo("award tier to user");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/surveyAwards/saveResponses', json_encode(['user_id' => $user, 'survey_instance_responses' => array(['reseller_program_survey_question_id' => $resellerProgSurveyQuesId, 'response' => $response, 'forPerfectSurvey' => $perfectSuvey], ['reseller_program_survey_question_id' => $resellerProgSurveyQuesId1, 'response' => $response1, 'forPerfectSurvey' => $perfectSuvey1])]));
        $I->seeResponseCodeIs(200);
        $award = $I->grabResponse();
    }

    public function add_gift_coupon($reseller_token, $points, $description, $expiryTime, $reason)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add gift coupon");
        $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/giftCoupons', json_encode(['points' => $points, 'description' => $description, 'expiry_duration' => $expiryTime, 'reason' => $reason]));
        $I->seeResponseCodeIs(200);
        $giftCoupon = $I->grabResponse();
   }

   public function edit_gift_coupon($reseller_token, $points, $id)
   {    
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add gift coupon");
         $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPUT('api/giftCoupons/edit/'.$id, json_encode(['points' => $points]));
        $I->seeResponseCodeIs(200);
        $giftCoupon = $I->grabResponse();
   }

   public function manual_awards($reseller_token, $user, $points){
      $reseller_token = $reseller_token[0];
      $user = $user[0];
      $I = $this;
      $I->amGoingTo("manual award to user");
      $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
      $I->haveHttpHeader('Accept', 'application/json'); 
      $I->haveHttpHeader('Content-Type','application/json');
      $I->sendPOST('api/awards/manual', json_encode(['user_id' => $user, 'points' => $points]));
      $I->seeResponseCodeIs(200);
      $tieraward = $I->grabResponse();
   }

   public function giftCouponAward($reseller_token, $user, $giftCouponId){
      $reseller_token = $reseller_token[0];
      $user = $user[0];
      $I = $this;
      $I->amGoingTo("award survey to user");
      $I->haveHttpHeader('Authorization ','Bearer '.$reseller_token);
      $I->haveHttpHeader('Accept', 'application/json'); 
      $I->haveHttpHeader('Content-Type','application/json');
      $I->sendPOST('api/awards/giftCoupon', json_encode(['user_id' => $user, 'gift_coupon_id' => $giftCouponId]));
      $I->seeResponseCodeIs(200);
      $tieraward = $I->grabResponse();
   }

}
