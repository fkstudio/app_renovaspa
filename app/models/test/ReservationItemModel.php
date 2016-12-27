<?php

namespace App\Models\Test;

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

	/** @Column(name="customer_name", type="string") */
	public $CustomerName;

	/** @Column(name="prefered_date", type="date") */
	public $PreferedDate;

	/** @Column(name="prefered_time", type="time") */
	public $PreferedTime;

	/** @Column(name="price", type="float") */
	public $Price;

	/** 
	 * @OneToOne(targetEntity="CabinModel", cascade={"persist"})
	 * @JoinColumn(name="cabin_id", referencedColumnName="id")
	*/
	public $Cabin;


	/** @created @Column(type="datetime") */
	public $Created;

	/** @modified @Column(type="datetime") */
	public $Modified;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;

	public function __clone(){
		$this->Id = null;
	}
}