<?php
    function kode_random($length){
        $angka  = "123456789";
        $string = "RM-";
        //RM- untuk RMarket.
        //Bisa diganti sesuai keinginan.
        for ($i=0; $i < $length; $i++){
            $pos     = rand(0, strlen($angka)-1);
            $string .= $angka{$pos};
        }
            return $string;
    }

    $kode   = kode_random(10);
    echo $kode;
?>