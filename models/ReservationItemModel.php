<?php

namespace Models;

/**
 * @Entity
 * @Table(name="reservation_item")
 */
class ReservationItemModel {

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

	/** 
	 * @OneToOne(targetEntity="ServiceModel", cascade={"persist"})
	 * @JoinColumn(name="service_id", referencedColumnName="id")
	*/
	public $Service;

	/** @prefered_date @Column(type="date") */
	public $PreferedDate;

	/** @prefered_time @Column(type="date") */
	public $PreferedTime;

	/** @price @Column(type="float") */
	public $Price;

	/** 
	 * @OneToOne(targetEntity="CabinModel", cascade={"persist"})
	 * @JoinColumn(name="cabin_id", referencedColumnName="id")
	*/
	public $Cabin;

	/** @enabled @Column(type="boolean") */
	public $Enabled;

	/** @created @Column(type="date") */
	public $Created;

	/** @modified @Column(type="date") */
	public $Modified;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;
}