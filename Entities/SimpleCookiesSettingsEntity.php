<?php

namespace CMW\Entity\Simplecookies;

use JsonException;
use RuntimeException;
use function json_decode;
use function json_encode;
use const JSON_THROW_ON_ERROR;

class SimpleCookiesSettingsEntity
{
    private string $bannerTitle;
    private string $bannerText;
    private string $pageContent;

    /**
     * @param string $bannerTitle
     * @param string $bannerText
     * @param string $pageContent
     */
    public function __construct(string $bannerTitle, string $bannerText, string $pageContent)
    {
        $this->bannerTitle = $bannerTitle;
        $this->bannerText = $bannerText;
        $this->pageContent = $pageContent;
    }

    /**
     * @return string
     */
    public function getBannerTitle(): string
    {
        return $this->bannerTitle;
    }

    /**
     * @return string
     */
    public function getBannerText(): string
    {
        return $this->bannerText;
    }

    /**
     * @return string
     */
    public function getPageContent(): string
    {
        return $this->pageContent;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        $data = [
            'banner_title' => $this->bannerTitle,
            'banner_text' => $this->bannerText,
            'page_content' => $this->pageContent,
        ];

        try {
            return json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new \RuntimeException("Can't convert data to json. " . $e->getMessage());
        }
    }

    /**
     * @param string $data
     * @return self
     */
    public static function fromJson(string $data): self
    {
        try {
            $json = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException("Can't convert json to data. " . $e->getMessage());
        }

        return new self(
            $json['banner_title'],
            $json['banner_text'],
            $json['page_content'],
        );
    }

    /**
     * @param array $data
     * @return self
     */
    public static function toEntity(array $data): self
    {
        return new self(
            $data['banner_title'],
            $data['banner_text'],
            $data['page_content'],
        );
    }
}