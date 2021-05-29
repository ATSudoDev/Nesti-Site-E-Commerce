<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $allowedFields = ['id_product', 'name_product'];
    protected $returnType = 'App\Entities\Product';

    public function searchProduct(String $name)
    {
        $builder = $this->db->table('products');
        $builder->like("name_product", "%" . $name . "%");
        $query = $builder->get();
        return $query->getResult();
    }
}
