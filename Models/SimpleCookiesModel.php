<?php

namespace CMW\Model\SimpleCookies;

use CMW\Entity\SimpleCookies\SimpleCookiesSettingsEntity;
use CMW\Manager\Cache\SimpleCacheManager;
use CMW\Manager\Database\DatabaseManager;
use CMW\Manager\Package\AbstractModel;
use function is_null;

class SimpleCookiesModel extends AbstractModel
{
    public function getSettings(bool $ignoreCache = false): ?SimpleCookiesSettingsEntity
    {
        if (!$ignoreCache) {
            $cacheData = SimpleCacheManager::getCache('settings', 'SimpleCookies');

            if (!is_null($cacheData)) {
                return SimpleCookiesSettingsEntity::fromJson($cacheData);
            }
        }

        $sql = "SELECT * FROM cmw_simplecookies_settings";
        $db = DatabaseManager::getInstance();

        $req = $db->query($sql);

        if (!$req) {
            return null;
        }

        $res = $req->fetch();

        if (!$res) {
            return null;
        }

        return SimpleCookiesSettingsEntity::toEntity($res);
    }

    /**
     * @param string $bannerTitle
     * @param string $bannerText
     * @param string $pageContent
     * @return \CMW\Entity\SimpleCookies\SimpleCookiesSettingsEntity|null
     */
    public function updateSettings(string $bannerTitle, string $bannerText, string $pageContent): ?SimpleCookiesSettingsEntity
    {
        $data = [
            'banner_title' => $bannerTitle,
            'banner_text' => $bannerText,
            'page_content' => $pageContent,
        ];

        $sql = "UPDATE cmw_simplecookies_settings 
                SET banner_title = :banner_title, 
                    banner_text = :banner_text, 
                    page_content = :page_content";
        $db = DatabaseManager::getInstance();

        $req = $db->prepare($sql);

        if ($req->execute($data)) {
            return $this->getSettings(ignoreCache: true);
        }

        return null;
    }
}