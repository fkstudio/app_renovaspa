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
	 * @OneToOne(targetEntity="CabinModel", cascade={"persist"})
	 * @JoinColumn(name="cabin_id", referencedColumnName="id")
	*/
	public $Cabin;

	/** 
	 * @OneToMany(targetEntity="ServicePriceModel", mappedBy="Service")
	*/
	public $ServicePrices;

	/** @Column(name="is_active", type="boolean") */
	public $IsActive;

	/** @Column(name="is_deleted", type="boolean") */
	public $IsDeleted;

	/** 
	 * @OneToMany(targetEntity="ServiceCategoryHotelModel", mappedBy="Service")
	*/
	public $ServiceCategoryHotels;

	public function getProfile($hotel_id, $category_id){
		foreach($this->ServiceCategoryHotels as $serviceCategoryHotel){
			if($serviceCategoryHotel->Category->Id == $category_id && $serviceCategoryHotel->Hotel->Id == $hotel_id){
				return $serviceCategoryHotel;
			}
		}
	}


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

	public function getHotelDiscount($hotel_id){
		foreach($this->ServicePrices as $servicePrice){
			if($servicePrice->HotelRegion->Hotel->Id == $hotel_id && $servicePrice->IgnoreHotelDiscount == false){
				$totalDiscount =  ( $servicePrice->HotelRegion->Discount / 100 ) * $servicePrice->Price;
				return $totalDiscount;
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
				
				if($servicePrice->IgnoreHotelDiscount == false && $servicePrice->HotelRegion->ActiveDiscount == true){
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