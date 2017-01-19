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

	/** 
	 * @OneToMany(targetEntity="ServicePriceModel", mappedBy="Service")
	*/
	public $ServicePrices;


	/* get the services price without any discount */
	public function getPlanePrice($hotel_id){
		foreach($this->ServicePrices as $servicePrice){
			if($servicePrice->HotelRegion->Hotel->Id == $hotel_id){
				
				$finalPrice = $servicePrice->Price;
				
				return $finalPrice;
			}
		}

		return 0;
	}

	/* return true if the services has discount activate and false if not */
	public function hasHotelDiscount($hotel_id){
		foreach($this->ServicePrices as $servicePrice){
			if($servicePrice->HotelRegion->Hotel->Id == $hotel_id && $servicePrice->IgnoreHotelDiscount == false){
				return $servicePrice->HotelRegion->ActiveDiscount;
			}
		}

		return false;
	}

	/* return true if the services has discount activate and false if not */
	public function hasDiscount($hotel_id){
		foreach($this->ServicePrices as $servicePrice){
			if($servicePrice->HotelRegion->Hotel->Id == $hotel_id){
				return $servicePrice->ActiveDiscount;
			}
		}

		return false;
	}

	public function getPrice($hotel_id){
		foreach($this->ServicePrices as $servicePrice){
			if($servicePrice->HotelRegion->Hotel->Id == $hotel_id){
				
				$finalPrice = $servicePrice->Price;

				if($servicePrice->ActiveDiscount == true){
			        $totalDiscount =  ( $servicePrice->Discount / 100 ) * $finalPrice;

			        $finalPrice -= $totalDiscount;	
				}
				
				if($servicePrice->IgnoreHotelDiscount == false && $servicePrice->HotelRegion->Hotel->ActiveDiscount == true){
			        $totalDiscount =  ( $servicePrice->HotelRegion->Discount / 100 ) * $finalPrice;

			        $finalPrice -= $totalDiscount;	
				}
				
				return $finalPrice;
			}
		}

		return 0;
	}

	public function getDiscount($hotel_id){
		foreach($this->ServicePrices as $servicePrice){
			if($servicePrice->HotelRegion->Hotel->Id == $hotel_id){
				return $servicePrice->Discount;
			}
		}

		return 0;
	}

}