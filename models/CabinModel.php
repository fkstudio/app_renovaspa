<?php

namespace Models;

/**
 * @Entity
 * @Table(name="cabin")
 */
class CabinModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="brand_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** @name @Column(type="string") */
	public $Name;

	/** @created @Column(type="date") */
	public $Created;

	/** @modified @Column(type="date") */
	public $Modified;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;
}