<?php

namespace Models;

/**
 * @Entity
 * @Table(name="region")
 */
class RegionModel {

	/** ============= PRIVATE PROPERTIES ============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="province_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** ============= PUBLIC PROPERTIES =============== */

	/**
     * @ManyToOne(targetEntity="CountryModel", inversedBy="Regions")
     * @JoinColumn(name="country_id", referencedColumnName="id")
    */
    private $Country;

    /** 
	 * @OneToMany(targetEntity="ServiceModel", mappedBy="Region")
	*/
	protected $Services;

	/** @name @Column(type="string") */
	public $Name;

	/** @tax @Column(type="float") */
	public $Tax;

	/** @included_tax @Column(type="float") */
	public $IncludedTax;

	/** @legend @Column(type="string") */
	public $Legend;

	/** @show_legend @Column(type="boolean") */
	public $ShowLegend;

	/** @enabled @Column(type="boolean") */
	public $Enabled;

	/** 
	 * @OneToOne(targetEntity="PhotoModel", cascade={"persist"})
	 * @JoinColumn(name="photo_id", referencedColumnName="id")
	*/
	public $Photo;

	/** @created @Column(type="date") */
	public $Created;

	/** @Column(type="boolean", name="id_deleted") */
	public $IsDeleted;
}