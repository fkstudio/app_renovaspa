<?php

	namespace App\Models\Test;

	/**
	 * @Entity
	 * @Table(name="wedding_package_category_relation")
	 */
	class WeddingPackageCategoryRelationModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="status_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** 
		 * @OneToOne(targetEntity="WeddingPackageModel", cascade={"persist"})
		 * @JoinColumn(name="wedding_package_id", referencedColumnName="id")
		*/
		public $WeddingPackage;

		/** 
		 * @OneToOne(targetEntity="WeddingPackageCategoryHotelModel", cascade={"persist"})
		 * @JoinColumn(name="wedding_package_category_hotel_id", referencedColumnName="id")
		*/
		public $WeddingPackageCategoryHotel;	

		/** @Column(name="price", type="integer") */
		public $Price;

		/** @Column(name="discount", type="decimal") */
		public $Discount;

		/** @Column(name="active_discount", type="boolean") */
		public $ActiveDiscount;

		public function getPrice(){
			$finalPrice = $this->Price;

			if($this->ActiveDiscount == true){
				$finalPrice = $this->Price - $this->getDiscount();
			}

			return $finalPrice;
		}

		public function getPlanePrice(){
			return $this->Price;
		}

		private function getDiscount(){
			$totalDiscount =  ( $this->Discount / 100 ) * $this->Price;
			return $totalDiscount;
		}
	}