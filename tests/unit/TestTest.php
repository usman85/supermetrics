<?php

declare(strict_types = 1);

namespace Tests\unit;

use PHPUnit\Framework\TestCase;
use SocialPost\Dto\SocialPostTo;
/**
 * Class ATestTest
 *
 * @package Tests\unit
 */
class TestTest extends TestCase
{
    /**
     * @test
     */
    public function testNothing(): void
    {
        $this->assertTrue(true);
    }

    public function testPostCount(): void
    {
        $postData=array();
       
        $postCount = count($postData);

        $string = file_get_contents("./tests/data/social-posts-response.json");
        $json = json_decode($string, true);                        
        $postData = isset($json['data']['posts']) ? $json['data']['posts'] : array();
        $postCount = count($postData);
        //echo "Post count: ".$postCount."\n";
        $this->assertEquals(4, $postCount, "Number of posts should be = 3");
    }


    public function testAveraegPost(): void
    {
        $postData=array();
        $users = array();

        $string = file_get_contents("./tests/data/social-posts-response.json");
        $json = json_decode($string, true);                
        $postData = isset($json['data']['posts']) ? $json['data']['posts'] : array();
        $postCount = count($postData);

        if(!empty($postData)){
            foreach($postData as $post){
                $users[$post['from_id']] = $post['from_name'];
            }                        
        }
        $userCount = count($users);
        //echo "Post count: ".$postCount." userCount:".$userCount."\n";        
        $value = $userCount > 0 ? $postCount / $userCount : 0;                

        $this->assertEquals(1, $value, "Number of posts should be = 1.5");
    }
}
