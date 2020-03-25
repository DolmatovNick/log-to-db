<?php

class ImportFileLog extends ImportFile {

    protected function matchFileLineToDBRow($fileLine): array
    {
        return [
            'ip' => $fileLine[2],
            'url_from' => $fileLine[3],
            'url_to' => $fileLine[4],
            'log_date' => $fileLine[0] . ' ' . $fileLine[1],
        ];
    }

    protected function insertBatch(&$rows)
    {
        $insertPlaces = [];
        $values = [];
        foreach ($rows as $row) {
            $insertPlaces[] = '(?,?,?,?)';
            foreach ($row as $elements) {
                $values[] = $elements;
            }
        }
        $insertPlaces = implode(',', $insertPlaces);

        $sql = "
            INSERT INTO logs (ip, url_from, url_to, log_date) VALUES
            ". $insertPlaces ."
        ";

        DB::prepare($sql)->execute($values);
    }

}