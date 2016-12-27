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
	 * @OneToOne(targetEntity="ReservationModel", cascade={"persist"})
	 * @JoinColumn(name="reservation_id", referencedColumnName="id")
	*/
	public $Reservation;

	// 1 = service based
	// 2 = value based
	/** @type @Column(type="string") */
	public $Type;

	/** 
	 * @OneToOne(targetEntity="ServiceModel", cascade={"persist"})
	 * @JoinColumn(name="service_id", referencedColumnName="id")
	*/
	public $Service;

	/** @value @Column(type="decimal") */
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

	/** @arrival @Column(type="date") */
	public $Arrival;

	/** @Column(name="departure", type="date") */
	public $Departure;

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
}