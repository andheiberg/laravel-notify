<?php namespace spec\Andheiberg\Notify;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Session\Store as Session;
use Illuminate\Config\Repository as Config;

class NotifySpec extends ObjectBehavior
{
	function let(Session $session, Config $config)
	{
		$this->beConstructedWith($session, $config);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Andheiberg\Notify\Notify');
	}

	function it_can_make_success_notification(Session $session, Config $config)
	{
		$config->get('notify::session_key')->willReturn('notify_messages');
		$config->get('notify::types')->willReturn(['success', 'error']);

		$session->flash('notify_messages', [["Success flash notification!"]])->shouldBeCalled();

		$this->success('Success flash notification!')
		->shouldReturn(null);
	}

	function it_can_make_error_notification(Session $session, Config $config)
	{
		$config->get('notify::session_key')->willReturn('notify_messages');
		$config->get('notify::types')->willReturn(['success', 'error']);

		$session->flash('notify_messages', [["Error flash notification!"]])->shouldBeCalled();

		$this->error('Error flash notification!')
		->shouldReturn(null);
	}
}
