<?php
/*
 * Haha Pagination
 * Created May 21, 2014
 * Location: https://github.com/soachishti/HahaPagination
 * 
 * Copyright (c) 2014, SOAChishti (soachishti@outlook.com).
 * License: Do anything you want.
 */

class Pagination {
	
	public $setTotalData;
	public $perPage;
	public $dataPerPage;
	public $totalPage;
	public $currentPage;
	
	function __construct($totalData,$perPage,$GETpath) {
		$this->totalData = $totalData;
		$this->perPage = $perPage;
		$this->dataPerPage = $this->dataPerPage($totalData, $perPage);
		$this->totalPage = count($this->dataPerPage);
		$this->GETpath = $GETpath;
		
		if($this->currentPage > $this->totalPage)
			$this->currentPage = $this->totalPage;
				
		if ($this->currentPage < 1)
			$this->currentPage = 1;		
	}
	
	function setPage($currentPage) {
		if($currentPage > $this->totalPage)
			$this->currentPage = $this->totalPage;	
		elseif ($currentPage < 1)
			$this->currentPage = 1;
		else	
			$this->currentPage = $currentPage;
	}
	

	function getDataLimit() {
		$returnVar['start'] = (int)$this->dataPerPage[1] * (int)($this->currentPage - 1);
		$returnVar['end'] = (int)$returnVar['start'] + (int)$this->perPage;
		if($returnVar['end'] > $this->totalData)
		{
			$returnVar['end'] = $this->totalData;
		}
		return $returnVar;
	}
	
	function dataPerPage($totalData,$perPage) {
		$tempArray = Array();
		for($i=0,$count=1;$i < $totalData;$count++)
		{
			$i += $perPage;
			if($i > $totalData)
			{
				$i -= $perPage;
				$tempArray[$count] = $totalData-$i;
				break;
			}
			else
			{
				$tempArray[$count] = $perPage;
			}
		}
		return $tempArray;
	}

	function generateNaviModern($totalPagesToShow) {
		$currentPage = $this->currentPage;
		print '<div id="pageNavi">';
					
			$selected = $currentPage;
			if($$totalPagesToShow % 2 == 0) {
				#if $totalPagesToShow is even so change it to odd
				$totalPagesToShow++;
				}
			$midPoint = floor($totalPagesToShow / 2);
				if($currentPage-$midPoint > 2) {
					$currentPage -= $midPoint; 
				print '<a href="?'.$this->GETpath.'=' . ($selected-1) . '">Previous</a>';
				print '<a href="?'.$this->GETpath.'=' . (1) . '">' . (1) . '</a>';
				print "<span>&hellip;</span>";
			}
			else {
				$currentPage = 1;
			}
			
			for($i=$currentPage,$p=1;$p<=$totalPagesToShow;$i++,$p++) {
				if($i <= $this->totalPage) {
					if($selected == $i)
						print '<span id="selected">' . $i . "</span>";
					else	
						print '<a href="?'.$this->GETpath.'=' . $i. '">' . $i . "</a>";
				}
			}
			if($i <= $this->totalPage) {
				print "<span>&hellip;</span>";
				print '<a href="?'.$this->GETpath.'=' . $this->totalPage . '">' . $this->totalPage . "</a>";
				print '<a href="?'.$this->GETpath.'=' . ($selected+1) . '">Next</a>';
			}
		print "</div>";
	}

	function generateNaviClassic()
	{
		print '<div id="pageNavi">';
		if($this->currentPage < 1) {
			print '<a href="?'.$this->GETpath.'=' . 1 . '">First</a>';
		}
		elseif($this->currentPage == 1) {
			print '<a href="?'.$this->GETpath.'=' . ($this->currentPage + 1) . '">Next</a>';
		}
		elseif ($this->currentPage > 1 && $this->currentPage < $this->totalPage) {
			print '<a id="prev" href="?'.$this->GETpath.'=' . ($this->currentPage - 1) . '">Previous</a>';
			print '<a id="next" href="?'.$this->GETpath.'=' . ($this->currentPage + 1) . '">Next</a>';
		}
		elseif ($this->currentPage == $this->totalPage) {
			print '<a id="prev" href="?'.$this->GETpath.'=' . ($this->currentPage - 1) . '">Previous</a>';
		}
		elseif ($this->currentPage > $this->totalPage) {
			print '<a id="prev" href="?'.$this->GETpath.'=' . $this->totalPage . '">Last Page</a>';
		}
		print '</div>';
	}
}
?>