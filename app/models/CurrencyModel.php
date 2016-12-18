<?php

	namespace App\Models;

	/**
	 * @Entity
	 * @Table(name="currency")
	 */
	class CurrencyModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="status_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** @name @Column(type="string") */
		public $Name;

		/** @enabled @Column(type="boolean") */
		public $Enabled;

		/** @created @Column(type="date") */
		public $Created;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;
	}