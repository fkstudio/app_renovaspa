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

		/** @Column(name="certificate_first_name", type="string") */
		public $CertificateFirstName;

		/** @Column(name="certificate_last_name", type="string") */
		public $CertificateLastName;

		/** @Column(name="certificate_MI", type="string") */
		public $CertificateMI;

		/** @Column(name="certificate_not_my_info", type="string") */
		public $CertificateNotMyInfo;

		/** @Column(name="certificate_email", type="string") */
		public $CertificateEmail;

		
		/** @arrival @Column(type="date") */
		public $Arrival;

		/** @departure @Column(type="date") */
		public $Departure;

		/** 
		 * @OneToOne(targetEntity="PaymentInformationModel", cascade={"persist"})
		 * @JoinColumn(name="payment_information_id", referencedColumnName="id")
		*/
		public $PaymentInformation;

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
		 * @OneToMany(targetEntity="ReservationItemModel", cascade="persist", mappedBy="Reservation")
		*/
		public $ServicesDetails;

		/** 
		 * @OneToMany(targetEntity="CertificateDetailModel", cascade="persist",  mappedBy="Reservation")
		*/
		public $CertificateDetails;

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

		public function __construct(){
			$this->ServicesDetails = [];
			$this->CertificateDetailModel = [];
			$this->PaymentInformation = new \App\Models\Test\PaymentInformationModel();
		}
	}