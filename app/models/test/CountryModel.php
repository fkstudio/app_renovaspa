<?php

	namespace App\Models\Test;

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

		/** @name @Column(type="string") */
		public $Name;

		/** 
		 * @OneToOne(targetEntity="CurrencyModel", cascade={"persist"})
		 * @JoinColumn(name="currency_id", referencedColumnName="id")
		*/
		public $Currency;

		/** 
		 * @OneToMany(targetEntity="RegionModel", mappedBy="Country")
		*/
		public $Regions;

		/** 
		 * @OneToOne(targetEntity="PhotoModel", mappedBy="Country")
		*/
		public $Photo;

	}