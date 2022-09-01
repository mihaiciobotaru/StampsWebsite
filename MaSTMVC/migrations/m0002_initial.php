<?php

use app\core\Application;

class m0002_initial
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "   CREATE TABLE IF NOT EXISTS `stamps` (
                  `id` int(11) NOT NULL,
                  `name` varchar(50) NOT NULL,
                  `country` varchar(50) NOT NULL,
                  `owner_id` int(11) NOT NULL,
                  `posted_id` int(11) NOT NULL,
                  `category` varchar(50) NOT NULL,
                  `color` varchar(50) DEFAULT NULL,
                  `likes` int(11) NOT NULL,
                  `width` decimal(5,2) DEFAULT NULL,
                  `height` decimal(5,2) DEFAULT NULL,
                  `price` decimal(5,2) NOT NULL,
                  `perforations` int(11) DEFAULT NULL,
                  `posted_datetime` date NOT NULL,
                  `issued_datetime` date DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $db->pdo->exec($SQL);

        $SQL = "   ALTER TABLE `stamps`
                      ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);

        $SQL = "ALTER TABLE `stamps`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
        $db->pdo->exec($SQL);
    }


    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE stamps";
        $db->pdo->exec($SQL);
    }
}
