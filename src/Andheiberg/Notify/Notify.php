<?php namespace Andheiberg\Notify;

use Illuminate\Support\MessageBag;
use Illuminate\Session\Store as Session;
use Illuminate\Config\Repository as Config;
use Illuminate\Translation\Translator as Lang;
use BadMethodCallException;

class Notify extends MessageBag {

	/**
	 * Illuminate's Session Store.
	 *
	 * @var \Illuminate\Session\Store
	 */
	protected $session;

	/**
	 * Illuminate's Config Repository.
	 *
	 * @var \Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * Initialize the Notify class.
	 *
	 * @param  \Illuminate\Session\Store  $session
	 * @param  \Illuminate\Config\Repository $config
	 * @return \Andheiberg\Notify\Notify
	 */
	public function __construct(Session $session, Config $config, Lang $lang)
	{
		$this->config = $config;
		$this->session = $session;
		$this->lang = $lang;

		parent::__construct($session->get($this->getSessionKey(), []));
	}

	/**
	 * Returns the alert types from the config.
	 *
	 * @return array
	 */
	public function getTypes()
	{
		return (array) $this->config->get('notify.types');
	}

	/**
	 * Returns the session key from the config.
	 *
	 * @return string
	 */
	public function getSessionKey()
	{
		return $this->config->get('notify.session_key');
	}

	/**
	 * Add a notification to the bag.
	 *
	 * @param  string  $key
	 * @param  string  $message
	 * @param  array   $replace
	 * @return \Illuminate\Support\MessageBag
	 */
	public function addNotification($key, $message, $replace = array())
	{
		if ($this->lang->has($message))
		{
			$message = $this->lang->get($message, $replace);
		}
		
		$this->add($key, $message);

		$this->session->flash($this->getSessionKey(), $this->messages);
	}

	/**
	 * Dynamically handle notify function calls.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 * @throws BadMethodCallException
	 */
	public function __call($method, $parameters)
	{
		// Check if the method is in the allowed alert types array.
		if ( ! in_array($method, $this->getTypes()))
		{
			throw new BadMethodCallException("Method [$method] does not exist.");
		}

		$message = $parameters[0];
		$replace = isset($parameters[1]) ? $parameters[1] : [];

		$this->addNotification($method, $message, $replace);
	}

}
