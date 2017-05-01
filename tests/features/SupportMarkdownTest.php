<?php

class SupportMarkdownTest extends TestCase
{

    public function test_the_post_content_support_markdown()
    {
        $importantText = 'Un texto muy importante';

        // Create a Post
        $post = $this->createPost([
            // Introduce the content into a attribute and we put in bold variable $importantText with **
            'content' => "La primera parte del texto. **$importantText**. La última parte del texto"
        ]);

        // Visit the url of the post
        // We see that exist an attribute 'strong' involving to the name $importantText
        $this->visit($post->url)
            ->seeInElement('strong', $importantText);
    }

    /**
     * Check an attack of Javascript
     */
    function test_xss_attack()
    {
        // We create a tag of javascript
        $xssAttack = "<script>alert('Malicious JS!')</script>";

        // We create one post with the tag above
        $post = $this->createPost([
            'content' => "`$xssAttack`. Text Normal."
        ]);

        // Visit the page of the post and i can´t see the tag of javascript.
        $this->visit($post->url)
            ->dontSee($xssAttack)
            ->seeText('Text Normal')
            ->seeText($xssAttack);
    }

    /**
     * Check an attack of Html
     */
    function test_xss_attack_with_html()
    {
        // We create a tab or html
        $xssAttack = "<img src='img.jpg'>";

        // We create one post with the tag above
        $post = $this->createPost([
            'content' => "$xssAttack. Text Normal."
        ]);

        // Visit the page of the post and I can´t see the tag of html.
        $this->visit($post->url)
            ->dontSee($xssAttack);
    }

}