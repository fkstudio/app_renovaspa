<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="service_region")
 */
class ServiceRegionModel {

	/** ============= PRIVATE PROPERTIES ============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="service_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** ============= PUBLIC PROPERTIES =============== */

	/** 
	 * @OneToOne(targetEntity="ServiceModel", cascade={"persist"})
	 * @JoinColumn(name="service_id", referencedColumnName="id")
	*/
	public $Service;

	/** 
	 * @OneToOne(targetEntity="RegionModel", cascade={"persist"})
	 * @JoinColumn(name="region_id", referencedColumnName="id")
	*/
	public $Region;

}