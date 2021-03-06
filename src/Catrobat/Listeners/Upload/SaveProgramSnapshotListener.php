<?php

namespace App\Catrobat\Listeners\Upload;

use App\Catrobat\Services\ProgramFileRepository;
use App\Catrobat\Events\ProgramAfterInsertEvent;
use App\Entity\Program;
use App\Catrobat\Services\Time;

/**
 * Class SaveProgramSnapshotListener
 * @package App\Catrobat\Listeners\Upload
 */
class SaveProgramSnapshotListener
{

  /**
   * @var ProgramFileRepository
   */
  private $file_repository;
  /**
   * @var
   */
  private $snapshot_dir;
  /**
   * @var Time
   */
  private $time;

  /**
   * SaveProgramSnapshotListener constructor.
   *
   * @param Time                  $time
   * @param ProgramFileRepository $file_repository
   * @param                       $snapshot_dir
   */
  public function __construct(Time $time, ProgramFileRepository $file_repository, $snapshot_dir)
  {
    $this->file_repository = $file_repository;
    $this->snapshot_dir = $snapshot_dir;
    $this->time = $time;
  }

  /**
   * @param ProgramAfterInsertEvent $event
   */
  public function handleEvent(ProgramAfterInsertEvent $event)
  {
    $this->saveProgramSnapshot($event->getProgramEntity());
  }

  /**
   * @param Program $program
   */
  public function saveProgramSnapshot(Program $program)
  {
    if ($program->getUser()->isLimited())
    {
      $file = null;
      try
      {
        $file = $this->file_repository->getProgramFile($program->getId());
        $date = date("Y-m-d_H-i-s", $this->time->getTime());
        $file->move($this->snapshot_dir, $program->getId() . "_" . $date . ".catrobat");
      } catch (\Exception $exception)
      {
        return;
      }
    }
  }
}