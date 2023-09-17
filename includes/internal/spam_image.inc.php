<?php
/***********************************************
osDate Open-Source Dating and Matchmaking Script

(c) 2009 TUFaT.com

osDate was created by Darren Gates and Vijay Nair,
and can be downloaded freely from www.TUFaT.com.
It is distributed under the LGPL license.

osDate is free for commercial and non-commercial 
uses. You may modify, re-sell, and re-distribute
osDate. Links back to TUFaT.com are appreciated.

This program is distributed in the hope that it
will be useful, but without any warranty, and 
without even the implied warranty of merchantability
or fitness for a particular purpose. While strong 
efforts have been taken to ensure the reliability,
security, and stability of osDate, all software 
carries risk. Your use of osDate means that you 
understand and accept the risks of using osDate.

For osDate documentation, change log, community
forum, latest updates, and project details,
please go to www.TUFaT.com  The osDate project is
supported through the sale of skins and add-ons,
which are entirely optional but help with the
development and design effort.
***********************************************/

   class SecurityImage {
      var $oImage;
      var $iWidth;
      var $iHeight;
      var $iNumChars;
      var $iNumLines;
      var $iSpacing;
      var $sCode;

      function SecurityImage($iWidth = 150, $iHeight = 30, $iNumChars = 8, $iNumLines = 30) {
         // get parameters
         $this->iWidth = $iWidth;
         $this->iHeight = $iHeight;
         $this->iNumChars = $iNumChars;
         $this->iNumLines = $iNumLines;

         // create new image
         $this->oImage = imagecreate($iWidth, $iHeight);

         // allocate background colour
         $this->oImage = imagecolorallocate($this->oImage, 255, 255, 255);

         // calculate spacing between characters based on width of image
         $this->iSpacing = (int)($this->iWidth / $this->iNumChars);
      }

      function DrawLines() {
         for ($i = 0; $i < $this->iNumLines; $i++) {
            $iRandColour = rand(190, 250);
            $iLineColour = imagecolorallocate($this->oImage, $iRandColour, $iRandColour, $iRandColour);
            imageline($this->oImage, rand(0, $this->iWidth), rand(0, $this->iHeight), rand(0, $this->iWidth), rand(0, $this->iHeight), $iLineColour);
         }
      }

      function GenerateCode() {
         // reset code
         $this->sCode = '';

         // loop through and generate the code letter by letter
         for ($i = 0; $i < $this->iNumChars; $i++) {
            // select random character and add to code string
			// $this->sCode .= chr(rand(65, 90));

            /********************************************/
            /* alternatively replace the line above     */
            /* with the following code to enable        */
            /* support for arbitrary characters         */
            /********************************************/

            // characters to use
			$aChars = array('A','B','C','D','E','F','G','H','I','J', 'K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9');

            // get number of characters
            $iTotal = count($aChars) - 1;

            // get random index
            $iIndex = rand(0, $iTotal);

            // add selected character to code string
            $this->sCode .= $aChars[$iIndex];

            /********************************************/
            /* End of optional code                     */
            /********************************************/
         }
      }

      function DrawCharacters() {
         // loop through and write out selected number of characters
         for ($i = 0; $i < strlen($this->sCode); $i++) {
            // select random font
            $iCurrentFont = rand(1, 5);

            // select random greyscale colour
            $iRandColour = rand(0, 255);
            $iTextColour = imagecolorallocate($this->oImage, $iRandColour, $iRandColour, $iRandColour);

            // write text to image
            imagestring($this->oImage, $iCurrentFont, $this->iSpacing / 3 + $i * $this->iSpacing, ($this->iHeight - imagefontheight($iCurrentFont)) / 2, $this->sCode[$i], $iTextColour);
         }
      }

      function Create($sFilename = '') {
         // check for existance of GD GIF library
         if (!function_exists('imagegif')) {
            return false;
         }

         $this->DrawLines();
         $this->GenerateCode();
         $this->DrawCharacters();

         // write out image to file or browser
         if ($sFilename != '') {
            // write stream to file
            imagegif($this->oImage, $sFilename);
         } else {
            // tell browser that data is gif
            header('Content-type: image/gif');

            // write stream to browser
            imagegif($this->oImage);
         }

         // free memory used in creating image
         imagedestroy($this->oImage);

         return true;
      }

      function GetCode() {
         return $this->sCode;
      }
   }
?>
