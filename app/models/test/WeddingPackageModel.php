<?php

	namespace App\Models\Test;

	/**
	 * @Entity
	 * @Table(name="wedding_package")
	 */
	class WeddingPackageModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="status_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** @name @Column(type="string") */
		public $Name;

		/** @description @Column(type="string") */
		public $Description;

		/** @Column(name="is_active", type="boolean") */
		public $IsActive;

		/** @Column(name="created", type="datetime") */
		public $Created;

		/** @Column(name="is_deleted", type="boolean") */
		public $IsDeleted;

		/** 
		 * @OneToMany(targetEntity="WeddingPackageServiceModel", mappedBy="WeddingPackage")
		*/
		public $WeddingPackageServices;

		public function __construct(){
			$this->WeddingPackageServices = [];
		}
	}