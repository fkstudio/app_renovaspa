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

	/** @Column(name="description", type="string") */
	public $Description;

	/** @Column(name="is_special", type="boolean") */
	public $IsSpecial;

	/** @Column(name="special_begin_date", type="datetime") */
	public $SpecialBeginDate;

	/** @Column(name="special_end_date", type="datetime") */
	public $SpecialEndDate;

	/** @Column(name="ordinal", type="integer") */
	public $Order;

	/** @Column(name="is_active", type="boolean") */
	public $IsActive;

	/** @Column(name="is_deleted", type="boolean") */
	public $IsDeleted;

	public $ServiceCategoryHotels;

	public function __construct(){
		$this->ServiceCategoryHotels = [];
	}
}