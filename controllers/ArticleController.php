<?php

class ArticleController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function article()
    {
        $text = "Generujemy artykuł z bazy danych i przekazujemy do rendera. Najlepiej pobrac jeszcze 
        dodatkowego geta ktory wskazuje na konkretny artykul z bazy.";
        $this->render('article', [ 'text' => $text]);
    }

}