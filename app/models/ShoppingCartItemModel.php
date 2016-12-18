<?php

	namespace App\Models;

	/**
	 * @Entity
	 * @Table(name="shopping_cart_item")
	 */
	class ShoppingCartItemModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="shopping_cart_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** 
		 * @OneToOne(targetEntity="ShoppingCartModel", cascade={"persist"})
		 * @JoinColumn(name="cart_id", referencedColumnName="id")
		*/
		public $Cart;

		/** @quantity @Column(type="integer") */
		public $Quantity;

		/** 
		 * @OneToOne(targetEntity="ServiceModel", cascade={"persist"})
		 * @JoinColumn(name="service_id", referencedColumnName="id")
		*/
		public $Service;

		/** @prefered_date @Column(type="date") */
		public $PreferedDate;

		/** @prefered_time @Column(type="date") */
		public $PreferedTime;

		/** 
		 * @OneToOne(targetEntity="CabinModel", cascade={"persist"})
		 * @JoinColumn(name="cabin_id", referencedColumnName="id")
		*/
		public $Cabin;		

		// 1 = services
		// 2 = certificate
		// 3 = wedding
		/** @type @Column(type="string") */
		public $Type;

		/** @created @Column(type="date") */
		public $Created;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;
	}