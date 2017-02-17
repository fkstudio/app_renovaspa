<?php

	namespace App\Models\Test;

	/**
	 * @Entity
	 * @Table(name="wedding_package_feature")
	 */
	class WeddingPackageFeatureModel {

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

		/** @description @Column(type="string") */
		public $Description;

		/** @Column(name="created", type="datetime") */
		public $Created;
	}