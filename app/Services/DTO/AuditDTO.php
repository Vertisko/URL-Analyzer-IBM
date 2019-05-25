<?php


namespace App\Services\DTO;

/**
 * Class AuditDTO
 * @package App\Services\DTO
 */
class AuditDTO extends BaseDTO
{
    /**
     * @var
     */
    private $description;
    /**
     * @var
     */
    private $score;
    /**
     * @var
     */
    private $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param int $score
     * @return void
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * @param mixed $description
     * @return void
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
