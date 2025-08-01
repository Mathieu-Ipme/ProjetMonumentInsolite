<?php

namespace App\Factory;

use App\Entity\Article;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Article>
 */
final class ArticleFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Article::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'buldingName' => self::faker()->text(255),
            'city' => self::faker()->text(255),
//            'country' => CountryFactory::new(),
            'country' => CountryFactory::random(),
            'description' => self::faker()->text(600),
            'image_path' => self::faker()->url(),
//            'owner' => UserFactory::new(),
            'owner' => UserFactory::random(),
            // attention pb a venir
            'slug' => self::faker()->text(),
            'status' => self::faker()->numberBetween(1, 500),
            'title' => self::faker()-> words(3, true),
            'publishedAt' => self::faker()->dateTime(),
            'genres' => GenreFactory::randomRange(1, 3)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Article $article): void {})
        ;
    }
}
