<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\CloudSupport;

class DownloadParameters extends \Google\Model
{
  /**
   * @var bool
   */
  public $allowGzipCompression;
  /**
   * @var bool
   */
  public $ignoreRange;

  /**
   * @param bool
   */
  public function setAllowGzipCompression($allowGzipCompression)
  {
    $this->allowGzipCompression = $allowGzipCompression;
  }
  /**
   * @return bool
   */
  public function getAllowGzipCompression()
  {
    return $this->allowGzipCompression;
  }
  /**
   * @param bool
   */
  public function setIgnoreRange($ignoreRange)
  {
    $this->ignoreRange = $ignoreRange;
  }
  /**
   * @return bool
   */
  public function getIgnoreRange()
  {
    return $this->ignoreRange;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DownloadParameters::class, 'Google_Service_CloudSupport_DownloadParameters');
