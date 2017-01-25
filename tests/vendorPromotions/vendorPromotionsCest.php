<?php
use \Codeception\Util\Locator;

class vendorPromotionsCest
{
    public function _before(VendorPromotionsTester $I)
    {
    }

    public function _after(VendorPromotionsTester $I)
    {
    }

    // tests
    public function tryToTest(VendorPromotionsTester $I)
    {
    }

    // public function positive_case_for_promotions(VendorPromotionsTester $I)
    // {
    //     $I->login('damon', '12345678');
    //     $I->positive_case_for_add_view_promotions('promotion8', 'description8', 56, 8, 50);
    //     $I->positive_case_for_edit_delete_promotions(45, 50);
    //     $I->positive_vendor_promotions_checkboxChecked_edit(28);
        
    // }

    // public function negative_case_for_promotions(VendorPromotionsTester $I)
    // {
    //    $I->login('damon', '12345678');
    //    $I->negative_case_for_add_view_promotions('Promotion 1', 'PromoDesc 1', 30, 7, 50);
    //    $I->click('Settings');
    //    $I->negative_case_for_edit_delete_vendor_promotions(45, 50);
    //    $I->positive_vendor_promotions_checkboxChecked_edit(28); 
    // }

    // public function positive_case_for_templates(VendorPromotionsTester $I)
    // {
    //     $I->login('admin', '123456789');
    //     $I->positive_case_for_add_template('temptest5', 'Best', 'Optometry', 110, 110, 110, 110, 110, 110, 110, 'xyz', 110, 110,1, 4, 10, 'testTier', 0, 500, 1, '$50 Gift Certificate', 1, 2, 3, 4, 2);
    //     $I->positive_case_for_edit_delete_templates(100, 120, 'qwerty', 120, 120, 1, 1, '$25 Gift Certificate', 7, 1, 50);
    // }

    // public function negative_case_for_templates(VendorPromotionsTester $I){

    //     $I->login('admin', '123456789');
    //     $I->negative_case_for_add_template('template testing', 'Best', 'Optometry', 110, 110, 110, 110, 110, 110, 110, 'xyz', 110, 110,1, 4, 10, 'testTier', 0, 500, 1, '$50 Gift Certificate', 1, 2, 3, 4, 2);
    //     $I->negative_case_for_edit_delete_templates(100, 120, 'qwerty', 120, 120, 1, 1, '$25 Gift Certificate', 7, 1, 50);
    // }

    // public function instant_redemption(VendorPromotionsTester $I, VendorPromotionsTester $heading)
    // {
    //     $I->login('damon', '12345678');
    //     $I->Search('vish','vish','1','0');
    //     $heading = $I->grabTextFrom(Locator::find('div', ['class' => 'alert alert-success ng-binding']));
    //     if($heading=='0 results found')
    //     {
    //         $I->wait(4);
    //         $I->register_new_patient('vish', 'vish', 'vishakha.chaudhary@twinspark.co','','','', '9978653200', 'Instant Redemption','Award Points', '0', '1');
    //     }
    //     else{
    //       $I->wait(4);
    //       $I->click(Locator::elementAt('//table/tbody/tr', 1));
    //       $I->wait(4);
    //   }
    //     $I->instant_redemption(1, 1);
    // }

    //  public function instant_gift_credit(VendorPromotionsTester $I, VendorPromotionsTester $heading)
    // {
    //     $I->login('damon', '12345678');
    //     $I->Search('vish','vish','1','0');
    //     $heading = $I->grabTextFrom(Locator::find('div', ['class' => 'alert alert-success ng-binding']));
    //     if($heading=='0 results found')
    //     {
    //         $I->wait(4);
    //         $I->register_new_patient('vish', 'vish', 'vishakha.chaudhary@twinspark.co','','','', '9978653200', 'Instant Redemption','Award Points', '0', '1');
    //     }
    //     else{
    //       $I->wait(4);
    //       $I->click(Locator::elementAt('//table/tbody/tr', 1));
    //       $I->wait(4);
    //   }
    //     $I->instant_gift_credit(191, 192, '200', '');
    // }

    // public function creditCardCharge(VendorPromotionsTester $I)
    // {
    //     $I->login('damon', '12345678');
    //     $I->add_creditCardCharge('4444 2222 1111 3333', '0719', '789', 'Damon', 'Damon', 'United States of America', '201010', 'b-4, DamonVilla', 'blabla', 'asdfgh', '9876543212');
    //     $I->edit_credictCardSetUp('765', '9876543356');
    // }

    public function vendor_deposit_balance(VendorPromotionsTester $I)
    {
        $I->login('admin', '123456789');
        $I->vendor_deposit_balance('Charizad');
    }

    public function credit_card_charge(VendorPromotionsTester $I)
    {
        $I->login('admin', '123456789');
        $I->credit_card_charge('explorer');

    }

    public function vendor_survey_questions(VendorPromotionsTester $I)
    {
        $I->login('admin', '123456789');
        $I->vendor_survey_questions(1, 100, 45, 37, 20);
    }

    public function edit_selected_vendor_promotions(VendorPromotionsTester $I)
    {
        $I->login('admin', '123456789');
        $I->edit_selected_vendor_promotions('Venasaur', 100, 40);
    }

    public function positive_case_for_survey_questions(VendorPromotionsTester $I)
    {
        $I->login('admin', '123456789');
        $I->survey_questions('Survey  One', 'Test question edited', 50);
        $I->edit_survey_questions('Add Survey', 100);

    }

    public function negative_case_for_survey_questions(VendorPromotionsTester $I)
    {
        $I->login('admin', '123456789');
        $I->negative_case_for_add_view_survey_questions('Survey  One', 'Test question edited', 50);
        $I->negative_case_for_edit_delete_survey_questions('Add Survey', 100);

    }
}
