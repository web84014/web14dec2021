<?php

require_once('MyLiveChat.widget.php');

class MyLiveChat
{
	// singleton pattern
	protected static $instance;

	/**
	 * Absolute path to plugin files
	 */
	protected $plugin_url = null;


	/*MyLiveChat parameters*/
	protected $mylivechat_id = null;
	protected $mylivechat_pos = null;
	protected $mylivechat_displaytype = null;
	protected $mylivechat_membership = null;
	protected $mylivechat_encrymode = null;
	protected $mylivechat_encrykey = null;

	/**
	 * Remembers if MyLiveChat Id is set
	 */
	protected static $license_installed = false;

	/**
	 * Starts the plugin
	 */
	protected function __construct()
	{
		//add_action ('wp_head', array($this, 'tracking_code'));
		//wp_enqueue_style('mylivechat', $this->get_plugin_url().'/css/mylivechat.css', false, $this->get_plugin_version());
		add_action('widgets_init', create_function('', 'return register_widget("MyLiveChatWidget");'));
		add_action('wp_head', array($this, 'mylivechat_head'));
		add_action('wp_footer', array($this, 'mylivechat_footer'));
	}

	public static function get_instance()
	{
		if (!isset(self::$instance))
		{
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}

	/** 
	 * Returns plugin files absolute path
	 *
	 * @return string
	 */
	public function get_plugin_url()
	{
		if (is_null($this->plugin_url))
		{
			//$this->plugin_url = WP_PLUGIN_URL.'/my-live-chat-for-wp/plugin_files';
      $this->plugin_url = plugins_url().'/my-live-chat-for-wp/plugin_files';
		}

		return $this->plugin_url;
	}

	public function widgets_enabled()
	{
		global $wp_registered_sidebars;

		return (bool)(sizeof($wp_registered_sidebars) > 0);
	}

	public function is_installed()
	{
		if(is_null($this->get_mylivechat_id()))
			return false;
		if($this->get_mylivechat_id() == "") return false;
		return true;
	}

	public function get_mylivechat_id()
	{
		if (is_null($this->mylivechat_id))
		{
			$this->mylivechat_id = get_option('mylivechat_id');
		}
		if (is_null($this->mylivechat_id))
		{
			$this->mylivechat_id = "";
		}

		return $this->mylivechat_id;
	}

	public function get_mylivechat_pos()
	{
		if (is_null($this->mylivechat_pos))
		{
			$this->mylivechat_pos = get_option('mylivechat_pos');
		}

		return $this->mylivechat_pos;
	}
	
	public function get_mylivechat_displaytype()
	{
		if (is_null($this->mylivechat_displaytype))
		{
			$this->mylivechat_displaytype = get_option('mylivechat_displaytype');
		}

		return $this->mylivechat_displaytype;
	}
	
	public function get_integrate_user()
	{
		if (is_null($this->mylivechat_membership))
		{
			$this->mylivechat_membership = get_option('mylivechat_membership');
		}

		if($this->mylivechat_membership == "yes")
			return true;

		return false;
	}

	public function get_mylivechat_membership()
	{
		if (is_null($this->mylivechat_membership))
		{
			$this->mylivechat_membership = get_option('mylivechat_membership');
		}

		return $this->mylivechat_membership;
	}

	public function get_mylivechat_encrymode()
	{
		if (is_null($this->mylivechat_encrymode))
		{
			$this->mylivechat_encrymode = get_option('mylivechat_encrymode');
		}

		return $this->mylivechat_encrymode;
	}

	public function get_mylivechat_encrykey()
	{
		if (is_null($this->mylivechat_encrykey))
		{
			$this->mylivechat_encrykey = get_option('mylivechat_encrykey');
		}

		return $this->mylivechat_encrykey;
	}

	public function mylivechat_code()
	{

		if(is_null($this->get_mylivechat_id()))
		{
			echo "<a href='https://www.mylivechat.com/register.aspx' target='_blank'>Sign up MyLiveChat</a>";
		}
		else
		{
			$sptpre = "<div class=\"mod_mylivechat\">";			
			$sptend = "</div>";
		
			if($this->get_mylivechat_displaytype()=="button")
			{
			  echo $sptpre."<div id=\"MyLiveChatContainer\"></div><script type=\"text/javascript\">function add_chatbutton(){var hccid=".$this->get_mylivechat_id().";var nt=document.createElement(\"script\");nt.async=true;nt.src=\"https://mylivechat.com/chatbutton.aspx?hccid=\"+hccid;var ct=document.getElementsByTagName(\"script\")[0];ct.parentNode.insertBefore(nt,ct);}add_chatbutton();</script>".$sptend;
			}
			else if($this->get_mylivechat_displaytype()=="box")
			{
				echo $sptpre."<div id=\"MyLiveChatContainer\"></div><script type=\"text/javascript\">function add_chatbox(){var hccid=".$this->get_mylivechat_id().";var nt=document.createElement(\"script\");nt.async=true;nt.src=\"https://mylivechat.com/chatbox.aspx?hccid=\"+hccid;var ct=document.getElementsByTagName(\"script\")[0];ct.parentNode.insertBefore(nt,ct);}add_chatbox();</script>".$sptend;
			}
			else if($this->get_mylivechat_displaytype()=="link")
			{
				echo $sptpre."<div id=\"MyLiveChatContainer\"></div><script type=\"text/javascript\">function add_chatlink(){var hccid=".$this->get_mylivechat_id().";var nt=document.createElement(\"script\");nt.async=true;nt.src=\"https://mylivechat.com/chatlink.aspx?hccid=\"+hccid;var ct=document.getElementsByTagName(\"script\")[0];ct.parentNode.insertBefore(nt,ct);}add_chatlink();</script>".$sptend;
			}
		}
	}

	public function mylivechat_inlinecode()
	{

		if(is_null($this->get_mylivechat_id()))
		{
			//echo "<a href='https://www.mylivechat.com/register.aspx' target='_blank'>Sign up MyLiveChat</a>";
		}
		else
		{	
			echo "<script type=\"text/javascript\">function add_chatinline(){var hccid=".$this->get_mylivechat_id().";var nt=document.createElement(\"script\");nt.async=true;nt.src=\"https://mylivechat.com/chatinline.aspx?hccid=\"+hccid;var ct=document.getElementsByTagName(\"script\")[0];ct.parentNode.insertBefore(nt,ct);}add_chatinline();</script>";
		}
	}
	
	public function mylivechat_widgetcode()
	{

		if(is_null($this->get_mylivechat_id()))
		{
		}
		else
		{	
			echo "<script type=\"text/javascript\">function add_chatwidget(){var hccid=".$this->get_mylivechat_id().";var nt=document.createElement(\"script\");nt.async=true;nt.src=\"https://mylivechat.com/chatwidget.aspx?hccid=\"+hccid;var ct=document.getElementsByTagName(\"script\")[0];ct.parentNode.insertBefore(nt,ct);}add_chatwidget();</script>";
		}
	}

	public function mylivechat_monitor()
	{
		if(is_null($this->get_mylivechat_id()))
		{
			//echo "<a href='https://www.mylivechat.com/register.aspx' target='_blank'>Sign up MyLiveChat</a>";
		}
		else
		{
		echo "<script type=\"text/javascript\">function add_chatapi(){var hccid=".$this->get_mylivechat_id().";var nt=document.createElement(\"script\");nt.async=true;nt.src=\"https://mylivechat.com/chatapi.aspx?hccid=\"+hccid;var ct=document.getElementsByTagName(\"script\")[0];ct.parentNode.insertBefore(nt,ct);}add_chatapi();</script>";

		}
	}

	public function mylivechat_head()
	{
		echo '<link type="text/css" rel="stylesheet" href="' . $this->get_plugin_url().'/css/mylivechat.css" />' . "\n";

		$_pos = $this->get_mylivechat_pos();
		$_type = $this->get_mylivechat_displaytype();
		if($_type!="inline" && (is_null($_pos) || $_pos ==""	|| $_pos=="widget"))
		{
			$this->mylivechat_monitor();
		}
	}

	public function mylivechat_footer()
	{
		$_pos = $this->get_mylivechat_pos();
		$_type = $this->get_mylivechat_displaytype();
		if($_type=="inline")
		{
			$this->mylivechat_inlinecode();
			return;
		}
		if($_type=="widget")
		{
			$this->mylivechat_widgetcode();
			return;
		}
		if(!is_null($_pos) &&$_pos !=""	&& $_pos=="footer")
		{
			$this->mylivechat_code();
		}
	}
}
?>