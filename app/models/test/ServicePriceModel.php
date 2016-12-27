<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="service_price")
 */
class ServicePriceModel {

	/** ============= PRIVATE PROPERTIES ============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="service_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** ============= PUBLIC PROPERTIES =============== */

	/** @price @Column(type="decimal") */
	public $Price;

	/** 
	 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
	 * @JoinColumn(name="hotel_id", referencedColumnName="id")
	*/
	public $Hotel;

	/** 
	 * @OneToOne(targetEntity="ServiceModel", cascade={"persist"})
	 * @JoinColumn(name="service_id", referencedColumnName="id")
	*/
	public $Service;

	/** @Column(name="discount", type="decimal") */
	public $Discount;

	/** @Column(name="active_discount", type="boolean") */
	public $ActiveDiscount;
	

	public function __construct(){
		$this->Price = 0.00;
	}

}