<?php

namespace App\Lib;
use App\Database\DbContext;

// sign in user
class SignInManager {

	private $dbcontext;
    private $entityManager;

    /* ============================= PUBLIC METHODS ============================= */
    /* public class construct */
    public function __construct(){
        $this->dbcontext = new DbContext();
        $this->entityManager = $this->dbcontext->getEntityManager();
    }

	/**
	 * @return true if the user is successfully logged, false if not
	 * @param username (string) and password (string)
	*/
	public function signInUserByGenericInfo(string $username, string $password){
		$user = $this->entityManager->getRepository("App\Models\UserModel")
												->findOneBy(['username' => $username]);

		if($user == null)
			throw new \Exception("User not found");

		if (!\Hash::check($username, $user->Password)){
			echo false;
			exit();
			throw new \Exception("Incorrect password");
		}
		
		\Session::put('loggedUser', $user);

		return true;
	}

	public function signOutUser(){
		Session::forget('loggedUser');
	}
}