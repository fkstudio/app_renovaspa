<?php

	namespace App\Models\Test;

	/**
	 * @Entity
	 * @Table(name="wedding_package_category_hotel")
	 */
	class WeddingPackageCategoryHotelModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="status_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** 
		 * @OneToOne(targetEntity="WeddingPackageCategoryModel", cascade={"persist"})
		 * @JoinColumn(name="wedding_package_category_id", referencedColumnName="id")
		*/
		public $WeddingPackageCategory;

		/** 
		 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
		 * @JoinColumn(name="hotel_id", referencedColumnName="id")
		*/
		public $Hotel;	
	}