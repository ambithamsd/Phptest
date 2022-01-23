<?php

namespace App\Models;
use CodeIgniter\Model;

class TokenModel extends Model
{
    protected $table         = 'login_token';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'lt_token', 
        'lt_user_id', 
        'lt_expiry'
    ];
}