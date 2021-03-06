<?php

namespace App\Catrobat\Services\CatrobatCodeParser\Bricks;

use App\Catrobat\Services\CatrobatCodeParser\Constants;
use App\Catrobat\Services\CatrobatCodeParser\FormulaResolver;

/**
 * Class ThinkBubbleBrick
 * @package App\Catrobat\Services\CatrobatCodeParser\Bricks
 */
class ThinkBubbleBrick extends Brick
{
  /**
   *
   */
  protected function create()
  {
    $this->type = Constants::THINK_BUBBLE_BRICK;
    $this->caption = "Think \""
      . FormulaResolver::resolve($this->brick_xml_properties->formulaList)[Constants::STRING_FORMULA] . "\"";

    $this->setImgFile(Constants::LOOKS_BRICK_IMG);
  }
}