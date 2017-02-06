<?php

	namespace App\Models\Test;

	/**
	 * @Entity
	 * @Table(name="wedding_package_service")
	 */
	class WeddingPackageServiceModel {

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
		 * @OneToOne(targetEntity="ServiceModel", cascade={"persist"})
		 * @JoinColumn(name="service_id", referencedColumnName="id")
		*/
		public $Service;	
	}