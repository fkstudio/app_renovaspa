<?php

	namespace App\Models\Test;

	/**
	 * @Entity
	 * @Table(name="payment_information")
	 */
	class PaymentInformationModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="status_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** @Column(name="first_name", type="string") */
		public $FirstName;	

		/** @Column(name="last_name", type="string") */
		public $LastName;	

		/** @Column(name="email", type="string") */
		public $CustomerEmail;

		/** @Column(name="post_code", type="string") */
		public $PostCode;

		/** @Column(name="phone_number", type="string") */
		public $PhoneNumber;

		/** @Column(name="company_name", type="string") */
		public $CompanyName;

		/** @Column(name="country", type="string") */
		public $CountryName;		

		/** @Column(name="street_address", type="string") */
		public $StreetAddress;

		/** @Column(name="apartment_unit", type="string") */
		public $ApartmentUnit;

		/** @Column(name="town_city", type="string") */
		public $TownCity;
	}