<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'ADMIN_ID';

    protected $allowedFields = ['ADMIN_NAME', 'ADMIN_EMAIL', 'PASS_HASH', 'BIO', 'LAST_UPDATED', 'ISLOGGEDIN'];

    /**
     * Finds an admin by username.
     *
     * @param string $username
     * @return array|null
     */
    public function getAdminByUsername($username)
    {
        return $this->where('ADMIN_NAME', $username)->first();
    }
}
