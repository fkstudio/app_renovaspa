<?php

	namespace App\Models\Test;

	/**
	 * @Entity
	 * @Table(name="wedding_package_category")
	 */
	class WeddingPackageCategoryModel {

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

		/** @Column(name="ordinal", type="string") */
		public $Ordinal;

		/** @Column(name="is_active", type="boolean") */
		public $IsActive;

		/** @Column(name="created", type="datetime") */
		public $Created;
		
		/** @Column(name="is_deleted", type="boolean") */
		public $IsDeleted;

		public function __construct(){
			$this->WeddingPackageCategoryRelation = [];
		}

	}