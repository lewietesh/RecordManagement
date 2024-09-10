<?php 
namespace App\Models;
use CodeIgniter\Model;
class ProfileHandlerModel extends Model
{
    protected $table = 'profile_handlers';
    protected $primaryKey = 'ID';
    
    protected $allowedFields = ['NAME', 'TOTAL_STUDENTS','CONTACT', 'EMAIL', 'DATE_CREATED'];
}