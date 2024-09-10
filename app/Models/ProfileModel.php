<?php 
namespace App\Models;
use CodeIgniter\Model;
class ProfileModel extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = ['PROFILE_NAME', 'PROFILE_ADMIN', 'PROFILE_HANDLER', 'TOTAL_COURSES', 'INSTITUTION', 'MAJOR', 'GENDER', 'STATUS'];

}