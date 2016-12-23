<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="status")
 */
class StatusModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="status_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** @name @Column(type="string") */
	public $Name;

}