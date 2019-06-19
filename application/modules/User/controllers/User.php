<?php

class UserController extends Yaf\Controller_Abstract {

	public function showAction() {
      // $params = $this->getRequest()->getParams();
	    $user = UserModel::find(1);

		$user = UserModel::all();
		// var_dump($user->toArray());die;
		dd($user->toArray());
		print_r($user->toJson(1));
		// return False;
      	echo 'this is user show...';
      	return false;
  }


}
