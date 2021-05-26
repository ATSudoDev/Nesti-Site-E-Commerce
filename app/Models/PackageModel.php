<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table = 'packages';
    protected $primaryKey = 'ref_package, fk_id_article' ;
    protected $allowedFields = ['ref_package', 'fk_id_article', 'price_unite_package', 'quantity_bought_package', 'date_reception '];
    protected $returnType = 'App\Entities\Package';

}