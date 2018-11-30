<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Services;


/**
 * This class transform simple video url from dailymotion or youtube to an embed video link usable with iframe HTML tag.
 * Class EmbedURL
 * @package App\Services
 */
class EmbedURL
{

    /**
     * @var string
     */
    private $youtubeREGEX;

    /**
     * @var string
     */
    private $dailymotionREGEX;

    /**
     * @var string
     */
    private $youtube;

    /**
     * @var string
     */
    private $dailymotion;

    /**
     * @var null
     */
    private $falseUrl = null;

    /**
     * @return string
     */
    /**
     * @var
     */
    private $embedUrl;

    /**
     * @return string
     */
    public function getEmbedUrl(): string
    {
        return $this->embedUrl;
    }



    public function getYoutubeREGEX(): string
    {
        return $this->youtubeREGEX;
    }

    /**
     * @param string $youtubeREGEX
     */
    public function setYoutubeREGEX(string $youtubeREGEX): void
    {
        $this->youtubeREGEX = $youtubeREGEX;
    }

    /**
     * @return string
     */
    public function getDailymotionREGEX(): string
    {
        return $this->dailymotionREGEX;
    }

    /**
     * @param string $dailymotionREGEX
     */
    public function setDailymotionREGEX(string $dailymotionREGEX): void
    {
        $this->dailymotionREGEX = $dailymotionREGEX;
    }

    /**
     * @return string
     */
    public function getYoutube(): string
    {
        return $this->youtube;
    }

    /**
     * @param string $youtube
     */
    public function setYoutube(string $youtube): void
    {
        $this->youtube = $youtube;
    }

    /**
     * @return string
     */
    public function getDailymotion(): string
    {
        return $this->dailymotion;
    }

    /**
     * @param string $dailymotion
     */
    public function setDailymotion(string $dailymotion): void
    {
        $this->dailymotion = $dailymotion;
    }

    /**
     * @return mixed
     */
    public function getFalseUrl()
    {
        return $this->falseUrl;
    }

    /**
     * @param mixed $falseUrl
     */
    public function setFalseUrl($falseUrl): void
    {
        $this->falseUrl = $falseUrl;
    }





    /**
     * EmbedURL constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->youtubeREGEX = '/youtube/';
        $this->dailymotionREGEX = '/dailymotion/';
        return $this->embedUrl = $this->embed($url);

    }

    /**
     * @param $url
     * @return bool|mixed
     */
    public function embed($url)
    {
        $this->youtube = preg_match($this->youtubeREGEX, $url);
        $this->dailymotion = preg_match($this->dailymotionREGEX, $url);

        if ($url && $this->youtube){

            $embedUrl = str_replace("watch?v=", "embed/",$url);
            return $embedUrl;

        }elseif ($url && $this->dailymotion){

            $embedUrl = str_replace("video", "embed/video",$url);
            return $embedUrl;

        }else{
            return $this->falseUrl = false;

        }
        return true;

    }


}