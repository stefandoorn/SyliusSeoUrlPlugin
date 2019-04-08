@sylius_product_seo_url
Feature: Viewing a taxon details using permalink
    In order to see products list page
    As a visitor
    I want to be able to have access to taxon page by permalink thats SEO optimized

    Background:
        Given the store operates on a single channel in "United States"
        And the store classifies its products as "T-Shirts"
        And the store has a product "T-Shirt Banana"
        And this product belongs to "T-Shirts"

    @ui
    Scenario: Access to taxon page using optimized permalink
        When I open page "en_US/t-shirts"
        Then I should see the product "T-Shirt Banana"

    @ui
    Scenario: Access to taxon page without optimized permalink
        When I open page "en_US/taxons/t-shirts"
        Then the taxon page response status code should be 404
