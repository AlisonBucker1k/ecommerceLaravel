<?php

namespace App;

use App\Enums\AddressMain;
use App\Enums\AddressStatus;
use App\Enums\CustomerStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * @return string
     */
    public function getStatusDescriptionAttribute()
    {
        return AddressStatus::getDescription($this->status);
    }

    /**
     * @return string
     */
    public function getMainDescriptionAttribute()
    {
        return AddressMain::getDescription($this->main);
    }

    /**
     * @return mixed|string
     */
    public function getCompleteAddressAttribute()
    {
        $completeAddress = $this->street;
        if (!empty($this->number)) {
            $completeAddress .= ', ' . $this->number;
        }

        if (!empty($this->complement)) {
            $completeAddress .= ', ' . $this->complement;
        }

        if (!empty($this->reference)) {
            $completeAddress .= ', ' . $this->reference;
        }

        $completeAddress .= ', ' . $this->district;
        $completeAddress .= ' - ' . $this->city;
        $completeAddress .= '/' . $this->state;

        return $completeAddress;
    }

    /**
     * @param $customerId
     * @param $data
     * @return $this
     */
    public function createCustomerAddress($customerId, $data)
    {
        $existsMain = $this->query()->where(['customer_id' => $customerId, 'main' => AddressMain::YES, 'status' => AddressStatus::ACTIVE])->exists();
        if (!$existsMain) {
            $this->main = AddressMain::YES;
        }

        $this->customer_id = $customerId;
        $this->postal_code = $data['cep'];
        $this->country = 'BR';
        $this->district = $data['district'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->street = $data['street'];
        $this->number = $data['number'];
        $this->complement = $data['complement'];
        $this->reference = $data['reference'];
        $this->status = CustomerStatus::ACTIVE;
        $this->save();

        return $this;
    }

    /**
     * Set address as main.
     *
     * @param Address $address
     * @return Address
     */
    public function setMain(Address $address)
    {
        DB::table('addresses')
            ->where('customer_id', $address->customer_id)
            ->where('main',  AddressMain::YES)
            ->update(['main' => AddressMain::NOT]);

        $address->main = AddressMain::YES;
        $address->save();

        return $address;
    }

    /**
     * @param int $customerId
     */
    public function setRandomMain(int $customerId)
    {
        DB::table('addresses')
            ->where('customer_id', $customerId)
            ->where('status', AddressStatus::ACTIVE)
            ->update(['main' => AddressMain::YES]);
    }

    /**
     * Set address as inactive.
     *
     * @param Address $address
     * @return Address
     */
    public function setInactive(Address $address)
    {
        $main = $address->main;

        $address->status = AddressStatus::INACTIVE;
        $address->main = AddressMain::NOT;

        if ($main == AddressMain::YES) {
            $this->setRandomMain($address->customer_id);
        }

        $address->save();

        return $address;
    }
}