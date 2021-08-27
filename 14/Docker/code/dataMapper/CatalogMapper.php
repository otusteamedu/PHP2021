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


        $this->insertStatement = $pdo->prepare(
            'INSERT INTO goods (name,propertyColor,propertySize,description,count,price) VALUES(?,?,?,?,?,?)'
        );

        $this->updateStatement = $pdo->prepare(
            'UPDATE goods SET INTO name = ?,propertyColor = ?,propertySize = ?,description = ?,count = ?,price = ?) WHERE id = ?'
        );

        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM goods WHERE id = ?'
        );
    }

    public function getAllRecordsByLimit($limit = 10):catalogCollection{

        $this->selectStatementLimit  = $this->pdo->query('SELECT * FROM goods LIMIT = $limit');

        $result = $this->selectSatamentLimit->setFetchMode(PDO::FETCH_ASSOC);

        $collection = new catalogCollection();

        foreach($result as $item){

            $collection->addItem(
                 new Catalog(
                     $item['name'],
                     $item['propertyColor'],
                     $item['propertySize'],
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
            $result['propertyColor'],
            $result['propertySize'],
            $result['description'],
            $result['count'],
            $result['price']

        ));
    }

    public function insert(array $rawuserData):Catalog
    {

        $this->insertStatement->execute([
                $rawuserData['name'],
                $rawuserData['propertyColor'],
                $rawuserData['propertySize'],
                $rawuserData['description'],
                $rawuserData['count'],
                $rawuserData['price']
        ]);

        return (int) $this->pdo->lastInsertId();


    }

    public function update(Catalog $catalog):bool{

        return $this->updateStatement->execute(
          [
              $catalog->getName(),
              $catalog->getpropertyColor(),
              $catalog->getpropertySize(),
              $catalog->getDescription(),
              $catalog->getCount(),
              $catalog->getPrice(),

          ]
        );
    }

    public function delete(Catalog $catalog):bool
    {
        return $this->deleteStatement->execute([$catalog->getId()]);
    }
}