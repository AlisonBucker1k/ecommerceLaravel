<?php

namespace App;

use App\Enums\AddressMain;
use App\Enums\AddressStatus;
use App\Enums\CustomerStatus;
use App\Notifications\CustomerResetPasswordNotification;
use App\Notifications\CustomerVerifyEmailNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Customer extends Model implements Authenticatable, MustVerifyEmail, CanResetPassword
{
    use AuthenticableTrait;
    use Notifiable;

    protected $fillable = ['email', 'status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('slug', $value)->first() ?? abort(404);
    }

    public function getStatusDescriptionAttribute()
    {
        return CustomerStatus::getDescription($this->status);
    }

    public function profile()
    {
        return $this->hasOne('App\CustomerProfile');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function ordenedAddresses()
    {
        return $this->activeAddresses()->orderBy('main', 'DESC')->get();
    }

    public function activeAddresses()
    {
        return $this->hasMany('App\Address')->where('status', AddressStatus::ACTIVE);
    }

    public function mainAddress()
    {
        return $this->hasOne('App\Address')->where(['status' => AddressStatus::ACTIVE, 'main' => AddressMain::YES]);
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function createCustomer($data)
    {
        $this->email = $data['email'];
        $this->password = bcrypt($data['password']);
        $this->slug = $this->getUniqueSlug($data['name']);
        $this->status = CustomerStatus::ACTIVE;
        $this->save();

        $customerProfile = new CustomerProfile();
        $customerProfile->createCustomerProfile($data + ['customer_id' => $this->id]);

        $this->sendEmailVerificationNotification();

        return $this;
    }

    /**
     * Update the Customer
     *
     * @param  mixed  $request
     * @return Customer
     */
    public function updateCustomer($request)
    {
        $this->slug = $this->getUniqueSlug($request->name, $request->id);
        $this->email = $request->email;
        $this->updated_at = now();
        $this->update();

        return $this;
    }

    /**
     * Save the Customer
     *
     * @param  mixed  $request
     * @return Customer
     */
    public function updatePassword($request)
    {
        $this->password = bcrypt($request->password);
        $this->save();

        return $this;
    }

    public function getUniqueSlug($name, $id = null, $count = 0)
    {
        $slug = Str::slug($name, '-');
        if ($count > 0) {
            $slug .= $count;
        }

        $find = $this->query()->where('slug', $slug);
        if (!empty($id)) {
            $find->where('id', '!=', $id);
        }

        $exists = $find->exists();
        if ($exists) {
            return $this->getUniqueSlug($name, $id, ($count+1));
        }

        return $slug;
    }

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return ! is_null($this->email_verified_at);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomerVerifyEmailNotification());
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the email verification notification.
     *
     * @param String $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPasswordNotification($token));
    }
}
