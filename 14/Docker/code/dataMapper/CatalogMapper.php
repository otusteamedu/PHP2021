<?php
namespace hw14\DataMapper;

use collection\catalogCollection;
use PDO;
use PDOStatement;

class CatalogMapper
{
    private PDO $pdo;

    private PDOStatement $selectStatement;

    private PDOStatement $selectStatementLimit;

    private PDOStatement $insertStatement;

    private PDOStatement $deleteStatement;

    private PDOStatement $updateStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

        $this->selectStatement = $pdo->prepare('SELECT * FROM goods WHERE id=?');

        $this->selectStatementLimit  = $pdo->query('SELECT * FROM goods LIMIT = 10');

        $this->insertStatement = $pdo->prepare(
            'INSERT INTO goods (name,prop1,prop2,description,count,price) VALUES(?,?,?,?,?,?)'
        );

        $this->updateStatement = $pdo->prepare(
            'UPDATE goods SET INTO name = ?,prop1 = ?,prop2 = ?,description = ?,count = ?,price = ?) WHERE id = ?'
        );

        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM goods WHERE id = ?'
        );
    }

    public function getAllRecordsByLimit():catalogCollection{

        $result = $this->selectSatamentLimit->setFetchMode(PDO::FETCH_ASSOC);

        $collection = new catalogCollection();

        foreach($result as $item){

            $collection->addItem(
                 new Catalog(
                     $item['name'],
                     $item['prop1'],
                     $item['prop2'],
                     $item['description'],
                     $item['count'],
                     $item['price'],
                 )
            );
        }
        return $collection;
    }

    public function findOneDyID(int $id):Catalog
    {
        $this->selectSatament->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectSatament->execute([$id]);

        $result = $this->selectSatament->fetch();
        return (new Catalog(

            $result['id'],
            $result['name'],
            $result['prop1'],
            $result['prop2'],

        ));
    }

    public function insert(array $rawuserData):Catalog
    {

        $this->insertStatement->execute([
                $rawuserData['name'],
                $rawuserData['prop1'],
                $rawuserData['prop2'],
                $rawuserData['description'],
                $rawuserData['count'],
                $rawuserData['price']
        ]);

        return new Catalog(
            (int) $this->pdo->lastInsertId(),
            $rawuserData['name'],
            $rawuserData['prop1'],
            $rawuserData['prop2'],
            $rawuserData['description'],
            $rawuserData['count'],
            $rawuserData['price']

        );

    }

    public function update(Catalog $catalog):bool{

        return $this->updateStatement->execute(
          [
              $catalog->getName(),
              $catalog->getprop1(),
              $catalog->getprop2(),
              $catalog->getName()
          ]
        );
    }

    public function delete(Catalog $catalog):bool
    {
        return $this->deleteStatement->execute([$catalog->getId()]);
    }
}