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

		// ================== Wedding data =====================
		/** @Column(name="bride_name", type="string") */
		public $BrideName;

		/** @Column(name="groom_name", type="string") */
		public $GroomName;

		/** @Column(name="email", type="string") */
		public $Email;

		/** @Column(name="wedding_bill_delivery", type="integer") */
		public $WeddingBillDelivery;

		/** @Column(name="remarks", type="string") */
		public $Remarks;

		/** @Column(name="wedding_date", type="date") */
		public $WeddingDate;

		/** @Column(name="wedding_time", type="time") */
		public $WeddingTime;		
		//================== wedding data end ===================


		// ================= certificate data ======================
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
		// ================= certificate data end ====================
		
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

		public function getDiscount(){
			/* reset total */
			$this->Discount = 0;

			if($this->Type == 1){
				foreach($this->ServicesDetails as $detail){
					$this->Discount += $detail->Service->getDiscount($this->Hotel->Id);
					$this->Discount += $detail->Service->getHotelDiscount($this->Hotel->Id);
				}
			}
			else if($this->Type == 2){
				foreach($this->CertificateDetails as $detail){
					if($detail->Type == 1){
						foreach($detail->CertificateDetailServices as $certService){
							$this->Discount += $certService->Service->getDiscount($this->Hotel->Id);	
						}
					}
					else {
						$this->Discount += $detail->Value;
					}
				}
			}

			return $this->Discount;
		}

		public function getTotal(){
			/* reset total */
			$this->Total = 0;

			if($this->Type == 1){
				foreach($this->ServicesDetails as $detail){
					$this->Total += $detail->Service->getPrice($this->Hotel->Id);
				}
			}
			else if($this->Type == 2){
				foreach($this->CertificateDetails as $detail){
					if($detail->Type == 1){
						foreach($detail->CertificateDetailServices as $certService){
							$this->Total += $certService->Service->getPrice($this->Hotel->Id);	
						}
					}
					else {
						$this->Total += $detail->Value;
					}
				}
			}

			return $this->Total;
		}

		public function getSubtotal(){
			/* reset subtotal */
			$this->Subtotal = 0;

			if($this->Type == 1){
				foreach($this->ServicesDetails as $detail){
					$this->Subtotal += $detail->Service->getPlanePrice($this->Hotel->Id);
				}
			}
			else if($this->Type == 2){
				foreach($this->CertificateDetails as $detail){
					if($detail->Type == 1){
						foreach($detail->CertificateDetailServices as $certService){
							$this->Subtotal += $certService->Service->getPlanePrice($this->Hotel->Id);	
						}
					}
					else{
						$this->Subtotal += $detail->SubTotal;
					}
				}
			}

			return $this->Subtotal;
		}

		public function __construct(){
			$this->ServicesDetails = [];
			$this->CertificateDetailModel = [];
			$this->PaymentInformation = new \App\Models\Test\PaymentInformationModel();
		}
	}