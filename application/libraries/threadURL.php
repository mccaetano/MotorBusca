<?php
class ThreadURL extends Thread {
	private $url;
	private $timer;
	private $loop;
	private $ci;
	
	 public function __construct($config = array()) {
        $this->ci = &get_instance();
	}
	
	function ThreadURL($url = FALSE, $timer = 0, $loop = FALSE) {		
		$this->url = $url;
		$this->timer = $timer;
		$this->loop = $loop;
		
	}
	
	public function run() {
		while ($this->loop) {
			redirect($this->url);
			sleep($this->timer);
		}
	}
}