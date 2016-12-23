<?php

	namespace App\Models\Test;

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

		/** @name @Column(name="name", type="string") */
		public $Name;

		/** @Column(name="address", type="string") */
		public $Address;

		/** @Column(name="notify_email", type="string") */
		public $NotifyEmail;

		/** @Column(name="customer_service_name", type="string") */
		public $CustomerServiceName;

		/** @Column(name="open_at", type="time") */
		public $OpenAt;

		/** @Column(name="closed_at", type="time") */
		public $ClosetAt;

		/** @Column(name="description", type="string") */
		public $Description;

		/** 
		 * @OneToMany(targetEntity="PhotoModel", mappedBy="Hotel")
		*/
		public $Photos;

		/** @Column(name="enabled", type="boolean") */
		public $Enabled;

		/** @Column(name="created", type="datetime") */
		public $Created;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;
	}