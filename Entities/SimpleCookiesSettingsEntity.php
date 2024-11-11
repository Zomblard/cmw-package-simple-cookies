<?php

namespace CMW\Entity\SimpleCookies;

use CMW\Manager\Package\AbstractEntity;

class SimpleCookiesSettingsEntity extends AbstractEntity
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
}