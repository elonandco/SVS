<?php

use Zizaco\Confide\UserValidator;
use Zizaco\Confide\ConfideUserInterface;


class MyUserValidator extends UserValidator
{

	public $rules = [
        'create' => [
            'email'    => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:4',
        ],
        'update' => [
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]
    ];

    public function validateIsUnique(ConfideUserInterface $user)
    {
        $identity = [
            'email'    => $user->email
        ];

        foreach ($identity as $attribute => $value) {

            $similar = $this->repo->getUserByIdentity([$attribute => $value]);

            if (!$similar || $similar->getKey() == $user->getKey()) {
                unset($identity[$attribute]);
            } else {
                $this->attachErrorMsg(
                    $user,
                    'confide::confide.alerts.duplicated_credentials',
                    $attribute
                );
            }

        }

        if (!$identity) {
            return true;
        }

        return false;
    }

    public function validatePassword(ConfideUserInterface $user)
    {

        // $hash = App::make('hash');
        // if ($user->id && $user->getOriginal('password') != $user->password) {

        //     if ($user->password === $user->password_confirmation) {

        //         // Hashes password and unset password_confirmation field
        //         $user->password = $user->password;
        //     } else {
        //         $this->attachErrorMsg(
        //             $user,
        //             'confide::confide.alerts.password_confirmation',
        //             'password_confirmation'
        //         );
        //         return false;
        //     }
        // }
        
        // unset($user->password_confirmation);

        return true;
    }


}