<?php

	namespace App\Models\Test;

	/**
	 * @Entity
	 * @Table(name="hotel")
	 */
	class HotelModel {

		/** ============= PUBLIC PROPERTIES =============== */
		/** 
		 * @Id @Column(name="id")
		 * @GeneratedValue(strategy="UUID")
		 * @SequenceGenerator(sequenceName="hotel_seq", initialValue=1, allocationSize=128)
		*/
		public $Id;

		/** @name @Column(name="name", type="string") */
		public $Name;

		/** @Column(name="address", type="string") */
		public $Address;

		/** @Column(name="notify_email", type="string") */
		public $NotifyEmail;

		/** @Column(name="customer_service_name", type="string") */
		public $CustomerServiceName;

		/** @Column(name="open_at", type="time") */
		public $OpenAt;

		/** @Column(name="closed_at", type="time") */
		public $ClosetAt;

		/** @Column(name="description", type="string") */
		public $Description;

		/** @Column(name="discount", type="decimal") */
		public $Discount;

		/** @Column(name="active_discount", type="boolean") */
		public $ActiveDiscount;

		/** 
		 * @OneToMany(targetEntity="PhotoModel", mappedBy="Hotel")
		*/
		public $Photos;

		/** @Column(name="enabled", type="boolean") */
		public $Enabled;

		/** @Column(name="created", type="datetime") */
		public $Created;

		/** @Column(type="boolean", name="is_deleted") */
		public $IsDeleted;

		public function getProfile(){
			$photo_path = null;
			if(count($this->Photos) > 0){
				$photo_path = $this->Photos[0]->Path;
			}
			else {
				$newPhoto = new \App\Models\Test\PhotoModel();
				$photo_path = $newPhoto->Path;
			}

			return $photo_path;
		}
	}