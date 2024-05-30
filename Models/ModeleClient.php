<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleClient extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'noclient';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['noclient', 'nom', 'prenom', 'adresse', 'codepostal', 'ville', 'telephonefixe', 'telephonemobile', 'mel', 'motdepasse'];

    public function getNomAdresse($mel)
    {
        return $this    ->where('mel', $mel)
                        ->select('nom, adresse, codepostal, ville')
                        ->get()->getResult();
    }
    public function getToutLesInformation($noclient)
    {
        return $this    ->where('noclient', $noclient)
                        ->get()->getResult();
    }
}