<?php
/**
 * DokuWiki Plugin zohodesklink (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Florian Lamml <info@florian-lamml.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_zohodesklink extends DokuWiki_Syntax_Plugin {

    public function getType() {
        return 'substition';
    }
	
    public function getPType() {
        return 'normal';
    }

    public function getSort() {
        return 256;
    }
	
	# responds to everything starts with ZD# or zd# followed by  1 - 10 numbers
    public function connectTo($mode) {
	    $this->Lexer->addSpecialPattern('ZD#[0-9]{4,10}',$mode,'plugin_zohodesklink');
		$this->Lexer->addSpecialPattern('zd#[0-9]{4,10}',$mode,'plugin_zohodesklink');
    }

    public function handle($match, $state, $pos, Doku_Handler $handler){
        $data = array($match, $state);

        return $data;
    }
		
	public function render($mode, Doku_Renderer $renderer, $data) {
		# Dokuwiki Renderer
        if($mode == 'xhtml'){
            $zohodesk = explode('#', $data[0]);
            $url = $this->getConf('zohodeskurl')."/".$zohodesk[1];
                $renderer->doc .= "<a href=\"".$url."\" target=\"_blank\"><img src=\"".DOKU_BASE."lib/plugins/zohodesklink/images/zd.gif\" alt=\"".$this->getLang('url_alt')." ".$zohodesk[1]."\"> ".$zohodesk[1]."</a>";
            return true;
        }
		# ODT Export Renderer
		elseif ($mode == 'odt'){
			if (!class_exists('ODTDocument')) {
				// support of "old" dokuwiki-plugin-odt
				$zohodesk = explode('#', $data[0]);
                $renderer->doc .= "$zohodesk[1]";
				return true;
			} else {
				// support of redesign dokuwiki-plugin-odt
				$zohodesk = explode('#', $data[0]);
                $renderer->cdata ("$zohodesk[1]");
				return true;
			}
        }
        return false;
    }
}
