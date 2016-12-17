<?php

namespace Models;

/**
 * @Entity
 * @Table(name="photo")
 */
class PhotoModel {

	/** ============= PUBLIC PROPERTIES =============== */
	/** 
	 * @Id @Column(name="id")
	 * @GeneratedValue(strategy="UUID")
	 * @SequenceGenerator(sequenceName="brand_seq", initialValue=1, allocationSize=128)
	*/
	public $Id;

	/** 
	 * @OneToOne(targetEntity="HotelModel", cascade={"persist"})
	 * @JoinColumn(name="hotel_id", referencedColumnName="id")
	*/
	public $Hotel;

	/** 
	 * @OneToOne(targetEntity="CategoryModel", cascade={"persist"})
	 * @JoinColumn(name="category_id", referencedColumnName="id")
	*/
	public $Category;

	/** @path @Column(type="string") */
	public $Path;

	/** @created @Column(type="date") */
	public $Created;

	/** @Column(type="boolean", name="is_deleted") */
	public $IsDeleted;
}