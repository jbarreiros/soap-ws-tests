<?php

class MyWebService {

    /**
     * Gets a random, inspirational quote!
     *
     * @return string
     */
    public function randomQuote() {
        $quotes = array(
            'Beer!',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'Four scores and seven years ago...',
            'Egaad!'
        );
        $choice = rand( 0, 3 );
        return $quotes[$choice];
    }

    /**
     * Gets a persons age.
     *
     * @param  string $birthdate The persons birthdate
     * @return string
     */
    public function getAge( $birthdate ) {
        try {
            $date = new DateTime($birthdate);
        }
        catch( Exception $e ) {
            return 'Invalid birthdate format';
        }
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }

}

?>