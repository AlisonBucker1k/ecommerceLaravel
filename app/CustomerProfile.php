<?php

namespace App;

use App\Enums\UploadPath;
use App\General\Upload;
use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'birth_date',
        'phone',
        'cellphone',
        'status',
        'customer_id',
        'cpf',
        'photo',
    ];

    public function createCustomerProfile($data)
    {
        $this->name = $data['name'];
        $this->last_name = $data['last_name'];
        $this->cpf = $data['cpf'];
        $this->customer_id = $data['customer_id'];

        return $this->save();
    }

    /**
     * @param $customer
     * @param $request
     * @return mixed
     */
    public function updateCustomerProfile($customer, $request)
    {
        $customerProfile = $customer->profile()->first();
        $customerProfile->attachPhoto($request->file('photo'));
        $customerProfile->name = $request->name;
        $customerProfile->last_name = $request->last_name;
        $customerProfile->phone = $request->phone;
        $customerProfile->cellphone = $request->cellphone;
        $customerProfile->birth_date = $request->birth_date;
        $customerProfile->cpf = $request->cpf;
        $customerProfile->save();

        return $customerProfile;
    }

    public function updateProfile($params)
    {
        $this->name = $params->name;
        $this->last_name = $params->last_name;
        $this->phone = getOnlyNumber($params->phone);
        $this->cellphone = getOnlyNumber($params->cellphone);
        $this->birth_date = $params->birth_date;
        $this->save();
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param $photo
     * @return $this
     */
    public function attachPhoto($photo)
    {
        if (!empty($photo)) {
            $upload = new Upload($photo);
            $upload->image_resize = true;
            $upload->image_ratio_fill = true;
            $upload->image_x = 800;
            $upload->image_y = 600;
            $url = $upload->save(UploadPath::PRODUCT_IMAGES);

            $this->photo = $url;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->isVerifiedClient() ? $this->getFullNameLong() : $this->getFullNameShort();
    }

    /**
     * @return bool
     */
    public function isVerifiedClient()
    {
        return auth()->user() && auth()->user()->hasVerifiedEmail();
    }

    /**
     * @return string
     */
    public function getFullNameLong()
    {
        return "Olá, $this->name $this->last_name";
    }

    public function getPhotoOrDefaultAttribute()
    {
        return $this->photo ?? asset('useLadame/images/logo/no-image.jpg');
    }

    /**
     * @return string
     */
    public function getFullNameShort()
    {
        return "$this->name $this->last_name";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
