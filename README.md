# Sylius SEO URL Plugin

[![License](https://img.shields.io/packagist/l/stefandoorn/sylius-seo-url-plugin.svg)](https://packagist.org/packages/stefandoorn/sylius-seo-url-plugin)
[![Version](https://img.shields.io/packagist/v/stefandoorn/sylius-seo-url-plugin.svg)](https://packagist.org/packages/stefandoorn/sylius-seo-url-plugin)
[![Build Status](https://travis-ci.org/stefandoorn/SyliusSeoUrlPlugin.svg?branch=master)](https://travis-ci.org/stefandoorn/SyliusSeoUrlPlugin)

## Features

* Remove `/taxons` from taxon URLs

   1. Before: `https://localhost/en_US/taxons/t-shirts`
   2. After: `https://localhost/en_US/t-shirts`

* Remove `/products` from product URLs
   
   1. Before: `https://localhost/en_US/products/t-shirt-banana`
   2. After: `https://localhost/en_US/t-shirt-banana`

Combined with [disabling localised URLs](https://docs.sylius.com/en/latest/cookbook/shop/disabling-localised-urls.html), URLs can even be shorter.

## Installation

1. Require plugin with composer:

    ```bash
    composer require stefandoorn/sylius-seo-url-plugin
    ```

2. Add plugin class to your `AppKernel`.

    ```php
    $bundles = [
       new \StefanDoorn\SyliusSeoUrlPlugin\SyliusSeoUrlPlugin(),
    ];
    ```
    
    or to your `bundles.php`:
    
    ```php
    return [
       // ...
       StefanDoorn\SyliusSeoUrlPlugin\SyliusSeoUrlPlugin::class => ['all' => true],
    ];
    ```

3. Import routing (to override default shop routing):

    ```yaml
    sylius_seo_url_shop:
        prefix: /{_locale}
        resource: "@SyliusSeoUrlPlugin/Resources/config/shop_routing.yml"
    ```

    Make sure it's imported after (because it overrides default Sylius routes):
    
    ```yaml
    sylius_shop:
        resource: "@SyliusShopBundle/Resources/config/routing.yml"
    ```

4. Import configuration:

    ```yaml
    - { resource: "@SyliusSeoUrlPlugin/Resources/config/config.yml" }
    ```
    
5. Import repository method:

   The default `findOneByChannelAndSlug` for products is slow when used in a loop, therefore:

   1. Use the trait in your own Product Repository & add interface:
        
        ```php
        use StefanDoorn\SyliusSeoUrlPlugin\Repository\ProductExistsByChannelAndSlug;
        use StefanDoorn\SyliusSeoUrlPlugin\Repository\ProductExistsByChannelAndSlugAwareInterface;
        use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;
  
        final class ProductRepository extends BaseProductRepository implements ProductExistsByChannelAndSlugAwareInterface
        {
            use ProductExistsByChannelAndSlug;
        }
        ```
        
   2. Or use the Product repository as provided, add to your config:
   
        ```yaml
        sylius_product:
            resources:
                product:
                    classes:
                        repository: StefanDoorn\SyliusSeoUrlPlugin\Repository\ProductRepository
        ``` 
