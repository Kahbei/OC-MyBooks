<?php

namespace MicroCMS\DAO;

use Doctrine\DBAL\Connection;
use MicroCMS\Domain\Comment;

class CommentDAO extends DAO
{
	/**
	 * @var \MicroCMS\DAO\ArticleDAO
	 */
	private $articleDAO;

	public function setArticleDAO(ArticleDAO $articleDAO){
		$this->articleDAO = $articleDAO;
	}

	/**
	 * Return a list of all comments for an article, sorted by date (desc).
	 * @param  integer $articleId The article id.
	 * @return array 			  A list of all comments for the article.
	 */
	/*public function findAllByArticle($articleId){
		$article = $this->articleDAO->find($articleId);

		$sql = "SELECT com_id, com_content, com_author FROM t_comment WHERE art_id=? ORDER BY com_id";
        $result = $this->getDb()->fetchAll($sql, array($articleId));
        
        // Convert query result to an array of domain objects
        $comments = array();
        foreach ($result as $row) {
            $comId = $row['com_id'];
            $comment = $this->buildDomainObject($row);
            $comment->setArticle($article);
            $comments[$comId] = $comment;
        }

        return $comments;
	}*/

	/**
	 * Create a Comment object based on a DB row.
	 * @param  array  $row 				The DB row containing Comment data.
	 * @return \MicroCMS\Domain\Comment
	 */
	protected function buildDomainObject(array $row){
		$comment = new Comment();
		
        $comment->setId($row['com_id']);
        $comment->setAuthor($row['com_author']);
        $comment->setContent($row['com_content']);

        if(array_key_exists('book_id', $row)){
        	$articleId = $row['book_id'];
        	$article = $this->articleDAO->find($articleId);
        	$comment->setArticle($article);
        }

        return $comment;
	}
}