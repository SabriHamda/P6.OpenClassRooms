<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Tests;


use PHPUnit\Framework\TestCase;
use App\Services\EmbedURL;

/**
 * Class EmbedUrlTest
 * @package App\Tests
 */
class EmbedUrlTest extends TestCase
{
    /**
     * @var string
     */
    private $youtubeURL;

    /**
     * @var string
     */
    private $dailymotionURL;

    /**
     * @var sring
     */
    private $falseURL;

    /**
     * @var array
     */
    private $urls = [];

    /**
     * @var array
     */
    private $result = [];

    /**
     *
     */
    protected function setUp()
    {
        $this->youtubeURL = 'https://www.youtube.com/watch?v=YFRl91m6WS8';
        $this->dailymotionURL = 'https://www.dailymotion.com/video/xxxu60';
        $this->falseURL = 'https://www.dailymoti.com/vide/xxxu60';
        $this->urls = [$this->youtubeURL,$this->dailymotionURL,$this->falseURL];
    }

    /**
     *
     */
    public function testURL()
    {
        foreach ($this->urls as $url){

            $embed = new EmbedURL($url);
            $this->result [] = $embed;

        }
       //test with youtube URL
        // 1) - youtube URL
        // 2) - dailymotion URL
        // 3) - fake
        $this->assertEquals($this->result[0]->getYoutube(),1);
        $this->assertEquals($this->result[1]->getYoutube(),0);
        $this->assertEquals($this->result[2]->getYoutube(),0);

        //Test with dailymotion url
        $this->assertEquals($this->result[0]->getDailymotion(),0);
        $this->assertEquals($this->result[1]->getDailymotion(),1);
        $this->assertEquals($this->result[2]->getDailymotion(),0);

        //Test with false url
        $this->assertEquals($this->result[0]->getFalseUrl(),0);
        $this->assertEquals($this->result[1]->getFalseUrl(),0);
        $this->assertEquals($this->result[2]->getFalseUrl(),0);

    }
}
