<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //3author faker
        for ($i=1; $i <= \mt_rand(1,5) ; $i++){
            $author = new Author();
            $author->setName("elie_n:$i");
            $manager->persist($author);

            $category = new Category();
            $category->setNomcat("Nature : $i");
            $manager->persist($category);


            //4 et 6 article
            for ($j=1; $j <= \mt_rand(4,6) ;$j++ ){
                $article = new Article();
                $article->setTitle("article_n:$j")
                        ->setDescription("I’m finally caught up with the Naruto manga! Reading through all those 
chapters along the way it dawned on me that “out of context” blogs work 
better with humor/gag series, that may have been more the case with the 
beginning of Naruto, but the tone definitely shifted in the second part.
 That said I didnt find as much out-of-context hilarity as I’d hoped, 
but I’m loading up the queue with what I’ve got (Submissions 
encouraged $j")
                    ->setAuthor($author)
                    ->setCategory($category);

                $manager->persist($article);

                //commentaire de quelque ligne
                for ($k=1 ; $k <= \mt_rand(4,5) ; $k++){
                    $comment = new Comment();
                    $now = new \DateTime('now');
                    $comment->setTextcom("Wou, Naruto is the one best stronger! $k")
                             ->setPersocom("Fitia_n:$k")
                             ->setDatecom($now)
                             ->setArticle($article);
                    $manager->persist($comment);

                }

            }

        }

        $manager->flush();
    }
}
