<?php

abstract class ImportFile {

    protected $delimeter = '|';

    /**
     * Get filename for save the last executed line of log file
     * @param string $index
     * @return string
     */
    protected function getIndexFileName(string $index)
    {
        return './logs_index/'.$index.'_last_line_number';
    }

    /**
     * Make import the file
     * @param string $log - log filename
     * @param int $batchSize - count of row for insert into DB for the one time
     * @throws Exception
     */
    public function import(string $log, int $batchSize)
    {
        if (!file_exists($log)) {
            throw new \Exception('The log file '. $log .' is not found');
        }

        $file = new \SplFileObject($log, 'r');
        $info = new \SplFileInfo($log);

        $indexFile = $this->getIndexFileName($info->getBasename('.'));

        $rowNumber = (int)@file_get_contents($indexFile);

        $rows = [];

        $seekTo = ($rowNumber - 1) >= 0 ? ($rowNumber - 1) : 0;
        $file->seek($seekTo);

        while(!$file->eof()) {
            $line = $file->fgets();
            $line = trim($line);
            if (empty($line)) {
                continue;
            }
            $row = explode($this->delimeter, $line);
            $rows[] = $this->matchFileLineToDBRow($row);

            if (count($rows) == $batchSize) {
                $this->insertBatch( $rows );
                $rowNumber += count($rows);
                file_put_contents($indexFile, $rowNumber);
                $rows = [];
            }

        }
        if (!empty($rows)) {
            $this->insertBatch($rows);
            $rowNumber += count($rows);
            file_put_contents($indexFile, $rowNumber);
        }
    }

    /**
     * Match file line and DB row
     * @param $fileLine
     * @return array
     */
    abstract protected function matchFileLineToDBRow($fileLine): array;

    /**
     * Execute SQL
     * @param $rows
     * @return mixed
     */
    abstract protected function insertBatch(&$rows);

}