<?php
use \Codeception\Util\Locator;

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
class VendorPromotionsTester extends \Codeception\Actor
{
    use _generated\VendorPromotionsTesterActions;

   /**
    * Define custom actions here
    */
   	public function login($username,$password)
	{
	   $I = $this;
       $I->wantTo('Login to super admin dashboard');
       $I->amOnPage('');
       $I->maximizeWindow();
       $I->fillField('#username', $username);
	   $I->fillField('#password', $password);
	   $I->click('Login');
	   $I->wait(3);
	}

	public function logout()
	{
	    $I = $this;

	    $I->click(Locator::find('a', ['class' => 'fa fa-sign-out']));
	    $I->wait(3);
	    $I->seeInCurrentUrl('/users/login');

	}

	public function positive_case_for_add_view_promotions($promotion_name, $description, $points, $frequency, $option)
	{
		//Add method

		$I = $this;
        $I->amGoingTo('Add Promotions');
        $I->wait(3);
        $I->click('Settings');
        $I->wait(4);
         if($admin == 1)
        {
            $I->click('Vendor Settings');
            $I->wait(5);
            $I->click('Vendor Promotions');
            $I->wait(5);
        }else{
            $I->click('Vendor Promotions');
            $I->wait(5);
        }
        $I->click(Locator::find('a', ['class' => 'btn btn-success'])); 
        // $I->waitForElementVisible('#name', 4);
        $I->wait(4);
        $I->seeInCurrentUrl('promotions/add');
        $I->wait(3);
        $I->fillField('#name', $promotion_name); 
        $I->fillField("#description", $description);
        $I->fillField("#points", $points);
         $I->fillField("#frequency", $frequency);
        $I->click('Submit');
        $I->wait(5);
        $I->see('Vendor Promotions');
        $I->seeInCurrentUrl('vendor-promotions');
        $I->wait(3);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->seeCheckboxIsChecked(Locator::lastElement(Locator::find('input', ['type' => 'checkbox'])));

        //View Method
         $I->wait(4);
         $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
         $I->wait(5);
         $I->see($promotion_name);
         $I->see($description);
         $I->see($points);
         $I->see($frequency);
         $I->wait(3);
         $I->click('Back');


	}

    public function positive_case_for_edit_delete_promotions($points, $option)
    {
    	//Edit method

        $I = $this;
        $I->amGoingTo('Edit Vendor Promotions');
        $I->wait(3);
        $I->click('Settings');
        $I->wait(4);	   
 		 if($admin == 1)
        {
            $I->click('Vendor Settings');
            $I->wait(5);
            $I->click('Vendor Promotions');
            $I->wait(5);
        }else{
            $I->click('Vendor Promotions');
            $I->wait(5);
        }
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(4);
		$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning edit'])));
	    $I->fillField("#points", $points);
	    $I->wait(4);
	    $I->click('Submit');
        $I->wait(5);
        $I->see('Vendor Promotions');
        $I->seeInCurrentUrl('vendor-promotions');
        $I->see($points);

        // Delete Vendor

        $I->wait(2);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(5);   
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Vendor Promotions
        $I->wait(3); 
        $I->seeInPopup('Are you sure you want to delete');
        $I->wait(3);
        $I->acceptPopup();
        $I->wait(3);
     
	}

	public function positive_vendor_promotions_checkboxChecked_edit($points)
	{
		$I = $this;
        $I->amGoingTo('Edit Vendor Promotions');
        $I->wait(3);
        $I->click('Settings');
        $I->wait(4);	   
 		 if($admin == 1)
        {
            $I->click('Vendor Settings');
            $I->wait(5);
            $I->click('Vendor Promotions');
            $I->wait(5);
        }else{
            $I->click('Vendor Promotions');
            $I->wait(5);
        }
        $I->checkOption("/descendant::input[@type='checkbox'][2]");
        $I->wait(4);
        $I->seeCheckboxIsChecked("/descendant::input[@type='checkbox'][2]");
        $I->wait(4);
        $I->click(Locator::elementAt(Locator::find('a', ['class' => 'btn btn-xs btn-warning edit']),2));
        $I->wait(4);
        $I->fillField("#points", $points);
	    $I->wait(4);
	    $I->click('Submit');
        $I->wait(5);
        $I->see('Vendor Promotions');
        $I->seeInCurrentUrl('vendor-promotions');
        $I->see($points);
        $I->wait(2);
        $I->uncheckOption("/descendant::input[@type='checkbox'][2]");
        $I->wait(4);
        $I->dontSeeCheckboxIsChecked("/descendant::input[@type='checkbox'][2]");
        $I->wait(4);

	}

	public function BuzzyDoc_validations($desc,$input, $attribute,$expected,$message)
    {
		$I = $this;
		$I->amGoingTo($desc);
		$temp= $I->grabAttributeFrom($input, $attribute);
		$I->assertEquals($expected, $temp, $message);
	}

	public function negative_case_for_add_view_promotions($promotion_name, $description, $points, $frequency, $option)
	{
		$I = $this;
		$I->amGoingTo('Add Promotions');
		$I->wait(3);
        $I->click('Settings');
        $I->wait(3);
        if($admin == 1)
        {
            $I->click('Vendor Settings');
            $I->wait(5);
            $I->click('Vendor Promotions');
            $I->wait(5);
        }else{
            $I->click('Vendor Promotions');
            $I->wait(5);
        }
		$I->click('Add Promotions');
		$I->wait(2);
		$I->click('Submit');
		$I->wait(3);
		$I->BuzzyDoc_validations('check required validation for promotion name', '#name', 'required', 'true', 'verified validation for promotion name');
        $I->fillField('#name', $promotion_name);
		$I->click('Submit');
		$I->wait(3);
		$I->BuzzyDoc_validations('check required validation for description', '#description', 'required', 'true', 'verified validation for description');
		$I->fillField('#description', $description);
		$I->click('Submit');
		$I->BuzzyDoc_validations('check required validation for points', '#points', 'required', 'true', 'verified validation for points');
		$I->BuzzyDoc_validations('check minimum value validation for points', '#points', 'min', 1, 'verified minimum value validation for points');
		$I->BuzzyDoc_validations('check integer value validation for points', '#points', 'type', 'number' , 'verified integer value validation for points');
		$I->fillField('#points', $points);
		$I->click('Submit');
        $I->BuzzyDoc_validations('check required validation for frequency', '#frequency', 'required', 'true', 'verified validation for points');
        $I->BuzzyDoc_validations('check minimum value validation for frequency', '#frequency', 'min', 0, 'verified minimum value validation for points');
        $I->BuzzyDoc_validations('check integer value validation for frequency', '#frequency', 'type', 'number' , 'verified integer value validation for points');
        $I->fillField('#frequency', $frequency);
        $I->click('Submit');
        $I->wait(3);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->seeCheckboxIsChecked(Locator::lastElement(Locator::find('input', ['type' => 'checkbox'])));

        //View Method
         $I->wait(4);
         $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
         $I->wait(5);
         $I->see($promotion_name);
         $I->see($description);
         $I->see($points);
         $I->see($frequency);
         $I->wait(3);
         $I->click('Back');
	}

	public function negative_case_for_edit_delete_vendor_promotions($points, $option)
    {
    	//Edit

        $I = $this;
        $I->amGoingTo('Edit Vendor Promotions');
        $I->wait(3);
        $I->click('Settings');
        if($admin == 1)
        {
            $I->click('Vendor Settings');
            $I->wait(5);
            $I->click('Vendor Promotions');
            $I->wait(5);
        }else{
            $I->click('Vendor Promotions');
            $I->wait(5);
        }
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(3);
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning edit'])));
        $I->wait(5);
        $I->BuzzyDoc_validations('check disabled validation for promotion name ','#promotion-id','disabled','true','disabled validation verified for promotion name');
        $I->BuzzyDoc_validations('check required validation for points', '#points', 'required', 'true', 'verified validation for points');
		$I->BuzzyDoc_validations('check minimum value validation for points', '#points', 'min', 0, 'verified minimum value validation for points');
		$I->BuzzyDoc_validations('check integer value validation for points', '#points', 'type', 'number' , 'verified integer value validation for points');
		$I->fillField('#points', $points);
        $I->click('Submit');

        //Delete
        $I->wait(3);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(3);
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Vendor Promotions
        $I->wait(3); 
        $I->seeInPopup('Are you sure you want to delete');
        $I->wait(3);
        $I->cancelPopup();
        $I->wait(3); 

    }

    public function positive_case_for_add_template($name, $plan, $industry, $reviews, $ratings, $facebook, $google_plus, $yelp, $rate_md, $healthgrades, $referral_level_name, $referrer_award_points, $referree_award_points, $promoid1, $promoid2, $promoid3, $tiername, $lowerbound, $upperbound, $multiplier, $giftcoupon, $mileid, $giftcouponid1, $giftcouponid2, $giftcouponid3, $surveyid)
    {
    	$I = $this;
        $I->amGoingTo('Add new Template');
        $I->click('Templates');
        $I->wait(5);
        $I->click('Add Template');
        $I->wait(5);
        $I->fillField('#name', $name);
        $I->wait(5);
        $I->selectOption('select[name=plan_id]', $plan);
        $I->wait(5);
        $I->selectOption('select[id=industry_input]', $industry);
        $I->wait(5);
        $I->click('#tempName');
        $I->wait(5);
        // $I->click(Locator::find('a', ['href' => '#tab-1']));
        $I->makeScreenshot('Review Settings');
    	$I->fillField('#review-points', $reviews);
    	$I->fillField('#rating-points', $ratings);
    	$I->fillField('#fb-points', $facebook);
    	$I->fillField('#gplus-points', $google_plus);
    	$I->fillField('#yelp-points', $yelp);
    	$I->fillField('#ratemd-points', $rate_md);
    	$I->fillField('#healthgrades-points', $healthgrades);
    	$I->click('Save');
    	$I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-2']));
        $I->fillField('#referral-level-name', $referral_level_name);
        $I->fillField('#referrer-award-points', $referrer_award_points);
        $I->fillField('#referree-award-points', $referree_award_points);
        $I->checkOption(Locator::find('input', ['type' => 'checkbox']));
        $I->wait(5);
        $I->seeCheckboxIsChecked(Locator::find('input', ['type' => 'checkbox']));
        $I->wait(5);
        $I->click('#saveRef');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-3']));
        $I->wait(5);
    	$I->checkOption(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid1.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid1.']']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid2.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid2.']']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid3.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid3.']']));
        $I->wait(5);
        $I->click('#tempProm');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-6']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid1.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid1.']']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid2.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid2.']']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid3.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid3.']']));
        $I->wait(5);
        $I->click('#tempGift');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-4']));
        $I->wait(5);
        $I->fillField(Locator::find('input', ['ng-model' => 'tier.name']), $tiername);
        $I->fillField('#lowerbound', $lowerbound);
        $I->fillField('#upperbound', $upperbound);
        $I->fillField('#multiplier', $multiplier);
        $I->selectOption(Locator::find('select', ['ng-model' => 'tier.tier_gift_coupon.gift_coupon_id']), $giftcoupon);
        $I->wait(5);
        $I->click('#tempTier');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-5']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.milestone'.'['.$mileid.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.milestone'.'['.$mileid.']']));
        $I->wait(5);
        $I->click('#tempMile');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-7']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.survey'.'['.$surveyid.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.survey'.'['.$surveyid.']']));
        $I->wait(5);
        $I->click('#tempSurv');
        $I->waitForText('The template has been saved.', 5);
        $I->click('Templates');
        $I->wait(5);
        $I->click(Locator::find('a', ['href' => '/staging/templates']));
        $I->wait(5);

    }

    public function positive_case_for_edit_delete_templates($ratings, $google_plus, $referral_level_name, $referrer_award_points, $referree_award_points, $promoid1, $giftcouponid1, $giftcoupon, $mileid, $surveyid, $option)
    {
        //Edit

        $I = $this;
        $I->amGoingTo('Edit Template');
        $I->click('Templates');
        $I->wait(3);
        $I->click(Locator::find('a', ['href' => '/staging/templates']));
        $I->wait(3);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
        // $I->waitForElementVisible('Review Settings', 5);
        $I->makeScreenshot('Review Settings');
        $I->fillField('#rating-points', $ratings);
        $I->fillField('#gplus-points', $google_plus);
        $I->click('Save');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-2']));
        $I->fillField('#referral-level-name', $referral_level_name);
        $I->fillField('#referrer-award-points', $referrer_award_points);
        $I->fillField('#referree-award-points', $referree_award_points);
        $I->uncheckOption(Locator::find('input', ['type' => 'checkbox']));
        $I->wait(3);
        $I->click('#saveRef');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-3']));
        $I->wait(4);
        $I->uncheckOption(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid1.']']));
        $I->dontSeeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid1.']']));
        $I->wait(4);
        $I->click('#tempProm');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-6']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid1.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid1.']']));
        $I->wait(5);
        $I->click('#tempGift');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-4']));
        $I->wait(5);
        $I->selectOption(Locator::find('select', ['ng-model' => 'tier.tier_gift_coupon.gift_coupon_id']), $giftcoupon);
        $I->wait(5);
        $I->click('#tempTier');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-5']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.milestone'.'['.$mileid.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.milestone'.'['.$mileid.']']));
        $I->wait(5);
        $I->click('#tempMile');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-7']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.survey'.'['.$surveyid.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.survey'.'['.$surveyid.']']));
        $I->wait(5);
        $I->click('#tempSurv');
        $I->wait(4);
        $I->click('Templates');
        $I->wait(5);
        $I->click(Locator::find('a', ['href' => '/staging/templates']));
        $I->wait(4);

        //Delete

        $I->wait(3);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Vendor Promotions
        $I->wait(3); 
        $I->seeInPopup('Are you sure you want to delete');
        $I->wait(3);
        $I->acceptPopup();
        $I->wait(3); 

    }

    public function negative_case_for_add_template($name, $plan, $industry, $reviews, $ratings, $facebook, $google_plus, $yelp, $rate_md, $healthgrades, $referral_level_name, $referrer_award_points, $referree_award_points, $promoid1, $promoid2, $promoid3, $tiername, $lowerbound, $upperbound, $multiplier, $giftcoupon, $mileid, $giftcouponid1, $giftcouponid2, $giftcouponid3, $surveyid)
    {
        $I = $this;
        $I->amGoingTo('Add new Template');
        $I->click('Templates');
        $I->wait(5);
        $I->click('Add Template');
        $I->wait(5);
        $I->BuzzyDoc_validations('check required validation for template name', '#name', 'required', 'true', 'verified validation for template name');
        $I->BuzzyDoc_validations('check validation for maximum length of template name', '#name', 'maxlength', 40, 'verified validation for maximum length of template name');
        $I->fillField('#name', $name);
        $I->wait(5);
        $I->BuzzyDoc_validations('check required validation to choose plan', Locator::find('select', ['name' => 'plan_id']), 'required', 'true', 'verified validation to choose plan');
        $I->selectOption('select[name=plan_id]', $plan);
        $I->wait(5);
        $I->BuzzyDoc_validations('check required validation to choose industry', Locator::find('select', ['name' => 'plan_id']), 'required', 'true', 'verified validation to choose industry');
        $I->selectOption('select[id=industry_input]', $industry);
        $I->wait(5);
        $I->click('#tempName');
        $I->wait(5);
        // $I->click(Locator::find('a', ['href' => '#tab-1']));
        $I->makeScreenshot('Review Settings');
        $I->BuzzyDoc_validations('check required validation for review points', '#review-points', 'required', 'true', 'verified validation for review points');
        $I->BuzzyDoc_validations('check minimum value for review-points', '#review-points', 'min', 0, 'verified minimum value validation for review-points');
        $I->fillField('#review-points', $reviews);
        $I->BuzzyDoc_validations('check required validation for rating-points', '#rating-points', 'required', 'true', 'verified validation for rating-points');
        $I->BuzzyDoc_validations('check minimum value for rating-points', '#rating-points', 'min', 0, 'verified minimum value validation for rating-points');
        $I->fillField('#rating-points', $ratings);
        $I->BuzzyDoc_validations('check required validation for fb-points', '#fb-points', 'required', 'true', 'verified validation for fb-points');
        $I->BuzzyDoc_validations('check minimum value for fb-points', '#fb-points', 'min', 0, 'verified minimum value validation for fb-points');
        $I->fillField('#fb-points', $facebook);
        $I->BuzzyDoc_validations('check required validation for gplus-points', '#gplus-points', 'required', 'true', 'verified validation for gplus-points');
        $I->BuzzyDoc_validations('check minimum value for gplus-points', '#gplus-points', 'min', 0, 'verified minimum value validation for gplus-points');
        $I->fillField('#gplus-points', $google_plus);
        $I->BuzzyDoc_validations('check required validation for yelp-points', '#yelp-points', 'required', 'true', 'verified validation for yelp-points');
        $I->BuzzyDoc_validations('check minimum value for yelp-points', '#yelp-points', 'min', 0, 'verified minimum value validation for yelp-points');
        $I->fillField('#yelp-points', $yelp);
        $I->BuzzyDoc_validations('check required validation for ratemd-points', '#ratemd-points', 'required', 'true', 'verified validation for ratemd-points');
        $I->BuzzyDoc_validations('check minimum value for ratemd-points', '#ratemd-points', 'min', 0, 'verified minimum value validation for ratemd-points');
        $I->fillField('#ratemd-points', $rate_md);
        $I->BuzzyDoc_validations('check required validation for healthgrades-points', '#healthgrades-points', 'required', 'true', 'verified validation for healthgrades-points');
        $I->BuzzyDoc_validations('check minimum value for healthgrades-points', '#healthgrades-points', 'min', 0, 'verified minimum value validation for healthgrades-points');
        $I->fillField('#healthgrades-points', $healthgrades);
        $I->click('Save');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-2']));
        $I->BuzzyDoc_validations('check required validation for referral-level-name', '#referral-level-name', 'required', 'true', 'verified validation for referral-level-name');
        $I->fillField('#referral-level-name', $referral_level_name);
        $I->BuzzyDoc_validations('check required validation for referrer-award-points', '#referrer-award-points', 'required', 'true', 'verified validation for referrer-award-points');
        $I->BuzzyDoc_validations('check minimum value for referrer-award-points', '#referrer-award-points', 'min', 0, 'verified minimum value validation for referrer-award-points');
        $I->fillField('#referrer-award-points', $referrer_award_points);
        $I->BuzzyDoc_validations('check required validation for referree-award-points', '#referree-award-points', 'required', 'true', 'verified validation for referree-award-points');
        $I->BuzzyDoc_validations('check minimum value for referree-award-points', '#referree-award-points', 'min', 0, 'verified minimum value validation for referree-award-points');
        $I->fillField('#referree-award-points', $referree_award_points);
        $I->checkOption(Locator::find('input', ['type' => 'checkbox']));
        $I->wait(5);
        $I->seeCheckboxIsChecked(Locator::find('input', ['type' => 'checkbox']));
        $I->wait(5);
        $I->click('#saveRef');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-3']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid1.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid1.']']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid2.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid2.']']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid3.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid3.']']));
        $I->wait(5);
        $I->click('#tempProm');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-6']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid1.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid1.']']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid2.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid2.']']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid3.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid3.']']));
        $I->wait(5);
        $I->click('#tempGift');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-4']));
        $I->wait(5);
        $I->BuzzyDoc_validations('check required validation for tier name', Locator::find('input', ['ng-model' => 'tier.name']), 'required', 'true', 'verified validation for tier name');
        $I->fillField(Locator::find('input', ['ng-model' => 'tier.name']), $tiername);
        $I->BuzzyDoc_validations('check required validation for lower value in tiers', '#lowerbound', 'required', 'true', 'verified validation for lowerbound value in tiers');
        $I->BuzzyDoc_validations('check minimum value for lowerbound value in tiers', '#lowerbound', 'min', 0, 'verified minimum value validation for lowerbound value in tiers');
        $I->fillField('#lowerbound', $lowerbound);
        $I->BuzzyDoc_validations('check required validation for upperbound value in tiers', '#upperbound', 'required', 'true', 'verified validation for upperbound value in tiers');
        $I->BuzzyDoc_validations('check minimum value for upperbound value in tiers', '#upperbound', 'min', 2, 'verified minimum value validation for upperbound value in tiers');
        $I->fillField('#upperbound', $upperbound);
        $I->BuzzyDoc_validations('check required validation for multiplier value in tiers', '#multiplier', 'required', 'true', 'verified validation for multiplier value in tiers');
        $I->BuzzyDoc_validations('check minimum value for multiplier value in tiers', '#multiplier', 'min', 0, 'verified minimum value validation for multiplier value in tiers');
        $I->fillField('#multiplier', $multiplier);
        $I->selectOption(Locator::find('select', ['ng-model' => 'tier.tier_gift_coupon.gift_coupon_id']), $giftcoupon);
        $I->wait(5);
        $I->click('#tempTier');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-5']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.milestone'.'['.$mileid.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.milestone'.'['.$mileid.']']));
        $I->wait(5);
        $I->click('#tempMile');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-7']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.survey'.'['.$surveyid.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.survey'.'['.$surveyid.']']));
        $I->wait(5);
        $I->click('#tempSurv');
        $I->waitForText('The template has been saved.', 5);
        $I->click('Templates');
        $I->wait(5);
        $I->click(Locator::find('a', ['href' => '/staging/templates']));
        $I->wait(5);

    }

    public function negative_case_for_edit_delete_templates($ratings, $google_plus, $referral_level_name, $referrer_award_points, $referree_award_points, $promoid1, $giftcouponid1, $giftcoupon, $mileid, $surveyid, $option )
    {
        //Edit

        $I = $this;
        $I->amGoingTo('Edit Template');
        $I->click('Templates');
        $I->wait(3);
        $I->click(Locator::find('a', ['href' => '/staging/templates']));
        $I->wait(3);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
        // $I->waitForElementVisible('Review Settings', 5);
        $I->makeScreenshot('Review Settings');
        $I->BuzzyDoc_validations('check required validation for rating-points', '#rating-points', 'required', 'true', 'verified validation for rating-points');
        $I->BuzzyDoc_validations('check minimum value for rating-points', '#rating-points', 'min', 0, 'verified minimum value validation for rating-points');
        $I->fillField('#rating-points', $ratings);
        $I->BuzzyDoc_validations('check required validation for gplus-points', '#gplus-points', 'required', 'true', 'verified validation for gplus-points');
        $I->BuzzyDoc_validations('check minimum value for gplus-points', '#gplus-points', 'min', 0, 'verified minimum value validation for gplus-points');
        $I->fillField('#gplus-points', $google_plus);
        $I->click('Save');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-2']));
        $I->BuzzyDoc_validations('check required validation for referral-level-name', '#referral-level-name', 'required', 'true', 'verified validation for referral-level-name');
        $I->fillField('#referral-level-name', $referral_level_name);
        $I->BuzzyDoc_validations('check required validation for referrer-award-points', '#referrer-award-points', 'required', 'true', 'verified validation for referrer-award-points');
        $I->BuzzyDoc_validations('check minimum value for referrer-award-points', '#referrer-award-points', 'min', 0, 'verified minimum value validation for referrer-award-points');
        $I->fillField('#referrer-award-points', $referrer_award_points);
        $I->BuzzyDoc_validations('check required validation for referree-award-points', '#referree-award-points', 'required', 'true', 'verified validation for referree-award-points');
        $I->BuzzyDoc_validations('check minimum value for referree-award-points', '#referree-award-points', 'min', 0, 'verified minimum value validation for referree-award-points');
        $I->fillField('#referree-award-points', $referree_award_points);
        $I->uncheckOption(Locator::find('input', ['type' => 'checkbox']));
        $I->wait(3);
        $I->click('#saveRef');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-3']));
        $I->wait(4);
        $I->uncheckOption(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid1.']']));
        $I->dontSeeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.promotions'.'['.$promoid1.']']));
        $I->wait(4);
        $I->click('#tempProm');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-6']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid1.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.gift_coupon'.'['.$giftcouponid1.']']));
        $I->wait(5);
        $I->click('#tempGift');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-4']));
        $I->wait(5);
        $I->selectOption(Locator::find('select', ['ng-model' => 'tier.tier_gift_coupon.gift_coupon_id']), $giftcoupon);
        $I->wait(5);
        $I->click('#tempTier');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-5']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.milestone'.'['.$mileid.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.milestone'.'['.$mileid.']']));
        $I->wait(5);
        $I->click('#tempMile');
        $I->waitForText('The template has been saved.', 5);
        $I->click(Locator::find('a', ['href' => '#tab-7']));
        $I->wait(5);
        $I->checkOption(Locator::find('input', ['ng-model' => 'template.survey'.'['.$surveyid.']']));
        $I->seeCheckboxIsChecked(Locator::find('input', ['ng-model' => 'template.survey'.'['.$surveyid.']']));
        $I->wait(5);
        $I->click('#tempSurv');
        $I->wait(4);
        $I->click('Templates');
        $I->wait(5);
        $I->click(Locator::find('a', ['href' => '/staging/templates']));
        $I->wait(4);

        //Delete

        $I->wait(3);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Vendor Promotions
        $I->wait(3); 
        $I->seeInPopup('Are you sure you want to delete');
        $I->wait(3);
        $I->cancelPopup();
        $I->wait(3); 

    }
    public function Search($searchInput,$option,$status_check,$pressEnter)
    {
      $I = $this;
      $I->maximizeWindow();
      $I->click('Dashboard');
      $I->waitForElementVisible('#search-patient-input',3);
      $I->makeScreenshot('user_page');
      $I->see('Search Patient');
      $I->seeInCurrentUrl('users/dashboard');
      $I->wait(1);
      $I->fillField('#search-patient-input',$searchInput);
      $I->wait(5);
      if($status_check=='0')
        {$I->checkOption($option);
        }
      if($pressEnter=='0')
        { $I->pressKey('#search-patient-input',WebDriverKeys::ENTER);}
        else
        {   
            $I->click('#search-patient-btn');
        }
        $I->wait(5);
      //    $heading = $I->grabTextFrom(Locator::find('div', ['class' => 'alert alert-success ng-binding']));
      //    codecept_debug($heading);
      //   if($heading=='0 results found')
      //   {$I->wait(4);}
      //   else{
      //     $I->wait(4);
      //     $I->click(Locator::elementAt('//table/tbody/tr', 1));
      //     $I->wait(4);
      // }
        
    }
    public function register_new_patient($name, $username, $guardian_email,$reason,$guardain_phone,$email, $phoneno, $see_good,$see, $no_email, $good_plan ){
       
        $I = $this;
        $I->click(Locator::find('a', ['href' => '/staging/users/dashboard'])); //dashboard
        $I->waitForElementVisible(Locator::find('a', ['class' => 'btn btn-primary']),5);
        $I->click(Locator::find('a', ['href' => '#!/addPatient']));
        $I->wait(2);
        $I->fillField(Locator::find('input', ['ng-model' => 'register.name']), $name);
        $I->wait(2);
        if($no_email=='1'){
           $I->checkOption(Locator::find('input', ['ng-model' => 'register.noEmail']));
           $I->wait(2);
           $I->fillField(Locator::find('input', ['ng-model' => 'register.username']), $username);
           $I->wait(3);
           $I->fillField(Locator::find('input', ['ng-model' => 'register.guardian_email']), $guardian_email);
           $I->wait(2);
           $I->selectOption(Locator::find('select', ['ng-model' => 'register.relationship_id']), 'Father');
           $I->wait(2);
           $I->fillField(Locator::find('input', ['ng-model' => 'register.reason']), $reason);
           $I->wait(2);
           $I->fillField(Locator::find('input', ['ng-model' => 'register.phone']), $guardain_phone);
           $I->wait(2);
           $I->click(Locator::find('button', ['class' => 'btn btn-success']));
       }else{
            $I->fillField(Locator::find('input', ['ng-model' => 'register.email']), $email);
            $I->wait(2);
            $I->fillField(Locator::find('input', ['ng-model' => 'register.phone']), $phoneno);
            $I->wait(2);
            $I->click(Locator::find('button', ['class' => 'btn btn-success']));
       }
      
        if($good_plan=='0')
          {
            $I->waitForElementVisible(Locator::find('button' ,['class' =>'btn btn-primary']));
            $I->see($see_good);
          }
        else{
        $I->waitForElementVisible(Locator::find('a' ,['href' =>'#!/patient']));
        $I->see($see);
      }   
        $I->wait(5);
    }

    public function instant_redemption($id, $good_plan)
    {
        $I = $this;
        $I->amGoingTo('do instant redemption');
        $I->click(Locator::find('button', ['ng-class' => "getClass('/redeem')"]));
        $I->wait(5);
        $I->click(Locator::find('a' ,['ng-click' =>'RdmCtrl.tabSwitch(1)']));
        $I->wait(5);
        if($good_plan == 0){
            $I->see('Instant Redeem');   
            $I->click(Locator::find('div', ['id' => "ir".$id]));
            $I->wait(4);
            $I->see('Redeemed Successfully');
            $I->wait(5);
            $I->click('OK');
            $I->wait(4);
        }else{
            $I->see('Instant Redeem');
            $I->see('Redeem'); 
            $I->wait(5);  
            $I->click(Locator::find('div', ['id' => "ir".$id]));
            $I->wait(4);
            $I->see('Redeemed Successfully');
            $I->wait(5);
            $I->click('OK');
            $I->wait(4);
            $I->click(Locator::find('div', ['id' => "rr".$id]));
            $I->wait(4);
            $I->see('Are you sure?');
            $I->wait(5);
            $I->click('Yes');
            $I->wait(5);
        }
    }
   
    public function instant_gift_credit($id1, $id2, $value1, $value2){
        $I = $this;
        $I->amGoingTo('do instant gift credit');
        $I->click(Locator::find('button', ['ng-class' => "getClass('/redeem')"]));
        $I->wait(5);
        $I->click(Locator::find('a' ,['ng-click' =>'RdmCtrl.tabSwitch(3)']));
        $I->wait(4);
        $I->click(Locator::find('button' ,['id' =>'gift'. $id1]));
        $I->wait(4);
        $I->see('Redeemed Successfully');
        $I->wait(5);
        $I->click('OK');
        $I->click(Locator::find('button' ,['id' =>'Amazon Rewards2']));
        $I->wait(4);
        $I->fillField(Locator::find('input' ,['type' =>'number']), $value1);
        $I->wait(4);
        if($value1!=''){
            $I->click('OK');
            $I->wait(5);
            $I->see('Redeemed Successfully');
            $I->wait(5);
            $I->click('OK');
        }
        else
        {
            $I->click('Cancel');
        }
        $I->wait(5);
        $I->click(Locator::find('button' ,['id' =>'gift'.$id2]));
        $I->wait(4);
        $I->see('Redeemed Successfully');
        $I->wait(5);
        $I->click('OK');
        $I->wait(5);
        $I->click(Locator::find('button' ,['id' =>'Tango Rewards2']));
        $I->fillField(Locator::find('input' ,['type' =>'number']), $value2);
        $I->wait(5);
        if($value2!=''){
            $I->click('OK');
            $I->wait(5);
            $I->see('Redeemed Successfully');
            $I->wait(5);
            $I->click('OK');
        }
        else
        {
            $I->click('Cancel');
        }
    }

    public function add_creditCardCharge($cardNum, $expiryDate, $cvv, $firstNameID, $lastNameID, $countryID, $zipID, $billingAddressID, $cityID, $stateID, $phonenumberID)
    {
        $I = $this;
        $I->amGoingTo('Add Credit Card');
        $I->wait(3);
        $I->click('Settings');
        $I->wait(4);
        $I->click('Credit Card Management');
        $I->wait(5);
        //$I->waitForElementVisible(Locator::find('a', ['href' => '/buzzyadmin/authorize-net-profiles']), 10);
        $I->click('Payment');
        $I->wait(5);
        //$I->waitForText("You have no payment card setup. Please click the button below to add the card.", 20);
        $I->see("You have no payment card setup. Please click the button below to add the card.");
        $I->waitForElementVisible(Locator::find('input', ['value' => 'Add New Payment Details']),8);
        $I->click("Add New Payment Details");
        $I->wait(5);
        $I->fillField('#cardNum', $cardNum);
        $I->fillField('#expiryDate', $expiryDate);
        $I->fillField('#cvv', $cvv);
        $I->fillField('#firstNameID', $firstNameID);
        $I->fillField('#lastNameID' , $lastNameID);
        //$I->fillField('#countryID', $countryID);
        $I->selectOption("select[id=countryID]", $countryID);
        $I->fillField('#zipID', $zipID);
        $I->fillField('#billingAddressID', $billingAddressID);
        $I->fillField('#cityID', $cityID);
        $I->fillField('#stateID', $stateID);
        $I->fillField('#phonenumberID', $phonenumberID);
        $I->click('#saveBtn');
        $I->wait(5);
        $I->click('#btnContinue');
        $I->wait(5);

    }

    public function edit_credictCardSetUp($cvv, $phonenumberID)
    {
       $I = $this;
        $I->amGoingTo('Edit Credit Card');
        $I->wait(3);
        $I->click('Settings');
        $I->wait(4);
        $I->click('Credit Card Management');
        $I->wait(5);
        //$I->waitForElementVisible(Locator::find('a', ['href' => '/buzzyadmin/authorize-net-profiles']), 10);
        $I->click('Payment');
        $I->wait(5);
        //$I->waitForText("You have no payment card setup. Please click the button below to add the card.", 20);
        $I->click(Locator::find('input', ['value' => 'Edit Payment Details']));
        $I->wait(5);
        //$I->fillField('#cvv', $cvv);
        $I->fillField('#phonenumberID', $phonenumberID);
        $I->wait(5);
        $I->click('#saveBtn');
        $I->wait(5);
        $I->see('Your information has been saved.');
        $I->click('#btnContinue');
        $I->wait(5);
    }
    
    public function vendor_deposit_balance($vendor_name)
    {
        $I = $this;
        $I->amGoingTo('Search Vendor Deposit Balance of respective vendor');
        $I->wait(3);
        $I->click('Reports');
        $I->wait(4);
        $I->click('Vendor Deposit Balance');
        $I->wait(5);
        $I->seeInCurrentUrl('/vendor-deposit-balances');
        $I->fillField(Locator::find('input', ['type' => 'search']), $vendor_name);
        $I->wait(5);
        $I->see($vendor_name);
        $I->wait(5);
    }

    public function credit_card_charge($vendor_name)
    {
        $I = $this;
        $I->amGoingTo('Search Credit Cards of respective vendor');
        $I->wait(3);
        $I->click('Reports');
        $I->wait(4);
        $I->click('Credit Card Charge');
        $I->wait(5);
        $I->seeInCurrentUrl('/credit-card-charges');
        $I->fillField(Locator::find('input', ['type' => 'search']), $vendor_name);
        $I->wait(5);
        $I->see($vendor_name);
        $I->wait(5);
    }

    public function vendor_survey_questions($admin,$option, $points, $id, $edit_points)
    {
        $I = $this;
        $I->amGoingTo('do vendor survey questions');
        $I->click('Settings');
        $I->wait(5);
        if($admin == 1)
        {
            $I->click('Vendor Settings');
            $I->wait(5);
            $I->click('Vendor Survey Questions');
            $I->wait(5);
        }else{
            $I->click('Vendor Survey Questions');
            $I->wait(5);
        }

         $I->selectOption("select[name = DataTables_Table_0_length]", $option);
         $I->wait(5);
         $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
         $I->BuzzyDoc_validations('check required validation for points', '#input-points', 'required', 'true', 'verified validation for points');
         $I->BuzzyDoc_validations('check minimum value validation for points', '#input-points', 'min', '1', 'verified validation for points');
         $I->fillField('#input-points', $points);
         $I->wait(5);
         $I->click('Submit');
         $I->wait(5);
         $I->seeInCurrentUrl('/vendor-survey-questions');
         $I->BuzzyDoc_validations('check required validation for points', Locator::find('input', ['id' => $id]), 'required', 'true', 'verified validation for points');
         $I->BuzzyDoc_validations('check minimum value validation for points', Locator::find('input', ['id' => $id]), 'min', '0', 'verified validation for points');
         $I->fillField(Locator::find('input', ['id' => $id]), $edit_points);
         $I->pressKey(Locator::find('input', ['id' => $id]),WebDriverKeys::ENTER);
         $I->wait(5);
         $I->seeInField(Locator::find('input', ['id' => $id]), $edit_points);
    }

    public function edit_selected_vendor_promotions($vendor, $option, $points)
    {
        $I = $this;
        $I->amGoingTo('see vendor promotions of respective vendor and edit it');
        $I->click('Settings');
        $I->wait(5);
        // if($admin == 1)
        // {
            $I->click('Vendor Settings');
            $I->wait(5);
            $I->click('Vendor Promotions');
            $I->wait(5);
        $I->seeInCurrentUrl('/vendor-promotions');
        $I->wait(5);
        $I->selectOption('#vendor-id', $vendor);
        $I->wait(5);
        $I->click('Submit');
        $I->wait(5);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(5);
        $I->checkOption("/descendant::input[@type='checkbox'][1]");
        $I->wait(4);
        $I->seeCheckboxIsChecked("/descendant::input[@type='checkbox'][1]");
        $I->wait(4);
        $I->click(Locator::elementAt(Locator::find('a', ['class' => 'btn btn-xs btn-warning edit']),1));
        $I->wait(4);
        $I->fillField("#points", $points);
        $I->wait(4);
        $I->click('Submit');
        $I->wait(5);
        $I->see('Vendor Promotions');
        $I->seeInCurrentUrl('/vendor-promotions');
        $I->wait(5);
        $I->selectOption('#vendor-id', $vendor);
        $I->wait(5);
        $I->click('Submit');
        $I->wait(5);
        $I->seeInCurrentUrl('/vendor-promotions');
        $I->see($points);
        $I->wait(2);
        $I->uncheckOption("/descendant::input[@type='checkbox'][1]");
        $I->wait(4);
        $I->dontSeeCheckboxIsChecked("/descendant::input[@type='checkbox'][1]");
        $I->wait(4);
   
    }

    public function survey_questions($survey_id, $question_id, $option)
    {
        $I = $this; 
        $I->amGoingTo('add survey questions');
        $I->wait(5);
        $I->click('Settings');
        $I->wait(5);
        $I->click('Survey Questions');
        $I->wait(5);
        $I->click('Add Survey Question');
        $I->wait(5);
        $I->selectOption(Locator::find('select', ['name' => 'survey_id']), $survey_id);
        $I->wait(5);
        $I->selectOption('#question-id', $question_id);
        $I->wait(5);
        $I->click('Submit');
        $I->wait(5);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
    
        //View Method
         $I->wait(4);
         $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
         $I->wait(5);
         $I->see($survey_id);
         $I->see($question_id);
         $I->wait(3);
         $I->click('Back');
       
    }

    public function edit_survey_questions($survey_id, $option)
    {
        $I = $this; 
        $I->amGoingTo('edit survey questions');
        $I->wait(5);
        $I->click('Settings');
        $I->wait(5);
        $I->click('Survey Questions');
        $I->wait(5);
        $I->click(Locator::find('a', ['href' => '/staging/survey-questions']));
        $I->wait(5);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(5);
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
        $I->selectOption(Locator::find('select', ['name' => 'survey_id']), $survey_id);
        $I->wait(5);
        $I->click('Submit');
        $I->wait(5);
    
        //Delete Method
        $I->wait(2);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(5);   
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Vendor Promotions
        $I->wait(3); 
        $I->seeInPopup('Are you sure you want to delete');
        $I->wait(3);
        $I->acceptPopup();
        $I->wait(3);
       
    }


    public function negative_case_for_add_view_survey_questions($survey_id, $question_id, $option)
    {
        $I = $this; 
        $I->amGoingTo('add survey questions');
        $I->wait(5);
        $I->click('Settings');
        $I->wait(5);
        $I->click('Survey Questions');
        $I->wait(5);
        $I->click('Add Survey Question');
        $I->wait(5);
        $I->BuzzyDoc_validations('check required validation for survey name', Locator::find('select', ['name' => 'survey_id']) , 'required', 'true', 'verified validation for survey name');
        $I->selectOption(Locator::find('select', ['name' => 'survey_id']), $survey_id);
        $I->wait(5);
        $I->BuzzyDoc_validations('check required validation for question name', '#question-id', 'required', 'true', 'verified validation for question');
        $I->selectOption('#question-id', $question_id);
        $I->wait(5);
        $I->click('Submit');
        $I->wait(5);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
    
        //View Method
         $I->wait(4);
         $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
         $I->wait(5);
         $I->see($survey_id);
         $I->see($question_id);
         $I->wait(3);
         $I->click('Back');
    }

    public function negative_case_for_edit_delete_survey_questions($survey_id, $option)
    {
        $I = $this; 
        $I->amGoingTo('edit survey questions');
        $I->wait(5);
        $I->click('Settings');
        $I->wait(5);
        $I->click('Survey Questions');
        $I->wait(5);
        $I->click(Locator::find('a', ['href' => '/staging/survey-questions']));
        $I->wait(5);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(5);
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
        $I->BuzzyDoc_validations('check required validation for survey name', Locator::find('select', ['name' => 'survey_id']) , 'required', 'true', 'verified validation for survey name');
        $I->selectOption(Locator::find('select', ['name' => 'survey_id']), $survey_id);
        $I->wait(5);
        $I->click('Submit');
        $I->wait(5);
    
        //Delete Method
        $I->wait(2);
        $I->selectOption("select[name = DataTables_Table_0_length]", $option);
        $I->wait(5);   
        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Vendor Promotions
        $I->wait(3); 
        $I->seeInPopup('Are you sure you want to delete');
        $I->wait(3);
        $I->cancelPopup();
        $I->wait(3);
       
    }

}
        
