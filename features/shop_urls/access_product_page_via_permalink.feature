@sylius_product_seo_url
Feature: Viewing a product details using permalink
    In order to see products detailed page
    As a visitor
    I want to be able to have access to product page by permalink thats SEO optimized

    Background:
        Given the store operates on a single channel in "United States"
        And the store has a product "T-Shirt Banana"

    @ui
    Scenario: Access to detailed product page using optimized permalink
        When I open page "en_US/t-shirt-banana"
        Then I should be on "T-Shirt Banana" product detailed page
        And I should see the product name "T-Shirt Banana"

    @ui
    Scenario: Access to detailed product page without optimized permalink
        When I open page "en_US/products/t-shirt-banana"
        Then the product page response status code should be 404
