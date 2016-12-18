<?php

namespace App\Models;

/**
 * @Entity
 * @Table(name="user")
 */
class UserModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="user_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** @first_name @Column(type="string") */
	public $Firstname;

	/** @last_name @Column(type="string") */
	public $LastName;

	/** @user_name @Column(type="string") */
	public $UserName;

	/** @password @Column(type="string") */
	public $Password;

	/** @email @Column(type="string") */
	public $Email;

	/** 
	 * @OneToOne(targetEntity="RoleModel", cascade={"persist"})
	 * @JoinColumn(name="role_id", referencedColumnName="id")
	*/
	public $Role;

	/** @enabled @Column(type="boolean") */
	public $Enabled;

	/** @created @Column(type="date") */
	public $Created;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;
}