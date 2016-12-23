<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="category")
 */
class CategoryModel {

	/** ============= PRIVATE PROPERTIES ============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="service_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** ============= PUBLIC PROPERTIES =============== */

	/** @name @Column(type="string") */
	public $Name;

	/** 
	 * @OneToOne(targetEntity="PhotoModel", mappedBy="Category")
	*/
	public $Photo;

}