<?php

namespace Models;

/**
 * @Entity
 * @Table(name="certificate_item")
 */
class CertificateDetail {

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

	/** @value @Column(type="date") */
	public $Value;

	/** @for_customer_name @Column(type="string") */
	public $ForCustomerName;

	/** @to_customer_name @Column(type="string") */
	public $ToCustomerName;

	/** @message @Column(type="string") */
	public $Message;

	// email = 1
	// print = 2
	// hotel = 3
	/** @send_type @Column(type="integer") */
	public $SendType;

	/** @open_time @Column(type="date") */
	public $OpenTime;

	/** @closed_time @Column(type="date") */
	public $ClosedTime;

	/** @other_fields @Column(type="string") */
	public $OtherFields;

	/** @enabled @Column(type="boolean") */
	public $Enabled;

	/** @created @Column(type="date") */
	public $Created;

	/** @modified @Column(type="date") */
	public $Modified;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;
}