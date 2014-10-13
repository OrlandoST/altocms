<?php
/*---------------------------------------------------------------------------
* @Project: Alto CMS
* @Project URI: http://altocms.com
* @Description: Advanced Community Engine
* @Copyright: Alto CMS Team
* @License: GNU GPL v2 & MIT
*----------------------------------------------------------------------------
* Based on
*   LiveStreet Engine Social Networking by Mzhelskiy Maxim
*   Site: www.livestreet.ru
*   E-mail: rus.engine@gmail.com
*----------------------------------------------------------------------------
*/

/**
 * @package engine.modules
 * @since 1.0
 */
class ModuleSkin extends Module {

    const SKIN_XML_FILE = 'skin.xml';

    public function Init() {

    }

    /**
     * Load skin manifest from XML
     *
     * @param string $sSkin
     * @param string $sSkinDir
     *
     * @return mixed
     */
    public function GetSkinManifest($sSkin, $sSkinDir = null) {

        if (!$sSkinDir) {
            $sSkinDir = Config::Get('path.skins.dir') . $sSkin . '/';
        }

        if (F::File_Exists($sSkinDir . '/' . self::SKIN_XML_FILE)) {
            $sXmlFile = $sSkinDir . '/' . self::SKIN_XML_FILE;
        } else {
            $sXmlFile = $sSkinDir . '/settings/' . self::SKIN_XML_FILE;
        }
        if ($sXml = F::File_GetContents($sXmlFile)) {
            return $sXml;
        }
        return null;
    }

    /**
     * Returns array of skin enities
     *
     * @param   array   $aFilter    - array('type' => 'site'|'admin')
     * @return  array(ModuleSkin_EntitySkin)
     */
    public function GetSkinsList($aFilter = array()) {

        $aSkinList = array();
        if (isset($aFilter['dir'])) {
            $sSkinsDir = $aFilter['dir'];
        } else {
            $sSkinsDir = Config::Get('path.skins.dir');
        }
        if (isset($aFilter['name'])) {
            $sPattern = $sSkinsDir . $aFilter['name'];
        } else {
            $sPattern = $sSkinsDir . '*';
        }
        $aList = glob($sPattern, GLOB_ONLYDIR);
        if ($aList) {
            if (!isset($aFilter['type'])) $aFilter['type'] = '';
            $sActiveSkin = Config::Get('view.skin', Config::DEFAULT_CONFIG_ROOT);
            foreach ($aList as $sSkinDir) {
                $sSkin = basename($sSkinDir);
                $aData = array(
                    'id' => $sSkin,
                    'dir' => $sSkinDir,
                );
                $oSkinEntity = Engine::GetEntity('Skin', $aData);
                if (!$aFilter['type'] || $aFilter['type'] == $oSkinEntity->GetType()) {
                    $oSkinEntity->SetIsActive($oSkinEntity->GetId() == $sActiveSkin);
                    $aSkinList[$oSkinEntity->GetId()] = $oSkinEntity;
                }
            }
        }
        return $aSkinList;
    }

    /**
     * Returns array of skin names
     *
     * @param   string|null $sType
     * @return  array(string)
     */
    public function GetSkinsArray($sType = null) {

        if ($sType) {
            $aFilter = array('type' => $sType);
        } else {
            $aFilter = array();
        }
        $aSkins = $this->GetSkinsList($aFilter);
        return array_keys($aSkins);
    }

    /**
     * Returns skin entity
     *
     * @param $sName
     *
     * @return ModuleSkin_EntitySkin
     */
    public function GetSkin($sName) {

        $aSkins = $this->GetSkinsList(array('name' => $sName));
        if (isset($aSkins[$sName])) {
            return $aSkins[$sName];
        }
    }

}

// EOF