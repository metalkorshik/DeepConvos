<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Log;
use App\Models\UserInfo;
use App\Models\Features\UserFeatures;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'is_artist' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $new_user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $new_user_info = UserInfo::create([
            'user_id' => $new_user->id,
            'name' => $input['name'],
            'surname' => $input['surname'],
            'phone' => $input['phone'],
            'country' => $input['country'],
            'email' => $input['email'],
            'city' => $input['city'],
            'is_male' => $input['is_male'],
            'is_artist' => $input['is_artist'],
            'is_subscriber' => $input['is_subscriber'],
            'image' => 'img/lk-images/customer.svg'
        ]);

        if($input['is_subscriber'])
            UserFeatures::subscribeToNews($input['email']);

        return $new_user;
    }
}
