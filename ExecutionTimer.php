<?php

namespace Src\Utils;

use InvalidArgumentException;

final class ExecutionTimer
{
      private float $startTime;
      private float $endTime;
      private mixed $formattedTime;
      private string $unit;

      public function setStartTime(float $startTime)
      {
            $startTime ??= throw new InvalidArgumentException('You should provide a valid starting value!');

            $this->startTime = $startTime;
      }

      public function setEndTime(float $endTime)
      {
            $endTime ??= throw new InvalidArgumentException('You should provide a valid ending value!');

            $this->endTime = $endTime;
      }

      public function showTotalTime(string $of): ?string
      {
            $this->calculateExecutionTime();

            return "{$of} Total Execution Time: " . $this->formattedTime . $this->unit . "\n";
      }

      private function calculateExecutionTime()
      {
            $totalExecutionTime = $this->endTime - $this->startTime;

            if ($totalExecutionTime < 1) {
                  $this->formattedTime = sprintf("%.2f", $totalExecutionTime * 1000);
                  $this->unit = "ms";
            } elseif ($totalExecutionTime < 60) {
                  $this->formattedTime = sprintf("%.2f", $totalExecutionTime);
                  $this->unit = "s";
            } else {
                  $minutes = floor($totalExecutionTime / 60);
                  $seconds = $totalExecutionTime % 60;
                  $this->formattedTime = sprintf("%d:%05.2f", $minutes, $seconds);
                  $this->unit = "m:s";
            }
      }
}
