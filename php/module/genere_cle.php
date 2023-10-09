<?php
class GenerateRandomKeyService
{
    public function generateRandomKey(string $syntax = 'XXXX-XXXX-XXXX-XXXX',  ?string $salt = null):string
    {
        $saltedKey='';
        $randomBytes = random_bytes(16);

        $key = bin2hex($randomBytes);

        $formattedKey = '';
        $syntaxLength = strlen($syntax);
        $keyLength = strlen($key);
        $syntaxIndex = 0;

        for ($i = 0; $i < $syntaxLength; $i++) {
            if ($syntax[$i] === 'X') {
                if ($syntaxIndex < $keyLength) {
                    $letter = $key[$syntaxIndex];
                    $isUppercase = random_int(0, 1);

                    if ($isUppercase) {
                        $letter = strtoupper($letter);
                    } else {
                        $letter = strtolower($letter);
                    }

                    $formattedKey .= $letter;
                    $syntaxIndex++;
                } else {
                    break;
                }
            } else {
                $formattedKey .= $syntax[$i];
            }
        }
        
        if(null !== $salt){
         $saltedKey = $formattedKey.$salt;
        }else{
            $saltedKey = $formattedKey;
        }
        return $saltedKey;
    }

    public function generateUniqueKey(string $syntaxe ){
        return $this->generateRandomKey($syntaxe);
    }

    // public function getCurrentDateTimeComponents()
    // {
    //     $now = new \DateTime();

    //     $year = $now->format('Y');
    //     $month = $now->format('m');
    //     $day = $now->format('d');
    //     $hour = $now->format('H');
    //     $minutes = $now->format('i');
    //     $seconds = $now->format('s');

    //     return [
    //         'year' => $year,
    //         'month' => $month,
    //         'day' => $day,
    //         'hour' => $hour,
    //         'minutes' => $minutes,
    //         'seconds' => $seconds,
    //     ];
    // }
    // public function salt()
    // {
    //     $datetime = $this->getCurrentDateTimeComponents();
    //     $Y = $datetime['year'];
    //     $m = $datetime['month'];
    //     $d = $datetime['day'];
    //     $H = $datetime['hour'];
    //     $i = $datetime['minutes'];
    //     $s = $datetime['seconds'];
    //     return '@'.$Y.'.'.$m.'.'.$d.'.'.$H.'.'.$i.'.'.$s;
    // }
}