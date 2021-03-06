<?php

namespace App\Models\Test;

/**
 * @Entity
 * @Table(name="service_category_hotel")
 */
class ServiceCategoryHotelModel {

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
	 * @OneToOne(targetEntity="CategoryModel", cascade={"persist"})
	 * @JoinColumn(name="category_id", referencedColumnName="id")
	*/
	public $Category;

	/** 
	 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
	 * @JoinColumn(name="hotel_id", referencedColumnName="id")
	*/
	public $Hotel;

	/** @Column(name="only_for_wedding", type="boolean") */
	public $OnlyForWedding;	

	/** @Column(name="ordinal", type="integer") */
	public $Order;

	/** @Column(name="is_active", type="boolean") */
	public $IsActive;

	/** @Column(name="is_deleted", type="boolean") */
	public $IsDeleted;

	/** 
	 * @OneToOne(targetEntity="ServiceInformationModel", mappedBy="ServiceCategoryHotel")
	*/
	public $ServiceInformation;
	

	public function __construct(){
		$this->ServiceInformation = new App\Models\Test\ServiceInformationModel();
	}

}