<?php

namespace MicroCMS\DAO;

use Doctrine\DBAL\Connection;
use MicroCMS\Domain\Article;

class ArticleDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "SELECT * FROM book ORDER BY book_id DESC";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $articleId = $row['book_id'];
            $articles[$articleId] = $this->buildDomainObject($row);
        }
        return $articles;
    }

    /**
     * Creates an Article object based on a DB row.
     * @param array $row The DB row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject(array $row) {
        $article = new Article();
        $article->setId($row['book_id']);
        $article->setTitle($row['book_title']);
        $article->setContent($row['book_summary']);
        return $article;
    }

    /**
     * Returns an article matching the supplied id
     * @param integer $id
     * @return \MicroCMS\Domain\Article | throws an exception if no matching article is found
     */
    public function find($id){
        $sql = "SELECT * FROM book WHERE book_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else{
            throw new \Exception("No article matching id ".$id);
            
        }
    }
}