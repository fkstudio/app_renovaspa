<?php

	namespace App\Models\Test;

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
		public $Items;

		/** @created @Column(type="datetime") */
		public $Created;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;

		public function __construct(){
			$this->Items = [];
		}
	}