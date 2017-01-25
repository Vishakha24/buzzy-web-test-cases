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

   public function add_patient_user($reseller_token, $name, $email, $phone)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add new patient");
        $I->haveHttpHeader('token ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/users', json_encode(['name' => $name, 'email'=>$email, 'phone'=>$phone]));
        $I->seeResponseCodeIs(200);
        $user = $I->grabResponse();
   }

   public function add_tier($reseller_token,$tiername, $lowerbound, $upperbound, $multiplier)
   {
        $reseller_token = $reseller_token[0];
       	$I = $this;
       	$I->amGoingTo("add new tier");
        $I->haveHttpHeader('token ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/tiers', json_encode(['name' => $tiername,'lowerbound'=>$lowerbound, 'upperbound'=>$upperbound, 'multiplier'=>$multiplier]));
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
        $tier = $I->grabResponse();
   }

   public function add_promotion($reseller_token,$promoname, $description, $points, $frequency)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add new promotion");
        $I->haveHttpHeader('token ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/promotions', json_encode(['name' => $promoname,'description'=>$description, 'points'=>$points, 'frequency'=>$frequency]));
        $I->seeResponseCodeIs(200);
        $tier = $I->grabResponse();
   }
   public function promotion_awards($reseller_token, $user, $promoId1, $promoId2, $promotion)
   {
      $reseller_token = $reseller_token[0];
      $user = $user[0];
      $I = $this;
      $I->amGoingTo("award promotion to user");
      $I->haveHttpHeader('token ','Bearer '.$reseller_token);
      $I->haveHttpHeader('Accept', 'application/json'); 
      $I->haveHttpHeader('Content-Type','application/json');
      $I->sendPOST('api/awards/promotions', json_encode(["selectedPromotions" => array($promoId1, $promoId2, $promotion), 'user_id' => $user]));
      $I->seeResponseCodeIs(200);
      $promotionaward = $I->grabResponse();
   }

   public function tier_awards($reseller_token, $user, $amount, $bounteeId)
   {
      $reseller_token = $reseller_token[0];
      $user = $user[0];
      $I = $this;
      $I->amGoingTo("award tier to user");
      $I->haveHttpHeader('token ','Bearer '.$reseller_token);
      $I->haveHttpHeader('Accept', 'application/json'); 
      $I->haveHttpHeader('Content-Type','application/json');
      $I->sendPOST('api/awards/tier', json_encode(['user_id' => $user, 'amount' => $amount, 'bountee_transaction_id' => $bounteeId]));
      $I->seeResponseCodeIs(200);
      $tieraward = $I->grabResponse();
   }

   public function add_surveys($survey_name)
   {
        $I = $this;
        $I->amGoingTo("add new survey");
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
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
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

   public function add_reseller_program_survey($reseller_token, $surveyId)
   {
        $reseller_token = $reseller_token[0];
        $I = $this;
        $I->amGoingTo("add reseller program survey");
        $I->haveHttpHeader('token ','Bearer '.$reseller_token);
        $I->haveHttpHeader('Accept', 'application/json'); 
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPOST('api/surveys/add_reseller_program_survey', json_encode(['survey_id' => $surveyId]));
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
}
