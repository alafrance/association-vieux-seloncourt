<?php
namespace App\src\DAO;
use App\src\model\Article;
use App\src\model\Category;
use App\src\model\Assembly;
use Config\Alexis\Parameter;
class ArticleDAO extends DAO{

    /* ----------------------- */
    /* ----- BUILD MODEL ----- */
    /* ----------------------- */

    private function buildArticle($row){
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['name']);
        $article->setCategory($row['category_name']);
        $article->setImage($row['image_name']);
        $article->setDate($row['date']);
        return $article;
    }
    private function buildCategories($data){
        $category = new Category();
        $category->setId($data['id']);
        $category->setName($data['category_name']);
        $category->setDate($data['category_date']);
        return $category;
    }

    public function buildAssembly($data){
        $assembly = new Assembly();
        $assembly->setId($data['id']);
        $assembly->setPlace($data['place']);
        $assembly->setTime($data['time']);
        $assembly->setContent($data['content']);
        $assembly->setDate($data['date']);
        return $assembly;
    }
    /* -------------------------------- */
    /* ----- RECUPERATION ARTICLE ----- */
    /* -------------------------------- */

    public function getArticles(){
        $sql = 'SELECT article.id, article.title, article.content, article.date, user.name, category.category_name, image_name FROM article
        INNER JOIN category ON article.category_id = category.id
        INNER JOIN user ON article.author_id = user.id
        INNER JOIN image ON image.id = article.image_id
        ORDER BY date';
        $request = $this->createQuery($sql);
        $articles = [];
        foreach ($request as $row){
            $id = $row['id'];
            $articles[$id] = $this->buildArticle($row);
        }
        $request->closeCursor();
        return $articles;
    }
    public function getYoursArticles(int $idAuthor){
        $sql = "SELECT article.id, article.title, article.content, article.date,article.author_id, user.name, category.category_name, image_name FROM article
        INNER JOIN category ON article.category_id = category.id
        INNER JOIN user ON article.author_id = user.id
        INNER JOIN image ON image.id = article.image_id
        WHERE article.author_id = ?  ORDER BY date DESC";
        $request = $this->createQuery($sql, [$idAuthor]);
        $articles = [];
        foreach ($request as $row){
            $id = $row['id'];
            $articles[$id] = $this->buildArticle($row);
        }
        $request->closeCursor();
        return $articles;
    }
    public function getArticle($id){
        $sql = 'SELECT article.id, article.title, article.content, article.date, user.name, category.category_name, image_name FROM article
        INNER JOIN category ON category.id = article.category_id
        INNER JOIN user ON user.id = article.author_id
        INNER JOIN image ON image.id = article.image_id
        WHERE article.id = ?';
        $request = $this->createQuery($sql, [intval($id)]);
        $article = $request->fetch();
        $request->closeCursor();
        return  $this->buildArticle($article);
    }

    /* --------------------------------------- */
    /* --- ACTIONS(ADD, EDIT, ...) ARTICLE --- */
    /* --------------------------------------- */

    public function addArticle(Parameter $post, $idAuthor, $idImage)
    {
        $sql = 'INSERT INTO article (title, content, category_id, author_id, image_id, date) VALUES(?, ?, ?, ? ,? , NOW())';
        $this->createQuery($sql, [
            $post->get('title'),
            $post->get('content'),
            intval($post->get('category')),
            intval($idAuthor),
            intval($idImage)
            ]);
    }
    public function addExposition(Parameter $post, $idAuthor, $idImage)
    {
        $sql = 'INSERT INTO article (title, content, category_id, author_id, image_id, date) VALUES(?, ?, ?, ? ,? , NOW())';
        $this->createQuery($sql, [
            $post->get('title'),
            $post->get('content'),
            1,
            intval($idAuthor),
            intval($idImage)
            ]);
    }

    public function editArticle(Parameter $post, $articleId)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, category_id=:category_id WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'category_id' => intval($post->get('category')),
            'articleId' => $articleId
        ]);
    }
    public function deleteArticle($articleId)
    {
        // On supprime les commentaires associés à l'Article
        $sql = 'DELETE FROM comment WHERE article_id = ?';
        $this->createQuery($sql, [$articleId]);

        // On récupère l'id de l'image de l'article.
        $sql = 'SELECT * FROM article WHERE article.id = ?';
        $request = $this->createQuery($sql, [$articleId]);
        $data = $request->fetch();

        // On supprime l'image associé à l'Article
        $sql = 'DELETE FROM image WHERE image.id = ? ';
        $this->createQuery($sql, [$data['image_id']]);

        // On supprime finalement l'article
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }

    /* ---------------------------------- */
    /* -----------  CATEGORIE ----------- */
    /* ---------------------------------- */

    public function getCategories(){
        $sql = 'SELECT category_name, id, category_date FROM category ORDER BY category_date';
        $request = $this->createQuery($sql);
        $categories = [];
        foreach ($request as $data){
            $id = $data['id'];
            $categories[$id] = $this->buildCategories($data);
        }
        $request->closeCursor();
        return $categories;
    }
    public function getCategory($categoryId){
        $sql = 'SELECT * FROM category WHERE id = ?';
        $request = $this->createQuery($sql, [$categoryId]);
        $category = $request->fetch();
        return $category['category_name'];
    }
    public function getCategoryId($categoryName){
        $sql = 'SELECT * FROM category WHERE category_name = ?';
        $request = $this->createQuery($sql, [$categoryName]);
        $category = $request->fetch();
        return $category['id'];
    }
    public function getArticlesFromCategory($categoryId){
        $sql = 'SELECT article.id, article.title, article.content, article.date, user.name, category.category_name, date FROM article
        INNER JOIN category ON article.category_id = category.id
        INNER JOIN user ON article.author_id = user.id
        WHERE article.category_id = ?';
        $request = $this->createQuery($sql, [$categoryId]);
        $articles = [];
        foreach($request as $data){
            $id = $data['id'];
            $articles[$id] = $this->buildArticle($data);
        }
        $request->closeCursor();
        return $articles;
    }
    public function addCategory($post){
        $sql = 'INSERT INTO category(category_name, category_date) VALUES(?, NOW())';
        $this->createQuery($sql, [$post->get('category')]);
    }

    /* ------------------------------ */
    /* ----- RECUPERATION IMAGE ----- */
    /* ------------------------------ */
    public function nameDispo(){
        $sql = 'SELECT COUNT(id) AS count FROM image';
        $request = $this->createQuery($sql);
        $data = $request->fetch();
        return $data['count'] + 1;
    }
    public function addImage($image_name){
        $sql = 'INSERT INTO image (image_name) VALUES (?)';
        $this->createQuery($sql, [$image_name]);
    }
    public function lastIdImage(){
        $sql = 'SELECT MAX(id) AS max FROM image';
        $request = $this->createQuery($sql);
        $data = $request->fetch();
        return $data['max'];
    }

    /* ------------------------------ */
    /* ----- ASSEMBLEE GENERALE ----- */
    /* ------------------------------ */

    public function addAssembly($post, $time){
        $sql = 'DELETE FROM assembly';
        $this->createQuery($sql);
        $sql = 'INSERT INTO assembly(place,time,date,content) VALUES(?, ?, ?, ?)';
        $this->createQuery($sql, [
            $post->get('place'),
            $time,
            $post->get('date'),
            $post->get('content')
        ]);
    }
    public function deleteAssembly(){
        $sql = 'DELETE FROM assembly';
        $this->createQuery($sql);
    }
    public function getAssembly(){
        $sql = "SELECT * FROM assembly";
        $request = $this->createQuery($sql);
        $data = $request->fetch();
        $assembly = $this->buildAssembly($data);
        return $assembly;
    }
    public function getLastExposition(){
        $sql = 'SELECT article.id, article.title, article.content, article.date, user.name, category.category_name, image_name FROM article
        INNER JOIN category ON article.category_id = category.id
        INNER JOIN user ON article.author_id = user.id
        INNER JOIN image ON image.id = article.image_id
        WHERE category_id = 1
        ORDER BY date DESC';
        $request = $this->createQuery($sql);
        $data = $request->fetch();
        $recentExposition = $this->buildArticle($data);
        return $recentExposition;
    }
}

