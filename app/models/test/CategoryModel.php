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

	/** @Column(name="is_active", type="boolean") */
	public $IsActive;

	/** @Column(name="is_deleted", type="boolean") */
	public $IsDeleted;

	/** 
	 * @OneToMany(targetEntity="CategoryCountryModel", cascade="persist",  mappedBy="Category")
	*/
	public $CategoryCountries;

	public function GetCategoryCountry($country_id){
		foreach($this->CategoryCountries as $categoryCountry){
			if($categoryCountry->Country->Id == $country_id)
				return $categoryCountry;
		}

		return null;
	}

	public function __construct(){
		$this->CategoryCountries = [];
		$this->Photo = new App\Models\Test\PhotoModel();
	}

}