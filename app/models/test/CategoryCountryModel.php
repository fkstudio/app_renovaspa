<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="category_country")
 */
class CategoryCountryModel {

	/** ============= PRIVATE PROPERTIES ============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="service_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** ============= PUBLIC PROPERTIES =============== */

	/** 
	 * @OneToOne(targetEntity="CategoryModel", cascade={"persist"})
	 * @JoinColumn(name="category_id", referencedColumnName="id")
	*/
	public $Category;

	/** 
	 * @OneToOne(targetEntity="CountryModel", cascade={"persist"})
	 * @JoinColumn(name="country_id", referencedColumnName="id")
	*/
	public $Country;		

}