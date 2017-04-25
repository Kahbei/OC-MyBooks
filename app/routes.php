<?php

// Home page
$app->get('/', function () use ($app) {
    $articles = $app['dao.article']->findAll();

    return $app['twig']->render('index.html.twig', array('articles' => $articles, ));
})->bind('home');

$app->get('/book/{id}', function($id) use ($app){
	$article = $app['dao.article']->find($id);
	//$comments = $app['dao.comment']->findAllByArticle($id);

	return $app['twig']->render('book.html.twig', array('article' => $article, /*'comments' => $comments*/));
})->bind('article');