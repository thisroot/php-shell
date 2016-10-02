<?
class Utils {

    function SizeConvert($bytes) {
        $b = floatval($bytes);

        foreach ([
            ['TB',  pow(1024, 4)],
            ['GB',  pow(1024, 3)],
            ['MB',  pow(1024, 2)],
            ['KB',  1024],
            ['B',   1]
        ] as $val) {
            if ($b >= $val[1]) {
                $res = $b / $val[1];
                $res = str_replace('.', ',' , strval(round($res, 2))).' '.$val[0];
                break;
            }
        }
        
        return $res;
    }
    
    function IsAssocArray($array) {
        return array_keys($array) !== range(0, count($array) - 1);
    }
    
    function Curl($settings, $return = 'result') {
        $curl = curl_init();
        
        foreach ($settings as $key => $value) {
            switch ($key) {
                case 'url': 
                    curl_setopt($curl, CURLOPT_URL, $value); 
                    break;
                case 'return_transfer': 
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, $value); 
                    break;
                case 'post': 
                    curl_setopt($curl, CURLOPT_POST, true); 
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($value));
                    break;
            }
        }
        
        switch ($return) {
            case 'result':
                $out = curl_exec($curl);
                curl_close($curl);
                return $out;
            case 'resource':
                return $curl;
        }

        
    }

}