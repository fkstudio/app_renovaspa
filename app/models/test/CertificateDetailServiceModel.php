<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="certificate_detail_service")
 */
class CertificateDetailServiceModel {

	/** ============= PRIVATE PROPERTIES ============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="service_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** ============= PUBLIC PROPERTIES =============== */

	/** 
	 * @OneToOne(targetEntity="CertificateDetailModel", cascade={"persist"})
	 * @JoinColumn(name="certificate_detail_id", referencedColumnName="id")
	*/
	public $CertificateDetail;

	/** 
	 * @OneToOne(targetEntity="ServiceModel", cascade={"persist"})
	 * @JoinColumn(name="service_id", referencedColumnName="id")
	*/
	public $Service;

}