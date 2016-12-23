<?php

	namespace App\Models\Test;

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
		 * @JoinColumn(name="region_id", referencedColumnName="id")
		*/
		public $Region;

		/** 
		 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
		 * @JoinColumn(name="hotel_id", referencedColumnName="id")
		*/
		public $Hotel;

		/** @Column(name="confirmation_number", type="string") */
		public $ConfirmationNumber;		

		/** @Column(name="customer_name", type="string") */
		public $CustomerName;

		/** @Column(name="customer_email", type="string") */
		public $CustomerEmail;

		/** @arrival @Column(type="date") */
		public $Arrival;

		/** @departure @Column(type="date") */
		public $Departure;

		/** 
		 * @OneToOne(targetEntity="PaymentMethodModel", cascade={"persist"})
		 * @JoinColumn(name="payment_method_id", referencedColumnName="id")
		*/
		public $PaymentMethod;

		/** @subtotal @Column(type="float") */
		public $Subtotal;

		/** @distount @Column(type="float") */
		public $Discount;

		/** @total @Column(type="float") */
		public $Total;

		/** @Column(name="last_four_card_numbers", type="string") */
		public $LastFourCardNumbers;

		/** 
		 * @OneToMany(targetEntity="ReservationItemModel", mappedBy="Reservation")
		*/
		public $ServicesDetails;

		/** 
		 * @OneToMany(targetEntity="CertificateDetail", mappedBy="Reservation")
		*/
		//protected $CertificateDetails;

		/** 
		 * @OneToOne(targetEntity="StatusModel", cascade={"persist"})
		 * @JoinColumn(name="status_id", referencedColumnName="id")
		*/
		public $Status;

		/** @created @Column(type="datetime") */
		public $Created;

		/** @modified @Column(type="datetime") */
		public $Modified;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;
	}