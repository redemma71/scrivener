<?

namespace App\Soa;
use App\Soa\helpers;
use Faker;
use DomDocument;

class AnswerOptions {

    private function createCorrectOptions($node) {
        $correct_option = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:correct-option');
        $correct_option->setAttribute('cgi',generateCGI());
        // randomize minor attributes here
        $correct_answer = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:answer',$this->faker->unique()->jobTitle);
        $correct_option->appendChild($correct_answer);
        $randFeedback = rand(1,10);
        if ($randFeedback >= 6) {
            $correct_feedback = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:feedback',$this->faker->realText(50));
            $correct_option->appendChild($correct_feedback);
        }
        $node->appendChild($correct_option);
}

    private function createIncorrectOptions($node) {
            $incorrect_option = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:incorrect-option');
            $incorrect_option->setAttribute('cgi',generateCGI());
            // randomize minor attributes here
            $incorrect_answer = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:answer',$this->faker->unique()->jobTitle);
            $incorrect_option->appendChild($incorrect_answer);
            $randFeedback = rand(1,10);
            if ($randFeedback >= 6) {
                $incorrect_feedback = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:feedback',$this->faker->realText(50));
                $incorrect_option->appendChild($incorrect_feedback);
            }
            $node->appendChild($incorrect_option);
    }

    public function generateCorrect($node) {
        $faker = Faker\Factory::create();
        $correct = new DOMDocument('1.0','UTF-8');
        $this->createCorrectOptions($node);
        return $this->correct->saveXML();
    }

}

?>