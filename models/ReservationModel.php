<?php

	namespace Models;

	/**
	 * @Entity
	 * @Table(name="reservation")
	 */
	class ReservationModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="reservation_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		// 1 = services
		// 2 = gift certificate
		// 3 = wedding
		/** @reservation_type @Column(type="integer") */
		public $Type;	

		/** 
		 * @OneToOne(targetEntity="RegionModel", cascade={"persist"})
		 * @JoinColumn(name="region_id", referencedColumnName="Id")
		*/
		public $Region;

		/** 
		 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
		 * @JoinColumn(name="hotel_id", referencedColumnName="Id")
		*/
		public $Hotel;

		/** @confirmation_number @Column(type="string") */
		public $ConfirmationNumber;		

		/** @customer_name @Column(type="string") */
		public $CustomerName;

		/** @customerEmail @Column(type="string") */
		public $CustomerEmail;

		/** @arrival @Column(type="date") */
		public $Arrival;

		/** @departure @Column(type="date") */
		public $Departure;

		/** 
		 * @OneToOne(targetEntity="PaymentMethodModel", cascade={"persist"})
		 * @JoinColumn(name="payment_method_id", referencedColumnName="Id")
		*/
		public $PaymentMethod;

		/** @subtotal @Column(type="float") */
		public $Subtotal;

		/** @distount @Column(type="float") */
		public $Discount;

		/** @total @Column(type="float") */
		public $Total;

		/** @last_four_card_numbers @Column(type="string") */
		public $LastFourCardNumbers;

		/** @stay_in_hotel @Column(type="boolean") */
		public $StayInHotel;

		/** 
		 * @OneToMany(targetEntity="ReservationItemModel", mappedBy="Reservation")
		*/
		protected $ServicesDetails;

		/** 
		 * @OneToMany(targetEntity="CertificateDetail", mappedBy="Reservation")
		*/
		protected $CertificateDetails;

		/** 
		 * @OneToOne(targetEntity="StatusModel", cascade={"persist"})
		 * @JoinColumn(name="status_id", referencedColumnName="Id")
		*/
		public $Status;

		/** @created @Column(type="date") */
		public $Created;

		/** @modified @Column(type="date") */
		public $Modified;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;
	}