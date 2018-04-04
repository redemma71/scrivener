<?

namespace App\Soa;
use App\Soa\helpers;
use Faker;
use DomDocument;

class AnswerOptions {

    function __construct() {
        $this->dom = new DOMDocument();
        $this->randomFeedback = rand(1,10);
        $this->faker = Faker\Factory::create();
    }

    public function createCorrectOption($answer) {
        $correct_option = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:correct-option');
        $correct_option->setAttribute('cgi',generateCGI());
        // randomize minor attributes here
        $correct_answer = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:answer',$answer);
        $correct_option->appendChild($correct_answer);
        if ($this->randFeedback >= 6) {
            $correct_feedback = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:feedback',$this->faker->realText(50));
            $correct_option->appendChild($correct_feedback);
        }
        return $this->dom->saveXML();
}

    public function createIncorrectOption($answer) {
            $incorrect_option = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:incorrect-option');
            $incorrect_option->setAttribute('cgi',generateCGI());
            // randomize minor attributes here
            $incorrect_answer = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:answer',$answer);
            $incorrect_option->appendChild($incorrect_answer);
            if ($his->randFeedback >= 6) {
                $incorrect_feedback = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:feedback',$this->faker->realText(50));
                $incorrect_option->appendChild($incorrect_feedback);
            }
            return $this->dom->saveXML();
    }

}

?>