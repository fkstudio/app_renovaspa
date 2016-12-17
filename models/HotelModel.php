<?php

	namespace Models;

	/**
	 * @Entity
	 * @Table(name="hotel")
	 */
	class HotelModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="hotel_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** @name @Column(type="string") */
		public $Name;

		/** @address @Column(type="string") */
		public $Address;

		/** 
		 * @OneToOne(targetEntity="CountryModel", cascade={"persist"})
		 * @JoinColumn(name="country_id", referencedColumnName="id")
		*/
		public $Country;

		/** 
		 * @OneToOne(targetEntity="RegionModel", cascade={"persist"})
		 * @JoinColumn(name="region_id", referencedColumnName="id")
		*/
		public $Region;

		/** @notify_email @Column(type="string") */
		public $NotifyEmail;

		/** @customer_service_name @Column(type="string") */
		public $CustomerServiceName;

		/** @open_at @Column(type="date") */
		public $OpenAt;

		/** @closed_at @Column(type="date") */
		public $ClosetAt;

		/** @description @Column(type="string") */
		public $Description;

		/** 
		 * @OneToOne(targetEntity="PhotoModel", cascade={"persist"})
		 * @JoinColumn(name="photo_id", referencedColumnName="id")
		*/
		public $Photo;

		/** @enabled @Column(type="boolean") */
		public $Enabled;

		/** @created @Column(type="date") */
		public $Created;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;
	}