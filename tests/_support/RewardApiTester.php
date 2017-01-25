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
class RewardApiTester extends \Codeception\Actor
{
    use _generated\RewardApiTesterActions;

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

		}

		public function Validations($desc,$input, $attribute,$expected,$message)
	    {
			$I = $this;
			$I->amGoingTo($desc);
			$temp= $I->grabAttributeFrom($input, $attribute);
			$I->assertEquals($expected, $temp, $message);
		}

		public function positive_case_for_add_view_reseller($org_name, $plan, $lastname, $firstname, $email, $username, $password, $phone)
		{
			//Add reseler

			$I = $this;
			$I->amGoingTo('add Reseller');
			$I->wait(5);
			$I->click('Resellers');
			$I->wait(5);
			$I->click('Add Reseller');
			$I->wait(5);
			$I->seeInCurrentUrl('resellers/add');
			$I->wait(5);
			$I->fillField('#org-name', $org_name);
			// $I->selectOption("select[name = reseller_plans[plan_id]]", $plan);
			$I->selectOption(Locator::find('select', ['class' => 'form-control']), $plan);
			$I->attachFile('input[type="file"]', 'profile.jpeg');
			$I->click('#status');
			$I->fillField('#user-last-name', $lastname);
			$I->fillField('#user-first-name', $firstname);
			$I->fillField('#user-email', $email);
			$I->fillField('#user-username', $username);
			$I->fillField('#user-password', $password);
			$I->fillField('#user-phone', $phone);
			$I->click('#check_submit');
			$I->wait(5);

			//View method

			$I->amGoingTo('view reseller');
			$I->wait(4);
			$I->click('Resellers');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/resellers']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($org_name);
	        $I->wait(3);
	        $I->click('Back');

		}

		public function positive_case_for_edit_delete_reseller($org_name)
		{
			//Edit reseler

			$I = $this;
			$I->amGoingTo('edit reseller');
			$I->wait(4);
			$I->click('Resellers');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/resellers']));
			$I->wait(5);
			$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
			$I->wait(5);
			$I->fillField('#org-name', $org_name);
			$I->attachFile('input[type="file"]', 'profile.jpeg');
			$I->click('#check_submit');
			$I->wait(5);

			// Delete reseller

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Reseller
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->acceptPopup();
	        $I->wait(3);

		}

		public function negative_case_for_add_view_reseller($org_name, $plan, $lastname, $firstname, $email, $username, $password, $phone)
		{
			//Add reseler

			$I = $this;
			$I->amGoingTo('add Reseller');
			$I->wait(5);
			$I->click('Resellers');
			$I->wait(5);
			$I->click('Add Reseller');
			$I->wait(5);
			$I->seeInCurrentUrl('resellers/add');
			$I->wait(5);
			$I->Validations('check required validation for organization name', '#org-name', 'required', 'true', 'verified validation for organization name');
			$I->Validations('check type validation for organization name', '#org-name', 'type', 'text', 'verified validation for organization name');
			$I->Validations('check maximum length validation for organization name', '#org-name', 'maxlength', "255", 'verified validation for organization name');
			$I->fillField('#org-name', $org_name);
			$I->selectOption(Locator::find('select', ['class' => 'form-control']), $plan);
			$I->attachFile('input[type="file"]', 'profile.jpeg');
			$I->click('#status');
			$I->Validations('check required validation for last name', '#user-last-name', 'required', 'true', 'verified validation for last name');
			$I->Validations('check type validation for last name', '#user-last-name', 'type', 'text', 'verified validation for last name');
			$I->fillField('#user-last-name', $lastname);
			$I->Validations('check required validation for firstname', '#user-first-name', 'required', 'true', 'verified validation for firstname');
			$I->Validations('check type validation for firstname', '#user-first-name', 'type', 'text', 'verified validation for firstname');
			$I->fillField('#user-first-name', $firstname);
			$I->Validations('check required validation for email', '#user-email', 'required', 'true', 'verified validation for email');
			$I->Validations('check type validation for email', '#user-email', 'type', 'email', 'verified validation for email');
			$I->fillField('#user-email', $email);
			$I->Validations('check required validation for username', '#user-username', 'required', 'true', 'verified validation for username');
			$I->Validations('check type validation for username', '#user-username', 'type', 'text', 'verified validation for username');
			$I->fillField('#user-username', $username);
			$I->Validations('check required validation for password', '#user-password', 'required', 'true', 'verified validation for password');
			$I->Validations('check type validation for password', '#user-password', 'type', 'password', 'verified validation for password');
			$I->Validations('check minimum length validation for password', '#user-password', 'data-minlength', '8', 'verified validation for password');
			$I->fillField('#user-password', $password);
			$I->Validations('check required validation for phone', '#user-phone', 'required', 'true', 'verified validation for phone');
			$I->Validations('check type validation for phone', '#user-phone', 'type', 'tel', 'verified validation for phone');
			$I->fillField('#user-phone', $phone);
			$I->click('#check_submit');
			$I->wait(5);

			//View method

			$I->amGoingTo('view reseller');
			$I->wait(4);
			$I->click('Resellers');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/resellers']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($org_name);
	        $I->wait(3);
	        $I->click('Back');

		}

		public function negative_case_for_edit_delete_reseller($org_name)
		{
			//Edit reseler

			$I = $this;
			$I->amGoingTo('edit reseller');
			$I->wait(4);
			$I->click('Resellers');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/resellers']));
			$I->wait(5);
			$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
			$I->wait(5);
			$I->Validations('check required validation for organization name', '#org-name', 'required', 'true', 'verified validation for organization name');
			$I->Validations('check type validation for organization name', '#org-name', 'type', 'text', 'verified validation for organization name');
			$I->Validations('check maximum length validation for organization name', '#org-name', 'maxlength', "255", 'verified validation for organization name');
			$I->fillField('#org-name', $org_name);
			$I->attachFile('input[type="file"]', 'profile.jpeg');
			$I->click('#check_submit');
			$I->wait(5);

			// Delete reseller

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Reseller
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->cancelPopup();
	        $I->wait(3);

		}

		public function positive_case_for_add_view_user($role, $firstname, $lastname, $username, $email, $phone, $password)
		{
			$I = $this;
			$I->amGoingTo('add staff user');
			$I->click('Staff');
			$I->wait(5);
			$I->click('Add Staff');
			$I->wait(5);
			$I->seeInCurrentUrl('/staffs/add');
			$I->selectOption(Locator::find('select', ['id' => 'role-id']), $role);
			$I->fillField('#first-name', $firstname);
			$I->fillField('#last-name', $lastname);
			$I->fillField('#username', $username);
			$I->fillField('#email', $email);
			$I->fillField('#phone', $phone);
			$I->fillField('#password', $password);
			$I->click('#status');
			$I->click('#check_submit');
			$I->wait(5);

			//View method

			$I->amGoingTo('view staff user');
			$I->wait(4);
			$I->click('Staff');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/staffs']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($firstname);
	        $I->see($lastname);
	        $I->see($username);
	        $I->see($phone);
	        $I->wait(3);
	        $I->click('Back');
		}

		public function positive_case_for_edit_delete_user($oldpwd, $newpwd, $confirmpwd)
		{
			$I = $this;
			$I->amGoingTo('edit staff user');
			$I->click('Staff');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' => '/rewardApis/staffs']));
			$I->wait(5);
			$I->click(Locator::elementAt(Locator::find('a', ['class' => 'btn btn-xs btn-warning']), 2));
			// $I->click(Locator::elementAt(Locator::find('a', ['class' => 'btn btn-xs btn-warning edit']),1));
			$I->wait(5);
			$I->click('#changePasswordButton');
			$I->wait(5);
			if($oldpwd!='' || $newpwd!='' || $confirmpwd!=''){
				$I->fillField('#old_pwd', $oldpwd);
				$I->fillField('#new_pwd', $newpwd);
				$I->fillField('#cnf_new_pwd', $confirmpwd);
				$I->wait(5);
				$I->click('#saveUserPassword');
			}else{
				$I->click(Locator::find('button', ['type' => 'button']));
			}
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			// Delete method

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in User
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->acceptPopup();
	        $I->wait(3);
		}

		public function negative_case_for_add_view_user($role, $firstname, $lastname, $username, $email, $phone, $password)
		{
			$I = $this;
			$I->amGoingTo('add user');
			$I->click('Staff');
			$I->wait(5);
			$I->click('Add Staff');
			$I->wait(5);
			$I->seeInCurrentUrl('/users/add');
			$I->selectOption(Locator::find('select', ['id' => 'role-id']), $role);
			$I->Validations('check required validation for firstname ', '#first-name', 'required', 'true', 'verified validation for firstname');
			$I->Validations('check maximum length validation for firstname ', '#first-name', 'maxlength', '255', 'verified validation for firstname');
			$I->fillField('#first-name', $firstname);
			$I->Validations('check required validation for lastname ', '#last-name', 'required', 'true', 'verified validation for lastname');
			$I->Validations('check maximum length validation for lastname ', '#last-name', 'maxlength', '255', 'verified validation for lastname');
			$I->fillField('#last-name', $lastname);
			$I->Validations('check required validation for username ', '#username', 'required', 'true', 'verified validation for lastname');
			$I->Validations('check maximum length validation for username ', '#username', 'maxlength', '255', 'verified validation for lastname');
			$I->fillField('#username', $username);
			$I->Validations('check required validation for email', '#email', 'required', 'true', 'verified validation for email');
			$I->Validations('check type validation for email', '#email', 'type', 'email', 'verified validation for email');
			$I->fillField('#email', $email);
			$I->Validations('check required validation for phone', '#phone', 'required', 'true', 'verified validation for phone');
			$I->Validations('check type validation for phone', '#phone', 'type', 'tel', 'verified validation for phone');
			$I->fillField('#phone', $phone);
			$I->Validations('check required validation for password', '#password', 'required', 'true', 'verified validation for password');
			$I->Validations('check type validation for password', '#password', 'type', 'password', 'verified validation for password');
			$I->fillField('#password', $password);
			$I->click('#status');
			$I->click('#check_submit');
			$I->wait(5);

			//View method

			$I->amGoingTo('view user');
			$I->wait(4);
			$I->click('Staff');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/staffs']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($firstname);
	        $I->see($lastname);
	        $I->see($username);
	        $I->see($phone);
	        $I->wait(3);
	        $I->click('Back');
		}

		public function negative_case_for_edit_delete_user($oldpwd, $newpwd, $confirmpwd)
		{
			$I = $this;
			$I->amGoingTo('edit user');
			$I->click('Satffs');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' => '/rewardApis/staffs']));
			$I->wait(5);
			$I->click(Locator::elementAt(Locator::find('a', ['class' => 'btn btn-xs btn-warning']), 2));
			// $I->click(Locator::elementAt(Locator::find('a', ['class' => 'btn btn-xs btn-warning edit']),1));
			$I->wait(5);
			$I->click('#changePasswordButton');
			$I->wait(5);
			if($oldpwd!='' || $newpwd!='' || $confirmpwd!=''){
				$I->Validations('check required validation for old password', '#old_pwd', 'required', 'true', 'verified validation for old password');
				$I->Validations('check type validation for old password', '#old_pwd', 'type', 'password', 'verified validation for old password');
				$I->Validations('check minimum length validation for password', '#old_pwd', 'data-minlength', '8', 'verified validation for old password');
				$I->fillField('#old_pwd', $oldpwd);
				$I->Validations('check required validation for new password', '#new_pwd', 'required', 'true', 'verified validation for new password');
				$I->Validations('check type validation for new password', '#new_pwd', 'type', 'password', 'verified validation for new password');
				$I->Validations('check minimum length validation for  new password', '#new_pwd', 'data-minlength', '8', 'verified validation for new password');
				$I->fillField('#new_pwd', $newpwd);
				$I->Validations('check required validation for confirm password', '#cnf_new_pwd', 'required', 'true', 'verified validation for confirm password');
				$I->Validations('check type validation for confirm password', '#cnf_new_pwd', 'type', 'password', 'verified validation for confirm password');
				$I->Validations('check minimum length validation for  confirm password', '#cnf_new_pwd', 'data-minlength', '8', 'verified validation for confirm password');
				$I->fillField('#cnf_new_pwd', $confirmpwd);
				$I->wait(5);
				$I->click('#saveUserPassword');
			}else{
				$I->click(Locator::find('button', ['type' => 'button']));
			}
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			// Delete method

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in User
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->cancelPopup();
	        $I->wait(3);
		}

		public function positive_case_for_add_view_plan($plan_name, $pricing)
		{
			//Add method for plan

			$I = $this;
			$I->amGoingTo('add new plan');
			$I->click('Plans');
			$I->wait(5);
			$I->click('Add Plan');
			$I->wait(5);
			$I->fillField('#name', $plan_name);
			$I->attachFile('input[type="file"]', 'profile.jpeg');
			$I->fillField('#pricing', $pricing);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			//View method

			$I->amGoingTo('view plan');
			$I->wait(4);
			$I->click('Plans');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/plans']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($plan_name);
	        $I->see($pricing);
	        $I->wait(3);
	        $I->click('Back');

		}

		public function positive_case_for_edit_delete_plan($pricing)
		{
			//Edit method

			$I = $this;
			$I->amGoingTo('edit plan');
			$I->click('Plans');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' => '/rewardApis/plans']));
			$I->wait(5);
			$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
			$I->wait(5);
			$I->attachFile('input[type="file"]', 'profile.jpeg');
			$I->fillField('#pricing', $pricing);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			// Delete method

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Plan
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->acceptPopup();
	        $I->wait(3);

		}

		public function negative_case_for_add_view_plan($plan_name, $pricing)
		{
			//Add method for plan

			$I = $this;
			$I->amGoingTo('add new plan');
			$I->click('Plans');
			$I->wait(5);
			$I->click('Add Plan');
			$I->wait(5);
			$I->Validations('check required validation for plan name ', '#name', 'required', 'true', 'verified validation for plan name');
			$I->Validations('check maximum length validation for plan name ', '#name', 'maxlength', '255', 'verified validation for plan name');
			$I->fillField('#name', $plan_name);
			$I->attachFile('input[type="file"]', 'profile.jpeg');
			$I->Validations('check required validation for pricing ', '#pricing', 'required', 'true', 'verified validation for pricing');
			$I->Validations('check type validation for pricing ', '#pricing', 'type', 'number', 'verified validation for princing');
			$I->fillField('#pricing', $pricing);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			//View method

			$I->amGoingTo('view plan');
			$I->wait(4);
			$I->click('Plans');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/plans']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($plan_name);
	        $I->see($pricing);
	        $I->wait(3);
	        $I->click('Back');

		}

		public function negative_case_for_edit_delete_plan($pricing)
		{
			//Edit method

			$I = $this;
			$I->amGoingTo('edit plan');
			$I->click('Plans');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' => '/rewardApis/plans']));
			$I->wait(5);
			$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
			$I->wait(5);
			$I->attachFile('input[type="file"]', 'profile.jpeg');
			$I->Validations('check required validation for pricing ', '#pricing', 'required', 'true', 'verified validation for pricing');
			$I->Validations('check type validation for pricing ', '#pricing', 'type', 'number', 'verified validation for princing');
			$I->fillField('#pricing', $pricing);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			// Delete method

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Plan
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->cancelPopup();
	        $I->wait(3);

		}


		public function positive_case_for_add_view_feature($feature)
		{
			//Add method

			$I = $this;
			$I->amGoingTo('add feature');
			$I->click('Features');
			$I->wait(5);
			$I->click('Add Feature');
			$I->wait(5);
			$I->fillField('#name', $feature);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			//View method

			$I->amGoingTo('view feature');
			$I->wait(4);
			$I->click('Features');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/features']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($feature);
	        $I->wait(3);
	        $I->click('Back');	

		}

		public function positive_case_for_edit_delete_feature($feature)
		{
			//Edit method

			$I = $this;
			$I->amGoingTo('edit feature');
			$I->click('Features');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' => '/rewardApis/features']));
			$I->wait(5);
			$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
			$I->wait(5);
			$I->fillField('#name', $feature);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			// Delete method

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Feature
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->acceptPopup();
	        $I->wait(3);

		}

		public function negative_case_for_add_view_feature($feature)
		{
			//Add method

			$I = $this;
			$I->amGoingTo('add feature');
			$I->click('Features');
			$I->wait(5);
			$I->click('Add Feature');
			$I->wait(5);
			$I->Validations('check required validation for feature name ', '#name', 'required', 'true', 'verified validation for feature name');
			$I->Validations('check maximum length validation for feature name ', '#name', 'maxlength', '255', 'verified validation for feature name');
			$I->fillField('#name', $feature);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			//View method

			$I->amGoingTo('view feature');
			$I->wait(4);
			$I->click('Features');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/features']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($feature);
	        $I->wait(3);
	        $I->click('Back');	

		}

		public function negative_case_for_edit_delete_feature($feature)
		{
			//Edit method

			$I = $this;
			$I->amGoingTo('edit feature');
			$I->click('Features');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' => '/rewardApis/features']));
			$I->wait(5);
			$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
			$I->wait(5);
			$I->Validations('check required validation for feature name ', '#name', 'required', 'true', 'verified validation for feature name');
			$I->Validations('check maximum length validation for feature name ', '#name', 'maxlength', '255', 'verified validation for feature name');
			$I->fillField('#name', $feature);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			// Delete method

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Feature
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->acceptPopup();
	        $I->wait(3);

		}


		public function positive_case_for_add_view_role($name, $label)
		{
			$I = $this;
			$I->amGoingTo('add role');
			$I->click('Roles');
			$I->wait(5);
			$I->click('Add Role');
			$I->wait(5);
			$I->fillField('#name', $name);
			$I->fillField('#label', $label);
			$I->click('#status');
			$I->wait(5);
			$I->click('#check_submit');

			//View method

			$I->amGoingTo('view role');
			$I->wait(4);
			$I->click('Roles');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/roles']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($name);
	        $I->see($label);
	        $I->wait(3);
	        $I->click('Back');
		}

		public function positive_case_for_edit_delete_role($name)
		{
			//Edit method

			$I = $this;
			$I->amGoingTo('edit role');
			$I->click('Roles');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' => '/rewardApis/roles']));
			$I->wait(5);
			$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
			$I->wait(5);
			$I->fillField('#name', $name);
			$I->wait(5);
			$I->click('#check_submit');
			$I->wait(5);

			// Delete method

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Feature
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->acceptPopup();
	        $I->wait(3);

		}

		public function positive_case_for_add_view_reseller_program($progname)
		{
			$I = $this;
			$I->amGoingTo('add new program');
			$I->click('Programs');
			$I->wait(5);
			$I->click('Add Program');
			$I->wait(5);
			$I->fillField('#program-name', $progname);
			$I->checkOption(Locator::find('input', ['value' => 'promotions']));
			$I->checkOption(Locator::find('input', ['value' => 'tiers']));
			$I->checkOption(Locator::find('input', ['value' => 'addpatient']));
			$I->wait(5);
			$I->click('#check_submit');

			//View method

			$I->amGoingTo('view reseller program');
			$I->wait(4);
			$I->click('Programs');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/reseller-programs']));
			$I->wait(5);
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-success'])));
	        $I->wait(5);
	        $I->see($progname);
	        $I->wait(3);
	        $I->click('Back');
		}
		//There is some issue
		public function positive_case_for_edit_delete_reseller_program($progname)
		{
			$I = $this;
			$I->amGoingTo('edit reseller program');
			$I->wait(4);
			$I->click('Programs');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/reseller-programs']));
			$I->wait(5);
			$I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-xs btn-warning'])));
			$I->wait(5);
			$I->fillField('#program-name', $progname);
			$I->checkOption(Locator::find('input', ['value' => 'manualpoints']));
			$I->wait(5);
			$I->click('#check_submit');

			// Delete method

	        $I->wait(2);  
	        $I->click(Locator::lastElement(Locator::find('a', ['class' => 'btn btn-sm btn-danger fa fa-trash-o fa-fh'])));//click on Delete button in Feature
	        $I->wait(3); 
	        $I->seeInPopup('Are you sure you want to delete');
	        $I->wait(3);
	        $I->cancelPopup();
	        $I->wait(3);
		}

		public function positive_case_for_clone_reseller_program($program_name)
		{
			$I = $this;
			$I->amGoingTo('edit reseller program');
			$I->wait(4);
			$I->click('Programs');
			$I->wait(5);
			$I->click(Locator::find('a', ['href' =>'/rewardApis/reseller-programs']));
			$I->wait(5);
			$I->click('#clone');
			$I->wait(5);
			$I->fillField('#program_name', $program_name);
			$I->wait(4);
			$I->click('#submitCloneRequest');
		}
}
