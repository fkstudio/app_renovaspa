<?php

namespace Models;

/**
 * @Entity
 * @Table(name="payment_method")
 */
class PaymentMethodModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="payment_method_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** @name @Column(type="string") */
	public $Name;

	/** @enabled @Column(type="boolean") */
	public $Enabled;

	/** @created @Column(type="date") */
	public $Created;

	/** @modified @Column(type="date") */
	public $Modified;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;
}