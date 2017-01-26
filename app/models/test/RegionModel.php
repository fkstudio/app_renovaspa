<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="region")
 */
class RegionModel {

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
	 * @OneToOne(targetEntity="CountryModel", cascade={"persist"})
	 * @JoinColumn(name="country_id", referencedColumnName="id")
	*/
	public $Country;

	/** 
	 * @OneToMany(targetEntity="HotelRegionModel", mappedBy="Region")
	*/
	public $HotelRegions;

	/** 
	 * @OneToOne(targetEntity="PhotoModel", mappedBy="Region")
	*/
	public $Photo;

}