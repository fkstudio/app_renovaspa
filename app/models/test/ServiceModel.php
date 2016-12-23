<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="service")
 */
class ServiceModel {

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

	// service price object
	public $ServicePrice;

	/** 
	 * @OneToMany(targetEntity="ServicePriceModel", mappedBy="Service")
	*/
	public $ServicePrices;

	public function getPrice($hotel_id){
		foreach($this->ServicePrices as $servicePrice){
			if($servicePrice->Hotel->Id == $hotel_id){
				return $servicePrice->Price;
			}
		}

		return 0;
	}

}