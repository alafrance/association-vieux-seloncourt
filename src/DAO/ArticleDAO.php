<?php
namespace App\src\DAO;
use App\src\model\Article;
use App\src\model\Category;
use Config\Alexis\Parameter;
class ArticleDAO extends DAO{
    private function buildObject($row){
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
            $articles[$id] = $this->buildObject($row);
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
        return  $this->buildObject($article);
    }
    public function addArticle(Parameter $post, $image)
    {
        $sql = 'INSERT INTO article (title, content, numberChapter, date, image) VALUES (?, ?, ?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $post->get('numberChapter'), $image]);
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
        INNER JOIN user ON article.author_id = user.id;
        ORDER BY date
        WHERE category.id = ?';
        $request = $this->createQuery($sql, [$categoryId]);
        $articles = [];
        foreach($request as $data){
            $id = $data['id'];
            $articles[$id] = $this->buildObject($data);
        }
        $request->closeCursor();
        return $articles;
    }
}

