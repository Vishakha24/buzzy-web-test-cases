<?php


class rewardApiCest
{
    public function _before(RewardApiTester $I)
    {
    }

    public function _after(RewardApiTester $I)
    {
    }

    // tests
    public function tryToTest(RewardApiTester $I)
    {
    }

    // public function positive_case_for_reseller(RewardApiTester $I)
    // {
    //     $I->login('admin','12345678');
    //     $I->positive_case_for_add_view_reseller('test12', 'Better', 'zxcvb', 'zxcvb', 'zxc@example.com','zxcvb', '12345678', '1234567890');
    //     $I->positive_case_for_edit_delete_reseller('TestOrg');
    // }

    public function negative_case_for_reseller(RewardApiTester $I)
    {
        $I->login('admin','12345678');
        $I->negative_case_for_add_view_reseller('orgtest', 'Better', 'user', 'user', 'user@example.com','user', '12345678', '1234567890');
        $I->negative_case_for_edit_delete_reseller('testorg');
    }
    // public function positive_case_for_user(RewardApiTester $I)
    // {
    //     $I->login('qwerty', '12345678');
    //     $I->positive_case_for_add_view_user('staff_admin', 'mnbv', 'mnbv', 'mnbv', 'mnbv@gmail.co', '1234567890', '12345678');
    //     $I->positive_case_for_edit_delete_user('12345678', '123456789', '123456789');
    // }

    public function negative_case_for_user(RewardApiTester $I)
    {
        $I->login('user', '12345678');
        $I->negative_case_for_add_view_user('staff_admin', 'testuser', 'testuser', 'testuser', 'testuser@gmail.co', '1234567890', '12345678');
        $I->logout();
        $I->login('testuser', '12345678');
        $I->negative_case_for_edit_delete_user('12345678', '123456789', '123456789');
    }

    // public function positive_case_for_plans(RewardApiTester $I)
    // {
    //     $I->login('admin', '12345678');
    //     $I->positive_case_for_add_view_plan('testplan', 500);
    //     $I->positive_case_for_edit_delete_plan(2000);
    // }

     public function negative_case_for_plans(RewardApiTester $I)
    {
        $I->login('admin', '12345678');
        $I->negative_case_for_add_view_plan('testplan', 500);
        $I->positive_case_for_edit_delete_plan(2000);
    }

    //  public function positive_case_for_features(RewardApiTester $I)
    // {
    //     $I->login('admin', '12345678');
    //     $I->positive_case_for_add_view_feature('test');
    //     $I->positive_case_for_edit_delete_feature('testfeature');
    // }

     public function negative_case_for_features(RewardApiTester $I)
    {
        $I->login('admin', '12345678');
        $I->negative_case_for_add_view_feature('test');
        $I->negative_case_for_edit_delete_feature('testfeature');
    }

    public function positive_case_for_roles(RewardApiTester $I)
    {
        $I->login('admin', '12345678');
        $I->positive_case_for_add_view_role('testrole', 'testlabel');
        $I->positive_case_for_edit_delete_role('role1');
    }

    //  public function negative_case_for_roles(RewardApiTester $I)
    // {
    //     $I->login('admin', '12345678');
    //     $I->negative_case_for_add_view_role('testrole', 'testlabel');
    //     $I->megative_case_for_edit_delete_role('role1');
    // }

    public function positive_case_for_reseller_program(RewardApiTester $I)
    {
           $I->login('testuser', '123456789');
           $I->positive_case_for_add_view_reseller_program('programtesting');
           $I->positive_case_for_edit_delete_reseller_program('progtest');
           $I->positive_case_for_clone_reseller_program('protest');
    }


}
