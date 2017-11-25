<?php
/**
 *
 *
 *
 *
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Alexa\Test;
use PHPUnit\Framework\TestCase;


final class AlexaResponseTest extends TestCase {
	
	public function testhelloworld01() {
		try {
			$w = new \Alexa\Endpoint\Response();
			$w->say("Dies ist ein Test");
			$w->send();
			$this->assertEquals(true, true); //No Error, that it's a success
		} catch (Exception $ex) {
				$this->fail("Failed at helloworld01");
		}		
	}

	
	
}
