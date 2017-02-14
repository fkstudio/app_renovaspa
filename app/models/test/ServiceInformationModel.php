<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="service_information")
 */
class ServiceInformationModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="brand_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** 
	 * @OneToOne(targetEntity="ServiceCategoryHotelModel", cascade={"persist"})
	 * @JoinColumn(name="service_category_hotel_id", referencedColumnName="id")
	*/
	public $ServiceCategoryHotel;

	/** @Column(name="duration", type="string") */
	public $Duration;

	/** @Column(name="description", type="string") */
	public $Description;

	/** @Column(name="pregnant_restriction", type="boolean") */
	public $PregnantRestriction;

	/** @Column(name="age_restriction", type="boolean") */
	public $AgeRestriction;

	/** @Column(name="only_for_wedding", type="boolean") */
	public $OnlyForWedding;

	/** @Column(name="opening_time", type="time") */
	public $OpeningTime;

	/** @Column(name="ending_time", type="time") */
	public $EndingTime;

}