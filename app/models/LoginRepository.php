<?php

use Zizaco\Confide\RepositoryInterface;

class LoginRepository extends \Zizaco\Confide\EloquentRepository {

    public function getUserByEmailOrUsername($emailOrUsername) {
       
        $identity = [
            'email' => $emailOrUsername
        ];

        return $this->getUserByIdentity($identity);
    }

}

?>