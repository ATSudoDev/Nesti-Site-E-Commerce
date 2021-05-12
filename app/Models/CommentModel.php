<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments'; 
    protected $primaryKey = 'id_comment';
    protected $allowedFields = ['id_comment', 'title_comment', 'content_comment', 'date_creation_comment', 'state_comment', 'fk_id_recipe', 'fk_id_user', 'fk_id_moderator']; 
    protected $returnType = 'App\Entities\Comment'; 

}