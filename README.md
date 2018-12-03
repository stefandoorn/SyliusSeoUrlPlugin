# Sylius SEO URL Plugin

## Installation

1. Require plugin with composer:

    ```bash
    composer require sylius/rbac-plugin
    ```

2. Add plugin class to your `AppKernel`.

    ```php
    $bundles = [
       new \StefanDoorn\SyliusSeoUrlPlugin\SyliusSeoUrlPlugin(),
    ];
    ```

3. Import routing (to override default shop routing):

    ```yaml
    sylius_seo_url_shop:
        resource: "@SyliusSeoUrlPlugin/Resources/config/shop_routing.yml"
    ```

    Make sure it's imported after:
    
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
  
        final class ProductRepository implements ProductExistsByChannelAndSlugAwareInterface
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
 