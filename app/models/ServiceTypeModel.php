<?php

namespace App\Models;

/**
 * @Entity
 * @Table(name="service_type")
 */
class ServiceTypeModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="service_type_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** @name @Column(type="string") */
	public $Name;

	/** @min_cant @Column(type="integer") */
	public $MinCant;

	/** @max_cant @Column(type="integer") */
	public $MaxCant;	

	/** @enabled @Column(type="boolean") */
	public $Enabled;

	/** @created @Column(type="date") */
	public $Created;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;
}