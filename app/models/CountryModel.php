<?php

	namespace App\Models;

	/**
	 * @Entity
	 * @Table(name="country")
	 */
	class CountryModel {

		/** ============= PRIVATE PROPERTIES ============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="province_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** ============= PUBLIC PROPERTIES =============== */

		/**
	     * @ManyToOne(targetEntity="CategoryModel", inversedBy="Countries")
	     * @JoinColumn(name="category_id", referencedColumnName="id")
	    */
	    private $Category;

		/** @name @Column(type="string") */
		public $Name;

		/** 
		 * @OneToOne(targetEntity="CurrencyModel", cascade={"persist"})
		 * @JoinColumn(name="currency_id", referencedColumnName="id")
		*/
		public $Currency;

		/** @enabled @Column(type="boolean") */
		public $Enabled;

		/** @created @Column(type="date") */
		public $Created;

		/** 
		 * @OneToMany(targetEntity="RegionModel", mappedBy="Country")
		*/
		public $Regions;

		/** 
		 * @OneToMany(targetEntity="ServiceModel", mappedBy="Country")
		*/
		protected $Services;

		/** @Column(type="boolean", name="id_deleted") */
		public $IsDeleted;

		public function __construct(){
			$this->Regions = [];
		}
	}