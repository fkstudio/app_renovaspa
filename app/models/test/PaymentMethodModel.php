<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="payment_method")
 */
class PaymentMethodModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="status_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** @name @Column(type="string") */
	public $Name;

	/** @created @Column(type="datetime") */
	public $Created;

}