<?php

class ImportFileIp extends ImportFile {

    protected function matchFileLineToDBRow($fileLine): array
    {
        return [
            'ip' => $fileLine[0],
            'browser' => $fileLine[1],
            'os' => $fileLine[2],
        ];
    }

    protected function insertBatch(&$rows)
    {
        $insertPlaces = [];
        $values = [];
        foreach ($rows as $row) {
            $insertPlaces[] = '(?,?,?)';
            foreach ($row as $elements) {
                $values[] = $elements;
            }
        }
        $insertPlaces = implode(',', $insertPlaces);

        $sql = "
            INSERT INTO users (ip, browser, os) VALUES
            ". $insertPlaces ."
            ON CONFLICT (ip, browser, os) DO NOTHING
        ";

        DB::prepare($sql)->execute($values);
    }

}