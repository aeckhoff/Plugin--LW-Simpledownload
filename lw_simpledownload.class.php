<?php

/**************************************************************************
*  Copyright notice
*
*  Copyright 2011-2012 Logic Works GmbH
*
*  Licensed under the Apache License, Version 2.0 (the "License");
*  you may not use this file except in compliance with the License.
*  You may obtain a copy of the License at
*
*  http://www.apache.org/licenses/LICENSE-2.0
*  
*  Unless required by applicable law or agreed to in writing, software
*  distributed under the License is distributed on an "AS IS" BASIS,
*  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
*  See the License for the specific language governing permissions and
*  limitations under the License.
*  
***************************************************************************/

#doc
#	classname:	lw_simpledownload
#	scope:		PUBLIC
#
#/doc

class lw_simpledownload extends lw_plugin
{
	private $pageId = 0;
	private $keyword = '';

	public function __construct ()
	{
		$reg 	 			= lw_registry::getInstance();
		
		$this->config		= $reg->getEntry('config');
		$this->db			= $reg->getEntry('db');
		$this->repository	= $reg->getEntry('repository');
		$this->request		= $reg->getEntry('request');
		
		$this->pageId = $this->request->getIndex();
		$this->keyword = 'lw_download';
		$this->fileExtension = '';
	}
	
	public function buildPageOutput()
	{
		return $this->buildDownloadList();
	}
	
	private function buildDownloadList()
	{
		if (isset($this->params['source'])) $this->pageId = $this->params['source'];
		if (isset($this->params['keyword'])) $this->keyword = $this->params['keyword'];
		if (isset($this->params['filetype'])) $this->fileExtension = $this->params['filetype'];
		
		$entries = $this->getEntries($this->pageId, $this->keyword, $this->fileExtension);
		
		if (count($entries) == 0) {
			return "<!-- no files -->";
		}
		
		$view = new lw_view(dirname(__FILE__).'/views/list.phtml');
		$view->entries = $entries;
		return $view->render();
	}
	
	private function getEntries($pageId, $keyword, $fileExtension)
	{
		$fileExtensionWhere = "";
		if (strlen($fileExtension) != 0) {
			$fileExtensionWhere = "AND filetype = :extension ";
		} 
		
		$this->db->setStatement("SELECT * FROM t:lw_items WHERE itemtype = 'file' AND keywords LIKE '%".$keyword."%' AND page_id = :id AND (intranet IS NULL OR intranet < '1') ".$fileExtensionWhere." ORDER BY seq ASC");
		$this->db->bindParameter('id', 'i', $pageId);
		$this->db->bindParameter('extension', 's', $fileExtension);
		$results = $this->db->select($sql);
		$entries = array();
		
		foreach($results as $result) {
			$url = $this->config['url']['client'].'lw_resource/datapool/_items/item_'.$result['id'].'/'.$result['filename'].'.'.$result['filetype'];
			$entry = array(
				'filetype_styleclass' => 'lw_simpledownload_filetype_'.$result['filetype'],
				'url' => $url,
				'title' => $result['description'],
				'filesize_readable' => sprintf("%01.2f", ($result['filesize']/1024)).' KByte',
			);
			$entries[] = $entry;
		}
		return $entries;
	}
}
