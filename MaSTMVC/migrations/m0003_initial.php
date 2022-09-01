<?php

use app\core\Application;

class m0003_initial
{
    public function up()
    {
        $db = Application::$app->db;
        $SQL = "   CREATE TABLE IF NOT EXISTS `catalogue` (
                  `id` int(11) NOT NULL,
                  `name` varchar(50) NOT NULL,
                  `id_user` int(11) NOT NULL,
                  `id_stamp` int(11) NOT NULL,
                  `created_datetime` date NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $db->pdo->exec($SQL);

        $SQL = "ALTER TABLE `catalogue`
                  ADD PRIMARY KEY (`id`);";
        $db->pdo->exec($SQL);

        $SQL = "ALTER TABLE `catalogue`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
        $db->pdo->exec($SQL);

    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE catalogue";
        $db->pdo->exec($SQL);
    }
}
