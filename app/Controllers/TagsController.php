<?php

namespace App\Controllers;

use App\Models\TagModel;
use App\Entities\Tag;

class TagsController extends BaseController
{


  public function tags()
  {
    helper(['form']);
    $model = new TagModel();
    $tags = $model->findAll();
    return $this->twig->render('tags/all-tags', ['tags' => $tags]);
  }

  public function tag($id)
  {
    $model = new TagModel();
    $tag = $model->find($id);
    //where('id_tag', $id)
    return $this->twig->render('tags/one-tag', ['tag' => $tag]);
  }

  public function editTag($id)
  {
    helper(['form']);
    $model = new TagModel();
    $tag = $model->find($id);
    return $this->twig->render('tags/edit-tag', ['tag' => $tag]);
  }

  public function deleteTag()
  {
    helper(['form']);
    $model = new TagModel();
    $id = $this->request->getPost('id_tag');
    $model->delete($id);
    return redirect()->to('/tags');
  }

  public function createTag()
  {
    helper(['form']);
    return $this->twig->render('tags/create-tag');
  }

  public function insertTag()
  {

    $session = session();

    // 1. On définie des règles
    // il faut que les clés correspondent à nom des "input";
    $rules = [
      'tag_name' => 'required|alpha|min_length[2]'
    ];

    if ($this->validate($rules)) {

      // 3. On récupère les données
      $name = $this->request->getPost('tag_name');

      // 4. On rempli un objet Entity
      $tag = new Tag();
     
      $tag->fill([
        'tag_name' => ucfirst($name),
      ]);

      // 5. On fait appel au model
      $model = new TagModel();

      // 6. On sauvegarde
      // si l'id est renseigné il fait un update, sinon il fait un insert
      $s = $model->insert($tag);
      
      // 7. On traite les erreurs éventuelles
      if ($s === false) {
        // les données enregistrées dans flasData ne sont concervés
        // que pour la prochaine page, puis elles seront détruites.
        $session->setFlashdata('errors', $model->errors());
      } else {
        $session->setFlashdata('success', true);
      }
    }
    // 8. on redirige ou on affiche une vue
    return redirect()->to('/tags');
  }

  public function searchTag()
  {
    return $this->twig->render('tags/search-tag');
  }

  // UPDATE TAG
  public function updateTag()
  {

    $session = session();

    // 1. On définie des règles
    // il faut que les clés correspondent à nom des "input";
    $rules = [
      'tag_name' => 'required|alpha|min_length[2]',
      'id_tag' => 'required|numeric'
    ];

    // 2. On valide les entrées en faisant appelle à la méthode
    //$this->validate()

    if ($this->validate($rules)) {

      // 3. On récupère les données
      $id = $this->request->getPost('id_tag');
      $name = $this->request->getPost('tag_name');

      // 4. On rempli un objet Entity
      $tag = new Tag();
     
      $tag->fill([
        'tag_name' => ucfirst($name),
        'id_tag' => $id,
        //'slug' => $this->slugify($name)
        // slugify() est une fonction perso, définie dans Common.php
      ]);

      // 5. On fait appel au model
      $model = new TagModel();

      // 6. On sauvegarde
      // si l'id est renseigné il fait un update, sinon il fait un insert
      $s = $model->update($id, $tag);
      
      // 7. On traite les erreurs éventuelles
      if ($s === false) {
        // les données enregistrées dans flasData ne sont concervés
        // que pour la prochaine page, puis elles seront détruites.
        $session->setFlashdata('errors', $model->errors());
      } else {
        $session->setFlashdata('success', true);
      }
    }
    // 8. on redirige ou on affiche une vue
    return redirect()->to('/tags');
  }

  public function slugify($text)
  {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
          return 'n-a';
      }

      return $text;
  }
}
