<?php
namespace App\src\DAO;
use App\src\model\Article;
use Config\Alexis\Parameter;
class ArticleDAO extends DAO{
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['name']);
        $article->setCategory($row['category_name']);
        $article->setDate($row['date']);
        return $article;
    }
    public function getArticles(){
        $sql = 'SELECT article.id, article.title, article.content, user.name, category.category_name date FROM article
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
        $sql = 'SELECT id, title, content, category,user.name, category.category_name date FROM article
        INNER JOIN category ON article.category_id = category.id
        INNER JOIN user ON article.author_id = user.id;
        ORDER BY date
        WHERE id = ?';
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
}

