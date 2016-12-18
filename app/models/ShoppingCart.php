<?php

	namespace App\Models;

	/**
	 * @Entity
	 * @Table(name="shopping_cart")
	 */
	class ShoppingCartModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="shopping_cart_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** @session @Column(type="string") */
		public $Session;

		/** 
		 * @OneToMany(targetEntity="ShoppingCartItemModel", mappedBy="Cart")
		*/
		protected $Items;

		/** @created @Column(type="date") */
		public $Created;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;
	}