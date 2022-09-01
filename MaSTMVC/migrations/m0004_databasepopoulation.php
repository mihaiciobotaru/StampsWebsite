<?php

use app\core\Application;

class m0004_databasepopoulation
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = 'INSERT INTO catalogue (id, name, id_user, id_stamp, created_datetime) VALUES
                (1, \'My Collection\', 1, 2, \'2015-06-02\'),
                (2, \'My Collection\', 1, 3, \'2022-06-15\'),
                (4, \'New Collection\', 5, 1, \'2022-06-13\'),
                (5, \'New Collection\', 3, 6, \'2022-04-11\'),
                (6, \'Another Collection\', 4, 7, \'2021-12-21\');
                
                INSERT INTO stamps (id, name, country, owner_id, posted_id, category, color, likes, width, height, price, perforations, posted_datetime, issued_datetime) VALUES
                (1, \'Monaco - Prince Charles III\', \'France\', 1, 1, \'Family\', \'Blue\', 0, \'10.00\', \'20.00\', \'50.00\', 5, \'2022-06-18\', \'2014-06-17\'),
                (2, \'French-South-and-Antarctic-Terr. - Penguins and Se\', \'France\', 1, 1, \'Agriculture\', \'Green\', 0, \'15.00\', \'24.00\', \'35.00\', 4, \'2022-06-18\', \'2014-02-14\'),
                (3, \'Ungaria - King Franz Joseph - Lithographed\', \'Hungary\', 2, 2, \'Army\', \'Yellow\', 0, \'23.00\', \'23.00\', \'45.00\', 7, \'2022-06-18\', \'2014-06-08\'),
                (4, \'United-States - Benjamin Franklin, 1706-1790 and G\', \'USA\', 2, 2, \'Army\', \'Blue\', 0, \'12.00\', \'54.00\', \'546.00\', 12, \'2022-06-18\', \'2011-12-13\'),
                (5, \'Great-Britain - Queen Victoria, 1819-1901\', \'UK\', 3, 3, \'Aviation\', \'Brown\', 0, \'45.00\', \'34.00\', \'23.00\', 7, \'2021-06-15\', \'2015-02-09\'),
                (6, \'Germania - New Daily Stamp\', \'Germany\', 2, 2, \'Architecture\', \'Magenta\', 0, \'15.00\', \'34.00\', \'32.00\', 10, \'2022-06-08\', \'2021-07-20\'),
                (7, \'România - Cap de Bour - Emisiunea I\', \'Romania\', 4, 4, \'Agriculture\', \'Red\', 0, \'23.00\', \'45.00\', \'100.00\', 2, \'2011-02-24\', \'2010-12-20\');
                
                INSERT INTO users (id, username, email, firstname, lastname, status, stamps_posted, stamps_owned, password, create_datetime) VALUES
                (1, \'vladgrigo\', \'vladgrigorita@yahoo.com\', \'Vlad\', \'Grigorita\', 0, 0, 0, \'12345678\', \'2022-06-18 17:33:48\'),
                (2, \'johnsnow\', \'johnsnow@gmail.com\', \'John\', \'Snow\', 0, 0, 0, \'$2y$10$t0dFlpEkD2baiLZqWf3/O.PTIJlC0SK1cYW5V7OvADACqM2uEKhhm\', \'2022-06-18 17:34:49\'),
                (3, \'vasileion\', \'vasileion@gmail.com\', \'Vasile\', \'Ion\', 0, 0, 0, \'$2y$10$xIaEVDNrZmfpogGnu4qXne/TdwXNq4.Lmt6XEggnlppHBY1ovAfUm\', \'2022-06-18 17:35:16\'),
                (4, \'raduchelaru\', \'raduchelaru@yahoo.com\', \'Radu\', \'Chelaru\', 0, 0, 0, \'$2y$10$n6L93GHhG5Wgn2g9p5rf5egXHqK95mLbiIw.RXLPBKEOZm7lchUha\', \'2022-06-18 17:35:43\'),
                (5, \'gigibecali\', \'gigibecali@yahoo.com\', \'Gigi\', \'Becali\', 0, 0, 0, \'$2y$10$XSvk8tjYxnK.TlH8VS0CB.7Cza/2rfv8xc4xQ6lYANg9SzftACPO.\', \'2022-06-18 17:36:19\'),
                (6, \'mihaiciobo\', \'mihaiciobo@yahoo.com\', \'Mihai\', \'Ciobotaru\', 0, 0, 0, \'$2y$10$Ro/i4Ds9xECiJ0wyoUU7yOwrd2PSCwff/Ups.hOmVrvbK.9NRcbfu\', \'2022-06-18 17:36:58\');';

        $db->pdo->exec($SQL);
    }

    public function down(){

    }

}
