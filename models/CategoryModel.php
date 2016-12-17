<?php

	namespace Models;

	/**
	 * @Entity
	 * @Table(name="category")
	 */
	class CategoryModel {

		/** ============= PRIVATE PROPERTIES ============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="category_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** ============= PUBLIC PROPERTIES =============== */

		/** @name @Column(type="string") */
		public $Name;

		/** @description @Column(type="string") */
		public $Description;


		/** @ordinal @Column(type="integer") */
		public $Ordinal;

		/** 
		 * @OneToMany(targetEntity="CountryModel", mappedBy="Category")
		*/
		protected $Countries;

		/** 
		 * @OneToMany(targetEntity="ServiceModel", mappedBy="Category")
		*/
		protected $Services;

		/** 
		 * @OneToOne(targetEntity="PhotoModel", cascade={"persist"})
		 * @JoinColumn(name="photo_id", referencedColumnName="id")
		*/
		public $Photo;

		/** @enabled @Column(type="boolean") */
		public $Enabled;

		/** @created @Column(type="date") */
		public $Created;

		/** @Column(type="boolean", name="id_deleted") */
		public $IsDeleted;
	}