<?php

namespace app\core\db;

require_once("core/Application.php");

use app\core\Application;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');

        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applyied migration $migration");
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=INNODB");
    }

    private function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn ($m) => "('$m')", $migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
                                       $str
                                       ");
        $statement->execute();
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }

    //
    //
    //

    function executeDMLCommand($query): bool
    {
        $sql = $this->prepare($query);

        if ($this->pdo->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>";
            print_r($this->pdo->errorInfo());
            return FALSE;
        }
        return TRUE;
    }

    function executeQuery($query) {
        $sql = $this->prepare($query);

        if ($sql->execute ()) {
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    function printStatement($st) : void{
        for($i = 0 ; $i < count($st); ++$i){
            print_r($st[$i]);
            echo "<br>";
        }
    }

    /*
     * USERS DML, DQL COMMANDS
     */

    function getUserByName($username)
    {
        $query  = "SELECT * FROM users WHERE username='$username'";
        return $this->executeQuery($query);

    }

    function getUserByEmail($email)
    {
        $query  = "SELECT * FROM users WHERE email='$email'";
        return $this->executeQuery($query);
    }

    function getUserById($id)
    {
        $query  = "SELECT * FROM users WHERE id='$id'";
        return $this->executeQuery($query);
    }
    function createUser($username,$firstname,$lastname, $email, $password) : bool{/// passwords must be crypted in db
        $command = "INSERT INTO `users` (
                     `id`, `username`, `email`, `firstname`, `lastname`, 
                     `status`, `stamps_posted`, `stamps_owned`, `password`, `create_datetime`) VALUES 
                    (NULL, '$username', '$email', $firstname, $lastname, '0','0','$password', NOW())";
        return $this->executeDMLCommand($command);
    }

    function deleteUser($username) : bool{
        $command = "DELETE FROM users WHERE username = '$username'";

        return $this->executeDMLCommand($command);
    }

    /*
     * PRODUCTS DML, DQL COMMANDS
     */


    //$color = "UNKNOWN", $width = "0", $height = "0",$perforations = "0", $issuedDate = ""
    function createStamp($name, $country, $ownerId, $postedId, $category, $price ) : bool{/// passwords must be crypted in db
        /// se face verificarea ca userii sa existe
        $result = $this->getUserById($ownerId);
        if(count($result) === 0){
            echo "Owner $ownerId does not exist<br>";
            return false;
        }

        $result = $this->getUserById($postedId);
        if(count($result) === 0){
            echo "Posted $postedId does not exist<br>";
            return false;
        }

        $command = "UPDATE users SET stamps_posted = stamps_posted + 1 WHERE id = $postedId";
        $this->executeDMLCommand($command);

        $command = "UPDATE users SET stamps_owned = stamps_owned + 1 WHERE id = $ownerId";
        $this->executeDMLCommand($command);

        $command = "INSERT INTO `stamps` (
                      `id`, `name`, `country`, `owner_id`, `posted_id`,
                      `category`, `likes`, `price`,
                      `posted_datetime`) VALUES 
                (NULL, '$name', '$country', '$ownerId', '$postedId', '$category', '0',
                  '$price', NOW())";
        return $this->executeDMLCommand($command);
    }

    function updateStampColor($stampName,$color) : bool{
        $command = "UPDATE stamps SET color = '$color' WHERE name = '$stampName'";
        return $this->executeDMLCommand($command);
    }
    function updateStampDimensions($stampName,$width,$height) : bool{
        $command = "UPDATE stamps SET width = '$width',height = '$height'  WHERE name = '$stampName'";
        return $this->executeDMLCommand($command);
    }

    function updateStampPerforations($stampName,$perforations) : bool{
        $command = "UPDATE stamps SET perforations = '$perforations'  WHERE name = '$stampName'";
        return $this->executeDMLCommand($command);
    }

    function updateStampIssuedDate($stampName,$issuedDate) : bool{
        $command = "UPDATE stamps SET issuedDate = '$issuedDate'  WHERE name = '$stampName'";
        return $this->executeDMLCommand($command);
    }

    function deleteStamp($stampName) : bool{
        $result = $this->getStampByName($stampName);
        $oldUserId = $result[0]["owner_id"];
        if(count($result) !== 0){
            $command = "UPDATE users SET stamps_owned = stamps_owned - 1 WHERE id = $oldUserId";
            $this->executeDMLCommand($command);
        }
        $command = "DELETE FROM stamps WHERE name = '$stampName'";

        return $this->executeDMLCommand($command);
    }

    function getStampByName($stampName)
    {
        $query  = "SELECT * FROM stamps WHERE name='$stampName'";
        return $this->executeQuery($query);
    }

    function getStampById($id)
    {
        $query  = "SELECT * FROM stamps WHERE id='$id'";
        return $this->executeQuery($query);
    }


    /*
     * CATALOGUE DML, DQL COMMANDS
    */

    function createCatalogueRelation($name, $idUser, $idStamp) : bool{/// passwords must be crypted in db
        /// se face verificare ca id urile sa corespunda unor obiecte existene in baza de date
        /// se face verificarea ca relatia sa nu existe deja
        $result = $this->getUserById($idUser);
        if(count($result) === 0){
            echo "User $idUser does not exist<br>";
            return false;
        }

        $result = $this->getStampById($idStamp);
        if(count($result) === 0){
            echo "Stamp $idStamp does not exist<br>";
            return false;
        }

        $result = $this->getCatalogueRelation($name, $idUser, $idStamp);
        if(count($result) === 0){
            $command = "INSERT INTO `catalogue` 
                    (`id`, `name`, `id_user`,
                     `id_stamp`, `created_datetime`) VALUES 
                    (NULL, '$name', '$idUser','$idStamp', NOW())";
            return $this->executeDMLCommand($command);
        }

        echo "Relation already exist<br>";
        return false;

    }

    function deleteCatalogueRelation($name, $idUser, $idStamp) : bool{
        $command = "DELETE FROM catalogue WHERE name = '$name' AND
                                             id_user = $idUser AND
                                             id_stamp = $idStamp";

        return $this->executeDMLCommand($command);
    }

    function getCatalogueRelation($name, $idUser, $idStamp)
    {

        $query  = "SELECT * FROM catalogue WHERE name = '$name' AND
                                             id_user = $idUser AND
                                             id_stamp = $idStamp";
        return $this->executeQuery($query);
    }


    /*
     * GENERAL DML, DQL COMMANDS
    */

    function likeStamp($userId, $stampId) : bool{

        $result = $this->getUserById($userId);
        if(count($result) === 0){
            echo "User $userId does not exist<br>";
            return false;
        }

        $result = $this->getStampById($stampId);
        if(count($result) === 0){
            echo "Stamp $stampId does not exist<br>";
            return false;
        }

        $username = $this->getUserById($userId)[0]["username"];
        $this->createCatalogueRelation("$username`s Liked Stamps", (string)$userId, (string)$stampId);

        $command = "UPDATE stamps SET likes = likes + 1 WHERE id = $stampId";
        return $this->executeDMLCommand((string)$command);

    }

    function changeOwnerOfStamp($stampId, $newOwnerId) : bool{

        $result = $this->getStampById($stampId);
        if(count($result) === 0){
            echo "Stamp $stampId does not exist<br>";
            return false;
        }
        $oldUserId = $result[0]["owner_id"];

        $result = $this->getUserById($newOwnerId);
        if(count($result) === 0){
            echo "User $newOwnerId does not exist<br>";
            return false;
        }


        $command = "UPDATE users SET stamps_owned = stamps_owned - 1 WHERE id = $oldUserId";
        $this->executeDMLCommand($command);

        $command = "UPDATE users SET stamps_owned = stamps_owned + 1 WHERE id = $newOwnerId";
        $this->executeDMLCommand($command);

        $command = "UPDATE stamps SET owner_id = $newOwnerId WHERE id = $stampId";
        return $this->executeDMLCommand($command);

    }

}
