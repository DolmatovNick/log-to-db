<?php


class LogStats {

    /**
     * @var array
     */
    protected $rows;
    /**
     * @var int
     */
    protected $total_count;

    public function __construct(int $offset)
    {
        $offset = $offset ?? 0;
        $offset = $offset < 0 ? 0 : $offset;
        $stmt = DB::prepare("
            SELECT
              count(*) OVER() AS total_count,
              u.ip,
              u.browser,
              u.os,
              (array_agg(url_from ORDER BY l.log_date ASC))[1] first_url,
              (array_agg(url_to ORDER BY l.log_date DESC))[1] last_url,
              COUNT(DISTINCT url_to) as unique_count
            FROM logs l
              INNER JOIN users u ON u.ip = l.ip
            GROUP BY u.ip, u.browser, u.os
            ORDER BY u.ip ASC
            LIMIT 2 OFFSET :offset
        ");
        $stmt->execute([
            ':offset' => $offset
        ]);

        $this->rows = $stmt->fetchAll() ?? [];
        $this->total_count = $this->rows[0]['total_count'] ?? 0;
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @return mixed
     */
    public function getTotalCount(): int
    {
        return $this->total_count;
    }

}