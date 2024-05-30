<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleSecteur extends Model
{
    protected $table = "secteur";
    protected $primaryKey = "nosecteur";
    Protected $useAutoIncrement = false;
    protected $returnType = "object";
    protected $allowedFields = ['nosecteur', 'nom'];
    
    public function getNoSecteur()
    {
        return $this    ->select('nosecteur, nom')
                        ->get()->getResult();
    }
}