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
		 * @OneToOne(targetEntity="WeddingPackageCategoryModel", cascade={"persist"})
		 * @JoinColumn(name="wedding_package_category_id", referencedColumnName="id")
		*/
		public $WeddingPackageCategory;	

		/** @Column(name="price", type="integer") */
		public $Price;

		/** @Column(name="discount", type="decimal") */
		public $Discount;

		/** @Column(name="active_discount", type="boolean") */
		public $ActiveDiscount;
	}