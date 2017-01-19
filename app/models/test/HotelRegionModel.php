<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="hotel_region")
 */
class HotelRegionModel {

	/** ============= PRIVATE PROPERTIES ============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="service_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** ============= PUBLIC PROPERTIES =============== */

	/** 
	 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
	 * @JoinColumn(name="hotel_id", referencedColumnName="id")
	*/
	public $Hotel;

	/** 
	 * @OneToOne(targetEntity="RegionModel", cascade={"persist"})
	 * @JoinColumn(name="region_id", referencedColumnName="id")
	*/
	public $Region;

	/** @Column(name="discount", type="decimal") */
	public $Discount;

	/** @Column(name="active_discount", type="boolean") */
	public $ActiveDiscount;

}