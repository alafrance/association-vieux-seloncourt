<?php
namespace App\src\DAO;
use App\src\model\Article;
use App\src\model\Category;
use Config\Alexis\Parameter;
class ArticleDAO extends DAO{
    private function buildArticle($row){
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['name']);
        $article->setCategory($row['category_name']);
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
    public function getArticles(){
        $sql = 'SELECT article.id, article.title, article.content, article.date, user.name, category.category_name, date FROM article
        INNER JOIN category ON article.category_id = category.id
        INNER JOIN user ON article.author_id = user.id;
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
    public function getYoursArticles($idAuthor){
        $sql = 'SELECT article.id, article.title, article.content, article.date, user.name, category.category_name, date FROM article
        INNER JOIN category ON article.category_id = category.id
        INNER JOIN user ON article.author_id = user.id;
        ORDER BY date WHERE article.author_id = ?';
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
        $sql = 'SELECT article.id, article.title, article.content, article.date, user.name, category.category_name, date FROM article
        INNER JOIN category ON article.category_id = category.id
        INNER JOIN user ON article.author_id = user.id;
        ORDER BY date
        WHERE article.id = ?';
        $request = $this->createQuery($sql, [$id]);
        $article = $request->fetch();
        $request->closeCursor();
        return  $this->buildArticle($article);
    }
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

    public function editArticle(Parameter $post, $articleId)
    {
        $sql = 'UPDATE article SET title=:title, content=:content WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'articleId' => $articleId
        ]);
    }
    public function deleteArticle($articleId)
    {
        $sql = 'DELETE FROM comment WHERE article_id = ?';
        $this->createQuery($sql, [$articleId]);
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }
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
    public function nameDispo(){
        $sql = 'SELECT COUNT(id) AS count FROM image';
        $request = $this->createQuery($sql);
        $data = $request->fetch();
        return $data['count'] + 1;
    }
    public function addImage($image_name){
        $sql = 'INSERT INTO image (name) VALUES (?)';
        $this->createQuery($sql, [$image_name]);
    }
    public function lastIdImage(){
        $sql = 'SELECT MAX(id) AS max FROM image';
        $request = $this->createQuery($sql);
        $data = $request->fetch();
        return $data['max'];
    }
}

