
<?php
namespace App\Soa;
use App\Soa\MultipleChoice;
use App\Soa\Item;
use DOMDocument;
use Storage;
/**
 * Test class is a helper class
 * used for testing creation of new
 * item types in development.
 * 
 * @author Chad David Cover <chad.cover@cengage.com>
 */
class Test
{
    /**
     * Generate sample items
     * during new class development
     *
     * @return void
     */
    public function generateItem()
    {   
        $iMax = 4;
        $jMax = 4;
        $storagePath = Storage::disk('soa')->getDriver()->getAdapter()->getPathPrefix();
    
        for ($i = 1; $i <= $iMax; $i++) {
            $msXML = new MultipleChoice();
            $msItem = $msXML->generateMC('multi');
            $msItem->save($storagePath . 'multi' . $i . '.xml');
        } 
    
        for ($j = 1 ; $j <= $jMax; $j++) {
            $ssXML = new MultipleChoice();
            $ssItem = $ssXML->generateMC('single');
            $ssItem->save($storagePath . 'single' . $j . '.xml');
        }
    }


}

?>