<?php

namespace App\Models;

/**
 * @Entity
 * @Table(name="service")
 */
class ServiceModel {

	/** ============= PRIVATE PROPERTIES ============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="service_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** ============= PUBLIC PROPERTIES =============== */

	/** 
	 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
	 * @JoinColumn(name="hotel_id", referencedColumnName="id")
	*/
	public $Hotel;

	/** @name @Column(type="string") */
	public $Name;

	/** @description @Column(type="string") */
	public $Description;

	/** @duration @Column(type="float") */
	public $Duration;

	/** @pregnant_restriction @Column(type="boolean") */
	public $PregtantRestriction;

	/** @age_restriction @Column(type="boolean") */
	public $AgeRestriction;

	/** @opening_time @Column(type="date") */
	public $OpeningTime;

	/** @ending_time @Column(type="date") */
	public $EndingTime;

	/**
     * @ManyToOne(targetEntity="CategoryModel", inversedBy="Services")
     * @JoinColumn(name="category_id", referencedColumnName="id")
    */
    private $Category;

	/** 
	 * @OneToOne(targetEntity="ServiceTypeModel", cascade={"persist"})
	 * @JoinColumn(name="service_type_id", referencedColumnName="id")
	*/
	public $ServiceType;

	/** @cant_person @Column(type="integer") */
	public $CantPerson;

	
	/** @only_for_wedding @Column(type="boolean") */
	public $OnlyForWedding;

	/** @ordinal @Column(type="integer") */
	public $Ordinal;

	/** @enabled @Column(type="boolean") */
	public $Enabled;

	/** @created @Column(type="date") */
	public $Created;

	/** @Column(type="boolean", name="id_deleted") */
	public $IsDeleted;
}