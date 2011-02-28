<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 CERDAN Yohann <cerdanyohann@yahoo.fr>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * This class provides a report displaying a list of informations
 * Code inspired by EXT:dam/lib/class.tx_dam_svlist.php by Rene Fritz
 *
 * @author        CERDAN Yohann <cerdanyohann@yahoo.fr>
 * @package        TYPO3
 */

class tx_additionalreports_eid implements tx_reports_Report {

    /**
     * Back-reference to the calling reports module
     *
     * @var    tx_reports_Module    $reportObject
     */

    protected $reportObject;

    /**
     * Constructor for class tx_additionalreports_eid
     *
     * @param    tx_reports_Module    Back-reference to the calling reports module
     */

    public function __construct(tx_reports_Module $reportObject) {
        $this->reportObject = $reportObject;
        $GLOBALS['LANG']->includeLLFile('EXT:additional_reports/locallang.xml');
    }

    /**
     * This method renders the report
     *
     * @return    string    The status report as HTML
     */

    public function getReport() {
        $content = '';
        $this->reportObject->doc->getPageRenderer()->addCssFile(t3lib_extMgm::extRelPath('additional_reports') . 'tx_additionalreports.css');
        // $content .= '<p class="help">' . $GLOBALS['LANG']->getLL('eid_description') . '</p>';
        $content .= $this->displayEID();
        return $content;
    }

    protected function displayEID() {
        $content = '';
        $items = $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include'];
        $content .= '<table cellspacing="1" cellpadding="2" border="0" class="tx_sv_reportlist typo3-dblist">';
        $content .= '<tr class="t3-row-header"><td colspan="7">';
        $content .= $GLOBALS['LANG']->getLL('eid_description');
        $content .= '</td></tr>';
        $content .= '<tr class="c-headLine">';
        $content .= '<td class="cell"></td>';
        $content .= '<td class="cell">' . $GLOBALS['LANG']->getLL('extension') . '</td>';
        $content .= '<td class="cell">' . $GLOBALS['LANG']->getLL('name') . '</td>';
        $content .= '<td class="cell">' . $GLOBALS['LANG']->getLL('path') . '</td>';
        $content .= '</tr>';
        foreach ($items as $itemKey => $itemValue) {
            preg_match('/EXT:(.*?)\//', $itemValue, $ext);
            $content .= '<tr class="db_list_normal">';
            $content .= '<td class="col-icon"><img src="' . t3lib_div::getIndpEnv('TYPO3_REQUEST_DIR') . t3lib_extMgm::extRelPath($ext[1]) . 'ext_icon.gif"/></td>';
            $content .= '<td class="cell">' . $ext[1] . '</td>';
            $content .= '<td class="cell">' . $itemKey . '</td>';
            $content .= '<td class="cell">' . $itemValue . '</td>';
            $content .= '</tr>';

        }
        $content .= '</table>';
        return $content;
    }

}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/additional_reports/reports_eid/class.tx_additionalreports_eid.php']) {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/additional_reports/reports_eid/class.tx_additionalreports_eid.php']);
}

?>