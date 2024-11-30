<?php
namespace App\Models;
use CodeIgniter\Model;
use MongoDB\Client;

class DataModel extends Model {
    private $mongoClient;

    public function __construct() {
        try {
            $this->mongoClient = new Client("mongodb://localhost:27017");
            error_log("MongoDB connection successful");
            $this->ensureIndexes();
        } catch (\Exception $e) {
            error_log("MongoDB connection failed: " . $e->getMessage());
        }
    }

    private function ensureIndexes() {
        $db = $this->mongoClient->microgrid;
        $collections = $db->listCollections();
        foreach ($collections as $collection) {
            $collectionName = $collection->getName();
            $indexes = $db->$collectionName->listIndexes();
            $hasDatetimeIndex = false;
            foreach ($indexes as $index) {
                if (isset($index['key']['datetime'])) {
                    $hasDatetimeIndex = true;
                    break;
                }
            }
            if (!$hasDatetimeIndex) {
                $db->$collectionName->createIndex(['datetime' => -1]);
                error_log("Index created on datetime field for collection: $collectionName");
            }
        }
    }

    public function getLatestData($collectionName, $limit = 1) {
        $db = $this->mongoClient->microgrid;
        $collection = $db->selectCollection($collectionName);
        $latestData = $collection->find([], ['sort' => ['datetime' => -1], 'limit' => $limit])->toArray();
        return $latestData;
    }

    public function getCollections() {
        $db = $this->mongoClient->microgrid;
        try {
            $collections = $db->listCollections();
            $collectionNames = [];
            foreach ($collections as $collection) {
                $collectionNames[] = $collection->getName();
            }
            error_log("Collections: " . implode(", ", $collectionNames));
            return $collectionNames;
        } catch (\Exception $e) {
            error_log("Failed to list collections: " . $e->getMessage());
            return [];
        }
    }
}