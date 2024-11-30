<?php

namespace App\Controllers;
use App\Models\DataModel;
use CodeIgniter\Controller;
use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\ObjectId;

class DataController extends Controller {
    public function getData($collectionName, $limit = 1) {
        $dataModel = new DataModel();
        $data = $dataModel->getLatestData($collectionName, (int)$limit);

        if ($limit == 1) {
            $modifiedData = array_map(function($item) {
                return $this->modifyDataRecursively($item);
            }, $data);

            return $this->response->setJSON($modifiedData);
        } else {
            return $this->response->setJSON($data);
        }
    }

    private function modifyDataRecursively($data) {
        if (is_array($data) || is_object($data)) {
            foreach ($data as $key => &$value) {
                if ($key === '_id') {
                    $value = new ObjectId(); // Fake the _id field
                } elseif ($key === 'datetime') {
                    $value = new UTCDateTime(); // Set datetime to now
                } elseif (is_numeric($value)) {
                    $value += $value * (rand(-5, 2) / 100); // Randomly modify numeric values
                } else {
                    $value = $this->modifyDataRecursively($value);
                }
            }
        }
        return $data;
    }

    public function getCollections() {
        $dataModel = new DataModel();
        $collections = $dataModel->getCollections();
        return $this->response->setJSON($collections);
    }
}