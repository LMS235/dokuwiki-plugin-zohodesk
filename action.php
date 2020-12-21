<?php
/**
 * DokuWiki Plugin zohodesklink (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Florian Lamml <info@florian-lamml.de>
 */

if (!defined('DOKU_INC')) die();
class action_plugin_zohodesklink extends DokuWiki_Action_Plugin {
    /**
     * Register the eventhandlers
     */
    function register(Doku_Event_Handler $controller) {
        if($this->getConf('zohodesklink_toolbar_icon')) $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array ());
    }
	
	/**
	* Insert Toolbar
    */
    function insert_button(Doku_Event $event, $param) {
        $event->data[] = array (
            'type'    => 'format',
            'title'   => $this->getLang('toolbar_icon'),
            'icon'    => '../../plugins/zohodesklink/images/zd.gif',
			'sample'  => '123456',
			'open'    => 'zd#',
			'close'   => '',
            'block'   => false
        );
    }
}