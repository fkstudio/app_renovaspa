<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="certificate_item")
 */
class CertificateDetailModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="role_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** 
	 * @OneToOne(targetEntity="ShoppingCartItemModel", cascade={"persist"})
	 * @JoinColumn(name="cart_item_id", referencedColumnName="id")
	*/
	public $CartItem;

	/** 
	 * @OneToOne(targetEntity="ReservationModel", cascade={"persist"})
	 * @JoinColumn(name="reservation_id", referencedColumnName="id")
	*/
	public $Reservation;

	// 1 = service based
	// 2 = value based
	/** @type @Column(type="integer") */
	public $Type;

	/** @Column(name="real_customer_first_name", type="string") */
	public $RealCustomerFirstName;

	/** @Column(name="real_customer_last_name", type="string") */
	public $RealCustomerLastName;

	/** 
	 * @OneToMany(targetEntity="CertificateDetailServiceModel", cascade="persist",  mappedBy="CertificateDetail")
	*/
	public $CertificateDetailServices;

	/**  @Column(name="certificate_number", type="integer") */
	public $CertificateNumber;

	/** @Column(name="sub_total", type="decimal") */
	public $SubTotal;

	/** @Column(name="value", type="decimal") */
	public $Value;

	/** @Column(name="from_customer_name", type="string") */
	public $FromCustomerName;

	/** @Column(name="to_customer_name", type="string") */
	public $ToCustomerName;

	/** @Column(name="message", type="string") */
	public $Message;

	// email = 1
	// print = 2
	// hotel = 3
	/** @Column(name="send_type", type="integer") */
	public $SendType;

	/**  @Column(name="delivery_email", type="string") */
	public $DeliveryEmail;

	/**  @Column(name="delivery_number_or_agency", type="string") */
	public $DeliveryNumberOrAgency;

	/** @Column(name="delivery_company_name", type="string") */
	public $DeliveryCompanyName;

	/** @Column(name="delivery_departure_date", type="date") */
	public $DeliveryDepartureDate;

	/** @Column(name="delivery_other_info", type="string") */
	public $DeliveryOtherInfo;

	/** @Column(name="other_fields", type="string") */
	public $OtherFields;

	/** @enabled @Column(type="boolean") */
	public $Enabled;

	/** @created @Column(type="datetime") */
	public $Created;

	/** @modified @Column(type="datetime") */
	public $Modified;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;

	public function __construct(){
		$this->CertificateDetailServices = [];
	}
}