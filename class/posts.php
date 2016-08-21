<?php
	class posts 
	{
		private $title;
		private $content;
		private $date;
		private $recID;

		public function posts($_title, $_content, $_date, $_recID=0) 
		{
			$this->title = $_title;
			$this->content = $_content;
			$this->date = $_date;
			$this->recID = $_recID;

		}

		public function setTitle($_title)
		{
			$this->title = $_title;
		}
		public function setContent($_content)
		{
			$this->content = $_content;
		}
		public function setDate($_date)
		{
			$this->date = $_date;
		}
		public function setRecID($_recID)
		{
			$this->recID = $_recID;
		}
		public function getTitle()
		{
			return $this->title;
		}
		public function getContent()
		{
			return $this->content;
		}
		public function getDate()
		{
			return $this->date;
		}
		public function getRecID()
		{
			return $this->recID;
		}
	}
?>