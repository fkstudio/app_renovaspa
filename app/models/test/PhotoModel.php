<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="photo")
 */
class PhotoModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="brand_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** 
	 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
	 * @JoinColumn(name="hotel_id", referencedColumnName="id")
	*/
	public $Hotel;

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

	/** 
	 * @OneToOne(targetEntity="RegionModel", cascade={"persist"})
	 * @JoinColumn(name="region_id", referencedColumnName="id")
	*/
	public $Region;
	

	/** @path @Column(type="string") */
	public $Path;

}